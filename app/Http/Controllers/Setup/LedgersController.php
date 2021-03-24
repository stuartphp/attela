<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Ledger;
use Validator;

class LedgersController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'ledgers_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $keyword = request()->get('search');
            $keyword = str_replace('/', '', $keyword);
            if(!empty($keyword))
            {
                $data =DB::table('company_ledgers')
                ->leftJoin('ledgers', 'company_ledgers.ledger_number', '=', 'ledgers.ledger_number')
                ->where('company_id', session()->get('company_id'))
                ->where('company_ledgers.account_description', 'like', "%$keyword%")
                ->orWhere('company_ledgers.ledger_number', 'like', "%$keyword%")
                ->select('company_ledgers.*', 'ledgers.id as ledger_id')
                ->orderBy('company_ledgers.account_description')
                ->paginate(15);
            }else{

                $data =DB::table('company_ledgers')
                ->leftJoin('ledgers', 'company_ledgers.ledger_number', '=', 'ledgers.ledger_number')
                ->where('company_id', session()->get('company_id'))
                ->select('company_ledgers.*', 'ledgers.id as ledger_id')
                ->orderBy('company_ledgers.account_description')
                ->paginate(15);

            }

            return view('setup.ledgers', compact('data', 'keyword'));

        }

        public function store(){

            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            Ledger::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = Ledger::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = Ledger::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
            'ledger_number'=>'required',
            'group_name'=>'required',
            'normal_balance'=>'required',
            'account_description'=>'required',
            'is_active'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            Ledger::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
