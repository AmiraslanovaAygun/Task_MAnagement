<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
}
