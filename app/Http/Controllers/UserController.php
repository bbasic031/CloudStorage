<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))
            ->withSum('files', 'size')
            ->orderBy('name')
            ->paginate(10);

        return view('users.index', compact('users'));
    }
}
