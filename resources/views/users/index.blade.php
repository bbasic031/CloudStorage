@extends('layouts.app')

@section('content')
<h1 class="display-5">Users</h1>
<p>All users with the "user" role and their remaining storage</p>

<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr><th>Name</th><th>Username</th><th>Email</th><th>Used</th><th>Free space</th></tr>
    </thead>
    <tbody>
    @foreach($users as $u)
        @php
            $used = (int) $u->files_sum_size;
            $free = max(0, $u->storage_limit - $used);
        @endphp
        <tr>
            <td>{{ $u->name }} {{ $u->last_name }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ \Illuminate\Support\Number::fileSize($used, 2) }}</td>
            <td>{{ \Illuminate\Support\Number::fileSize($free, 2) }} / {{ \Illuminate\Support\Number::fileSize($u->storage_limit, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $users->links() }}
@endsection