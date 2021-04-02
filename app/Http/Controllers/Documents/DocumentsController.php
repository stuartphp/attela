<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DocumentService;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Services\PDFDocumentService;


class DocumentsController extends Controller
{
    public function index()
    {
        return view('documents.index');
    }
    public function flow($id)
    {
        if(request()->ajax()){
            $data = DB::table('documents')->where('document_id', $id)->get();
            return response()->json($data);
        }
    }
    public function lock($id)
    {
        (new DocumentService)->lock($id);

        return redirect()->back();
    }

    public function print($id)
    {

        (new PDFDocumentService)->index($id);
    }
    public function edit($id)
    {
        return view('documents.edit2', compact('id'));
    }

    public function view($id)
    {
        $template = config(session()->get('company_id').'.invoice_template');
        $doc=DB::table('documents')->where('id', $id)->first();
        $items = DB::table('document_items')->where('document_id', $id)->get();
        return view('pdf.invoices.'.$template, compact('doc', 'items'));
    }
    public function convert_invoice($id)
    {
        (new DocumentService)->convert($id);
        return redirect()->back();
    }
}
