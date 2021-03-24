<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SamplesController extends Controller
{
    public function index()
    {
        return view('pdf.samples.2');
    }
}
