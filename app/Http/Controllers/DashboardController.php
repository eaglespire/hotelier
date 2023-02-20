<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Admin';
        $this->data['titleDesc'] = 'Admin Backend to manage hotel CRM';
        $this->data['description'] = 'Welcome to hotelier';
        return view('admin.index', $this->data);
    }
    public function users()
    {
        $this->data['title'] = 'Users';
        $this->data['titleDesc'] = 'Manage Users';
        $this->data['description'] = 'User Management';
        return view('admin.users.index', $this->data);
    }
    public function editUser(User $user)
    {
        $this->data['title'] = 'Edit User';
        $this->data['titleDesc'] = 'Manage Users';
        $this->data['description'] = 'User Management';
        $this->data['user'] = $user;
        return view('admin.users.edit', $this->data);
    }
}
