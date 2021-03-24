<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayrollTransactionCode;
use Illuminate\Support\Facades\DB;

class PayrollTransactionCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search =request('search');

        if(!empty($search))
        {
            $data = PayrollTransactionCodes::where('company_id', session()->get('company_id'))->paginate(15);
        }else{

            $data =DB::table('payroll_transaction_codes as pay')
            ->leftJoin('company_payroll_transaction_codes as own', 'own.id', '=', 'pay.id')
            ->select('own.description as own_description', 'own.transaction_code as own_transaction_code','pay.*')
            ->orderBy('pay.irp5_code')
            ->orderBy('pay.irp5_description')

            ->paginate(15);
        }
// dd($data);

        return view('setup.payroll-transaction-codes', compact('data', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
