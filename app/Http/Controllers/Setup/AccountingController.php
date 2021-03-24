<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;

use App\Models\CompanyLedger;
use App\Models\SetupAccounting;
use Validator;

class AccountingController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'setup_accounting_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $ledgers = CompanyLedger::where('company_id', session()->get('company_id'))->orderBy('account_description')->pluck('account_description', 'ledger_number')->toArray();
        $data= SetupAccounting::where('company_id', session()->get('company_id'))->first();
        return view('setup.accounting', compact('data', 'ledgers'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }else{
            $form_data = request()->all();
            SetupAccounting::create($form_data);
            return redirect()->back()->with(['success'=>__('global.record_added')]);
        }
    }

    public function edit($id){
        $data = SetupAccounting::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json([$error->errors()->all()]);
        }else{
            $res = request()->all();
            $data = SetupAccounting::findOrFail($id);
            $data->update($res);
            return redirect()->back()->with(['success'=>__('global.record_updated')]);
        }
    }

    public function validateRules()
    {
        $data =[
            'charge_delivery_cost'=>'required',
            'default_credit_limit'=>'required',
            'retained_earnings'=>'required',
            'profit_loss_year'=>'required',
            'exchange_variances_account'=>'required',
            'bank_charges'=>'required',
            'sales_account'=>'required',
            'sales_discount_account'=>'required',
            'purchase_discount_account'=>'required',
            'debtor_control_account'=>'required',
            'bad_debt_account'=>'required',
            'bad_debt_recovered_account'=>'required',
            'supplier_control_account'=>'required',
            'inventory_account'=>'required',
            'cogs_account'=>'required',
            'vat_control_account'=>'required',
            'vat_output'=>'required',
            'vat_input'=>'required',
            'vat_percentage'=>'required',
            'inventory_adjustments_account'=>'required',
            'rounding_account'=>'required',
            'round_to_nearest'=>'required',
            'depreciation_period'=>'required',
            'is_vat_registered'=>'required',
            'financial_year'=>'required',
            'quote_valid_days'=>'required',
        ];
        return $data;
    }

}
