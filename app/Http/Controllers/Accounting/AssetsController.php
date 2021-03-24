<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use Validator;

class AssetsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'assets_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $keyword = request('search');
            if(!empty($keyword))
            {
                $data = Asset::where('company_id', session()->get('company_id'))
                    ->where(function($q) use($keyword){
                        $q->where('serial_number', 'like', "%$keyword%")
                          ->where('description', 'like', "%$keyword%");
                    })
                    ->paginate(15);
            }else{
                $data = Asset::where('company_id', session()->get('company_id'))->paginate(15);
            }

            return view('accounting.assets', compact('data', 'keyword'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                Asset::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();

        }

        public function edit($id){
            $data = Asset::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = Asset::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
            'asset_number'=>'required',
            'asset_type_id'=>'required',
            'employee_id'=>'required',
            'serial_number'=>'required',
            'description'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            Asset::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
