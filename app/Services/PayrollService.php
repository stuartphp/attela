<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayrollService
{
    public $income = 0;
    public $taxable_income=0;
    public $tax_deductions=0;
    public $uif=0;
    public $uif_cap = 148.72;
    public $sdl=0;
    public $tax_deduction=0;

    public function start($benefits, $loans){
        $tax_year = str_replace('/','', config(session()->get('company_id').'.financial_year'));
        $employee = DB::table('employees')->where('id', $benefits[0]->employee_id)->first();

        foreach($benefits as $ben){
            if($ben->tax_code > 3600  && $ben->tax_code < 3925){
                $this->calc_income($ben->amount,$ben->tax_code);
            }
            if($ben->tax_code > 4000 && $ben->tax_code < 4588){
                $this->calc_deductions($ben->amount,$ben->tax_code);
            }
        }

        $totals=['income'=>$this->income, 'taxable'=>($this->taxable_income*12), 'deductions'=>$this->tax_deductions];
        if($employee->registered_medical_aid==1){
            $this->tax_deductions +=$this->medical_aid($employee->medical_aid_members, $tax_year);
        }

        $age = Carbon::parse($employee->date_of_birth)->diff(Carbon::now())->format('%y');

        $this->rebate=$this->rebate($age, $tax_year);

        dd($this->tax_calculator($tax_year));
    }

    public function calc_income($amount, $code){
        $this->income +=$amount;
        switch($code){
            case 3602:
                $amount=0;
                break;
            case 3604:
                $amount=0;
                break;
            case 3605:
                $amount = $amount/12;
                break;
            case 3609:
                $amount=0;
                break;
            case 3612:
                $amount=0;
                break;
            case 3701:
                $amount= $amount * 0.8;
                break;
            case 3703:
                $amount= 0;
                break;
            case 3705:
                $amount= 0;
                break;
            case 3709:
                $amount= 0;
                break;
            case 3714:
                $amount= 0;
                break;
            case 3716:
                $amount= 0;
                break;
            case 3815:
                $amount= 0;
                break;
            case 3821:
                $amount= 0;
                break;
            case 3830:
                $amount= 0;
                break;
            case 3832:
                $amount= 0;
                break;
            case 3834:
                $amount= 0;
                break;
            case 3908:
                $amount= 0;
                break;
        }
        $this->taxable_income +=$amount;
    }

    public function rebate($age, $tax_year)
    {
        $reb = DB::table('payroll_rebate')->where('tax_year', $tax_year)->first();

        if($age < 65)
        {
            return $reb->primary;
        }elseif($age > 64 && $age < 75)
        {
            return ($reb->primary + $reb->secondary);
        }else{
            return ($reb->primary + $reb->secondary+$reb->tertiary);
        }
    }

    public function medical_aid($members, $tax_year){
        $credits = DB::table('payroll_medical_credits')->where('tax_year', $tax_year)->first();
        $mem1 = $credits->main_menber;
        $mem2 = $credits->first_dependant;
        $mem3 = $credits->other_dependants;
        $t=0;
        if($members > 0)
        {
            if($members >2){
                $t = $mem1+$mem2+(($members-2) * $mem3);
                return $t;
            }elseif($members==2){
                return$mem1+$mem2;
            }else{
                return $mem1;
            }
        }
    }

    public function calc_deductions($amount, $code){
        //$this->tax_deductions +=$amount;
    }

    public function tax_calculator($tax_year)
    {
        $taxable_income_year = ($this->taxable_income*12);

        $this->uif = $this->taxable_income*0.01;
        if($this->uif > $this->uif_cap)
        {
            $this->uif=$this->uif_cap;
        }

        $tax_table = DB::table('payroll_tax_table')->where('tax_year', $tax_year)->get();

        foreach($tax_table as $tt){
            if($taxable_income_year > $tt->lower_bracket && $taxable_income_year < $tt->upper_bracket)
            {

                $per = $tt->tax_percentage/100;
                $t_inc = ($taxable_income_year-$tt->lower_bracket);
                $t= ( $t_inc* $per);
                $tx = $t+$tt->tax_amount;
                $a= $tx-$this->rebate;
                $m = ($a/12);
            }
        }
        return $m-$this->tax_deductions;
        //return $this->uif;
    }

}
