<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('modules.dashboard.users.list');
    }

    public function create() {
        return view('modules.dashboard.users.create');
    }

    public function edit() {
        return view('modules.dashboard.users.edit');
    }

    public function view() {
        return view('modules.dashboard.users.view');
    }
}
