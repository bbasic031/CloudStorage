<?php

namespace App\Http\Controllers;

use App\Models\UserFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = UserFile::with('user')->latest();

        if (! $user->hasRole('super_admin')) {
            $query->where('user_id', $user->id);
        }

        $files = $query->paginate(5);

        return view('files.index', compact('files'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['file' => ['required', 'file']]);

        $user = $request->user();
        $upload = $request->file('file');

        if ($upload->getSize() > $user->freeSpace()) {
            return back()->withErrors(['file' => 'Not enough free storage space for this file.']);
        }

        $path = $upload->store("uploads/{$user->id}"); // private "local" disk

        UserFile::create([
            'user_id' => $user->id,
            'original_name' => $upload->getClientOriginalName(),
            'path' => $path,
            'extension' => $upload->getClientOriginalExtension(),
            'mime_type' => $upload->getClientMimeType(),
            'size' => $upload->getSize(),
        ]);

        return redirect()->route('files.index')->with('success', 'File uploaded.');
    }

    public function download(Request $request, UserFile $file)
    {
        $this->authorizeAccess($request, $file);

        abort_unless(Storage::exists($file->path), 404, 'File not found on disk.');

        return Storage::download($file->path, $file->original_name);
    }

    public function destroy(Request $request, UserFile $file): RedirectResponse
    {
        $this->authorizeAccess($request, $file);

        Storage::delete($file->path);
        $file->delete();

        return back()->with('success', 'File deleted.');
    }

    private function authorizeAccess(Request $request, UserFile $file): void
    {
        $user = $request->user();

        abort_unless(
            $user->hasRole('super_admin') || $file->user_id === $user->id,
            403
        );
    }
}
