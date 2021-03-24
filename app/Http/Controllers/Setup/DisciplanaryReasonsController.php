<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\DisciplinaryReason;

class DisciplanaryReasonsController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'disciplinary_reasons_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $search = request('search');
        if(!empty($search)){
            $data =DisciplinaryReason::where('company_id', session()->get('company_id'))->where('incident', 'like', "%$search%")->orderBy('incident')->paginate(15);
        }else{
            $data =DisciplinaryReason::where('company_id', session()->get('company_id'))->orderBy('incident')->paginate(15);
        }
        return view('setup.disciplinary-reasons', compact('data', 'search'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json([$error->errors()->all()]);
        }else{
            $form_data = request()->all();
            DisciplinaryReason::create($form_data);
            session()->flash('success', __('global.record_added'));
            return redirect()->back();
        }
    }

    public function show($id)
    {

    }
    public function edit($id){
        $data = DisciplinaryReason::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $res = request()->all();
        $data = DisciplinaryReason::findOrFail($id);
        $data->update($res);
        session()->flash('success', __('global.record_updated'));
        return redirect()->back();
    }

    public function validateRules()
    {
        $data =[ 'company_id'=>'required',
        'incident'=>'required',
        'first'=>'required',

        ];
        return $data;
    }

    public function destroy($id)
    {
        DisciplinaryReason::destroy($id);
        session()->flash('success', __('global.record_deleted'));
        return redirect()->back();
    }
    public function html($id)
    {
        // Add security
        $res = DisciplinaryReason::findOrFail($id);

        $html = '<tr id="r_'.$res->id.'">
        <td>'.substr($res->incident, 0,90).'...'.'</td>
        <td>'.$res->first.'</td>
        <td>'.$res->second.'</td>
        <td>'.$res->third.'</td>
        <td>'.$res->fourth.'</td>
        <td><select class="dropdown-action form-select" id="inv_opt_'.$res->inventory_item_id.'_'.$res->id.'"><option value="">'. __('global.select').'</option><option value="Edit">'. __('global.edit').'</option><option value="Delete">'.__('global.delete').'</option></select></td></tr>';
        return $html;
    }
}
