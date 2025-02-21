<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function project()
    {
        return view('admin.project.index');
    }

    public function task()
    {
        return view('admin.task.index');
    }

    public function user()
    {
        return view('admin.user.index');
    }

    public function manager()
    {
        return view('admin.manager.index');
    }

    public function position()
    {
        return view('admin.position.index');
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function userProfile(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

}
