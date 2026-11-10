@extends('layouts.app')

@section('content')
@php $isSuper = auth()->user()->canViewAllFiles(); @endphp

<h1 class="display-5">Files</h1>
<p>{{ $isSuper ? 'All uploaded files' : 'Upload & download your files' }}</p>
<a href="{{ route('files.create') }}" class="btn btn-primary mb-3">New file</a>

<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th style="width:50px"></th>
            <th>Name</th>
            @if($isSuper)<th>Added By</th>@endif
            <th>Added</th>
            <th>Size</th>
            <th style="width:100px"></th>
        </tr>
    </thead>
    <tbody>
    @forelse($files as $file)
        <tr>
            <td><i class="bi {{ $file->icon[0] }} {{ $file->icon[1] }} fs-4"></i></td>
            <td>{{ $file->original_name }}</td>
            @if($isSuper)<td>{{ $file->user->name }} {{ $file->user->last_name }}</td>@endif
            <td>{{ $file->created_at->format('n/j/y, g:i A') }}</td>
            <td>{{ \Illuminate\Support\Number::fileSize($file->size, 2) }}</td>
            <td class="text-nowrap">
            <div class="d-flex gap-1 justify-content-end">
                <a href="{{ route('files.download', $file) }}" class="btn btn-primary btn-sm" title="Download">
                    <i class="bi bi-download"></i>
                </a>
                @if(auth()->user()->canDeleteFile($file))
                    <form method="POST" action="{{ route('files.destroy', $file) }}"
                        onsubmit="return confirm('Delete this file?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-x-lg"></i></button>
                    </form>
                @endif
            </div>
        </td>
        </tr>
    @empty
        <tr><td colspan="{{ $isSuper ? 6 : 5 }}" class="text-center text-muted">No files yet.</td></tr>
    @endforelse
    </tbody>
</table>

{{ $files->links() }}
@endsection