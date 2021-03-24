<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeNewController extends Controller
{
    public function index()
    {
        return view('human-resource.new_employee');
    }
    public function step1()
    {
        dd(request()->all());
        return view('human-resource.new_employee');
    }
}
