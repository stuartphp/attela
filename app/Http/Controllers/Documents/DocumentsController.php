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

    public function edit($id)
    {
        return view('documents.edit2', compact('id'));
    }

    public function update($id)
    {
        dd(request()->all());
        $items = request('items');
        /*
        * Update Items
        * Delete All items
        * Create New Items
        * Calculate totals
        */
        //DB::table('document_items')->where('document_id', $id)->delete();
        for($i=0; $i<count($items); $i++)
        {
            $record = [
                'document_id'=>$id,
                'store_id'=>$items[$i]['store_id'],
                'item_id'=>$items[$i]['item_id'],
                'item_code'=>$items[$i]['item_code'],
                'item_description'=>$items[$i]['item_description'],
                'project'=>null,
                'unit'=>$items[$i]['unit'],
                'quantity'=>$items[$i]['quantity'],
                'options'=>$items[$i]['options'],
                'unit_price'=>$items[$i]['unit_price'],
                'tax_type'=>$items[$i]['tax_type'],
                'price_excl'=>$items[$i]['price_excl'],
                'discount_perc'=>$items[$i]['discount_perc'],
                'is_service'=>$items[$i]['is_service'],
            ];
            dd($record);
        }
        /*
        * Update Document
        * Update Addresse, Delivery Date, Reference Number, Totals
        */

    }

    public function vatCalc($tax_type, $value)
    {
        $tax_rate = __('accounting_lookup.vat.reverse');
        switch($tax_type)
        {
            case '00':
                //$this->vat += ($value * $tax_rate);
                break;
            case '01':
                return ($value * $tax_rate);

                break;
            case '08':
                return ($value * $tax_rate);
                break;
            case '09':
                return ($value * $tax_rate);
                break;
            case '10':
                return ($value * $tax_rate);
                break;
            default:
                return 0;
                break;
        }
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
