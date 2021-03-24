<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\SetupDocument;

class DocumentsController extends Controller
{
    public function index()
    {
        $data = SetupDocument::where('company_id', session()->get('company_id'))->paginate(15);
        return view('setup.documents', compact('data'));
    }
}
