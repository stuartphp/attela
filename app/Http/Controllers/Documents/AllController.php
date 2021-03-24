<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Validator;
class AllController extends Controller
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
            ->whereBetween('action_date', [$start, $end])
            ->where('account_number', 'like', "%$keyword%")
                ->orWhere('entity_name', 'like', "%$keyword%")
                ->orWhere('reference_number', 'like', "%$keyword%")
                ->orWhere('document_number', 'like', "%$keyword%")
                ->orWhere('total_amount', 'like', "%$keyword%")
                ->orWhere('action_date', 'like', "%$keyword%")
            ->orderBy('action_date', 'desc')
            ->paginate(15);
        }else{
            $data = Document::where('company_id', session()->get('company_id'))
            ->whereBetween('action_date', [$start, $end])
            ->orderBy('action_date', 'desc')
            //->toSql()
            ->paginate(15);
        }
        return view('documents.all', compact('data', 'keyword'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data = request()->all();

        DocumentType::create($form_data);
        return response()->json(['success'=>'yes']);
    }

    public function edit($id){
        $data = DocumentType::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $res = request()->all();
        $data = DocumentType::findOrFail($id);
        $data->update($res);
        return response()->json('success');
    }

    public function validateRules()
    {
        $data =[ 'document_id'=>'required',
'action_date'=>'required',
'document_number'=>'required',
'user_id'=>'required',
'document_type'=>'required',
'inclusive'=>'required',
'note'=>'required',
'total_nett_price'=>'required',
'total_excl'=>'required',
'total_discount'=>'required',
'total_tax'=>'required',
'total_amount'=>'required',
'total_due'=>'required',
'is_locked'=>'required',
'is_paid'=>'required',
'is_vat_paid'=>'required',
];
        return $data;
    }

    public function destroy($id)
    {
        DocumentType::destroy($id);
        return response()->json(['success'=>'yes']);
    }
}
