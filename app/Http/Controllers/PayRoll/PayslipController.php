<?php

namespace App\Http\Controllers\PayRoll;

use App\Http\Controllers\Controller;
use App\Models\PayrollTemplate;
use Illuminate\Support\Facades\DB;

class PayslipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $template = DB::table('payroll_template')->where('employee_id', $id)->get();
        // $payment = DB::table('employee_payment_details')->where('employee_id', $id)->first();
        // $ra = DB::table('users')

        return view('payroll.payslip');
    }

}
