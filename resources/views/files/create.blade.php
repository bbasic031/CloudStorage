@extends('layouts.app')

@section('content')
<h1 class="display-5">New File</h1>
<p>Upload a new file</p>
<a href="{{ route('files.index') }}" class="btn btn-primary mb-3">All Files</a>

<form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
        @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-success">Upload</button>
</form>
<p class="text-muted mt-3">
    Free space: {{ \Illuminate\Support\Number::fileSize(auth()->user()->freeSpace(), 2) }}
</p>
@endsection
