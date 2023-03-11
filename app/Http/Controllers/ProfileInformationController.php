<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileInformationController extends BaseController
{
    public function index()
    {
        $this->data['title'] = 'Profile';
        $this->data['titleDesc'] = 'Profile';
        $this->data['description'] = 'Profile';
        return view('admin.profile.index',$this->data);
    }
}
