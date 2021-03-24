<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\CompanyLedger;

class PaymentsController extends Controller
{
    public function index()
    {
        $data = CompanyLedger::where('company_id', session()->get('company_id'))
            ->whereBetween('ledger_number', [8400000, 8499999])
            ->orderBy('account_description')
            ->get();
        return view('setup.payments', compact('data'));
    }

    public function store()
    {
        dd(request()->all());
        ['company_id',
        'ledger_number',
        'group_name',
        'normal_balance',
		'financial_category',
		'account_description',
		'is_active'];
    }
    public function edit($id)
    {
        $data = LedCompanyLedger::findOrFail($id);
        return response()->json($data);
    }
}
