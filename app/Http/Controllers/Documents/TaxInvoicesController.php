<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentItem;
use App\Services\DocumentService;
use Illuminate\Support\Facades\DB;

class TaxInvoicesController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'document_types_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $keyword = request()->get('search');
        $period = explode('/', session()->get('financial_year'));
        $start=$period[0].'-03-01';
        $end = $period[1].'-03-01';
        if(!empty($keyword))
        {
            $data = Document::where('company_id', session()->get('company_id'))
            ->where('document_type', 'tax_invoice')
            ->whereBetween('action_date', [$start, $end])
            ->where('account_number', 'like', "%$keyword%")
                ->orWhere('entity_name', 'like', "%$keyword%")
                ->orWhere('reference_number', 'like', "%$keyword%")
                ->orWhere('document_number', 'like', "%$keyword%")
                ->orWhere('document_reference', 'like', "%$keyword%")
                ->orWhere('total_amount', 'like', "%$keyword%")
                ->orWhere('action_date', 'like', "%$keyword%")
            ->orderBy('action_date', 'desc')
            ->paginate(15);
        }else{
            $data = Document::where('company_id', session()->get('company_id'))
            ->where('document_type', 'tax_invoice')
            ->whereBetween('action_date', [$start, $end])
            ->orderBy('action_date', 'desc')
            ->paginate(15);
        }

        return view('documents.tax-invoices', compact('data', 'keyword'));

    }

    public function store(){

        $document_id =(new DocumentService)->create(request('entity_id'), 'C', 'tax_invoice', request('document_reference'));
        if(is_int($document_id))
        {
           return redirect('/documents/tax-invoices/'.$document_id.'/edit');
        }

    }

    public function edit($id){
        $data = Document::findOrFail($id);

        if($data->is_locked)
        {
            session()->flash('error', __('global.lock'));
            return redirect()->back();
        }
        $items = DocumentItem::where('document_id', $id)->get();
        $stores = DB::table('stores')->where('company_id', session()->get('company_id'))->pluck('name', 'id')->toArray();
        $entity = DB::table('customers')->where('id', $data->entity_id)->select('credit_limit', 'current_balance', 'payment_terms', 'price_list', 'default_tax')->first();
        $url = 'tax-invoices';
        $color='#F3FCF3';
        return view('documents.edit', compact('data', 'items', 'url', 'stores', 'entity', 'color'));
    }

    public function update($id){
        $res = request()->all();
        (new DocumentService)->update($id, $res);

        return redirect('/documents/tax-invoices');
    }

    public function validateRules()
    {
        $data =[ ];
        return $data;
    }

}
