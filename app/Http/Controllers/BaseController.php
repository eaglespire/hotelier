<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $data = [];
    public function __construct()
    {
       // $this->data['']
    }
}
