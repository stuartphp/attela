<?php

namespace App\Http\Controllers\PayRoll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PayrollService;

class PayrollController extends Controller
{
    public function payslip($id){
        $benefits = DB::table('employee_benefits')->where('employee_id', $id)->get();
        $loans = DB::table('employee_loans')->where('employee_id', $id)->where('paid_up', 0)->get();
        (new PayrollService)->start($benefits, $loans);
    }
}
