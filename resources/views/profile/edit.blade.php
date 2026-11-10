@extends('layouts.app')

@section('content')
@php $percent = $user->storage_limit > 0 ? min(100, round($used / $user->storage_limit * 100)) : 100; @endphp

<h1 class="display-5">Profile</h1>
<p>Edit your info here</p>

<div class="mb-4">
    <strong>
        {{ \Illuminate\Support\Number::fileSize($user->freeSpace(), 2) }} /
        {{ \Illuminate\Support\Number::fileSize($user->storage_limit, 2) }} free space left
    </strong>
    <div class="progress mt-1" style="height: 10px;">
        <div class="progress-bar" style="width: {{ $percent }}%"></div>
    </div>
    <small class="text-muted">{{ $percent }}% used</small>
</div>

<form method="POST" action="{{ route('profile.update') }}">
    @csrf @method('PUT')
    @foreach([['name','First name'],['last_name','Last name'],['email','Email'],['address','Address']] as [$field, $label])
        <div class="mb-3">
            <label class="form-label" for="{{ $field }}">{{ $label }}</label>
            <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $user->$field) }}"
                   class="form-control @error($field) is-invalid @enderror">
            @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    @endforeach
    <button class="btn btn-primary">Save</button>
</form>
@endsection
