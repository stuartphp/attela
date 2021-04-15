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
        //dd(request()->all());
        $items = request('items');
        /*
        * Update Items
        * Delete All items
        * Create New Items
        * Calculate totals
        */
        DB::table('document_items')->where('document_id', $id)->delete();
        $total_nett=0;
        $total_excl=0;
        $total_discount=0;
        $total_vat=0;
        $total_amount=0;
        $total_cost=0;

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
                'options'=>$items[$i]['option'],
                'unit_price'=>$items[$i]['unit_price'],
                'tax_type'=>$items[$i]['tax_type'],
                'price_excl'=>$items[$i]['price_excl'],
                'discount_perc'=>$items[$i]['discount_perc'],
                'is_service'=>$items[$i]['is_service'],
            ];
            DB::table('document_items')->insert($record);
            $total_nett += ($items[$i]['quantity'] * $items[$i]['price_excl']);
            $total_discount += ($items[0]['quantity'] * $items[0]['discount_perc']);
            $value = $items[0]['quantity'] * ($items[0]['price_excl'] - $items[0]['discount_perc']);
            $total_vat +=$this->vatCalc($items[0]['tax_type'], $value);
            $total_cost += ($items[0]['quantity'] * $items[0]['unit_price']);
        }
        $total_excl = $total_nett-$total_discount;
        $total_amount = $total_excl + $total_vat;
        /*
        * Update Document
        * Update Addresse, Delivery Date, Reference Number, Totals
        */
        DB::table('documents')->where('id', $id)->update([
            'physical_address'=>request()->get('physical_address'),
            'delivery_address'=>request()->get('delivery_address'),
            'expire_delivery'=>request()->get('expire_delivery'),
            'total_nett_price'=>$total_nett,
            'total_excl'=>$total_excl,
            'total_discount'=>$total_discount,
            'total_tax'=>$total_vat,
            'total_amount'=>$total_amount,
            'total_due'=>$total_amount,
            'total_cost'=>$total_cost,
        ]);
        session()->flash('success', __('global.record_updated'));
        return redirect('documents/documents');

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
