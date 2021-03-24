<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class SetupFileService
{
    public function create(){
        $config_file = session()->get('company_id').'.php';
        $discard_array=['id', 'company_id', 'created_at', 'updated_at', 'deleted_at'];
        $company = DB::table('companies')->where('id', session()->get('company_id'))->first();
        $setting_accounting = DB::table('setup_accounting')->where('company_id', session()->get('company_id'))->first();
        $setting_document = DB::table('setup_documents')->where('company_id', session()->get('company_id'))->first();
        $setting_inventory = DB::table('setup_inventory')->where('company_id', session()->get('company_id'))->first();
        $setting_payment = DB::table('setup_payment')->where('company_id', session()->get('company_id'))->get();
        $setting_payroll = DB::table('setup_payroll')->where('company_id', session()->get('company_id'))->first();
        $setting_transactions = DB::table('setup_transactions')->where('company_id', session()->get('company_id'))->first();
        $myfile = fopen(config_path($config_file), "w") or die("Unable to open file!");
        $txt = "<?php \treturn [\t";
        fwrite($myfile, $txt);
        if($company)
        {
            fwrite($myfile,"\n/*** Company ***/\n");
            foreach($company as $k=>$v)
            {

                if(!in_array($k, $discard_array))
                {
                    $txt = "'".$k."'=>'".$v."',\n";
                    fwrite($myfile, $txt);
                }
            }
        }
        if($setting_accounting)
        {
            fwrite($myfile,"\n/*** Accounting ***/\n");
            foreach($setting_accounting as $k=>$v)
            {
                if(!in_array($k, $discard_array))
                {
                    $txt = "'".$k."'=>\"".$v."\",\n";
                    fwrite($myfile, $txt);
                }
            }
        }

        if($setting_document)
        {
            fwrite($myfile,"\n/*** Documents ***/\n");
            foreach($setting_document as $k=>$v){
                if(!in_array($k, $discard_array))
                {
                    $txt = "'".$k."'=>'".$v."',\n";
                    fwrite($myfile, $txt);
                }
            }
        }
        if($setting_inventory)
        {
            fwrite($myfile,"\n/*** Inventory ***/\n");
            foreach($setting_inventory as $k=>$v){
                if(!in_array($k, $discard_array))
                {
                    $txt = "'".$k."'=>'".$v."',\n";
                    fwrite($myfile, $txt);
                }
            }
        }

        if($setting_payroll)
        {
            fwrite($myfile,"\n/*** Payroll ***/\n");
            foreach($setting_payroll as $k=>$v){
                if(!in_array($k, $discard_array))
                {
                    $txt = "'".$k."'=>'".$v."',\n";
                    fwrite($myfile, $txt);
                }
            }
        }

        if($setting_transactions)
        {
            fwrite($myfile,"\n/*** Transactions ***/\n");
            foreach($setting_transactions as $k=>$v){
                if(!in_array($k, $discard_array))
                {
                    $txt = "'".$k."'=>'".$v."',\n";
                    fwrite($myfile, $txt);
                }

            }
        }
        if($setting_payment)
        {
            fwrite($myfile,"\n/*** Payments ***/\n");
            $txt = "'payment_terms'=>[\n";
            fwrite($myfile, $txt);
            foreach($setting_payment as $pay){
                $txt = "\t'".$pay->name."'=>'".$pay->ledger."',\n";
                fwrite($myfile, $txt);
            }
            $txt = "],\n";
            fwrite($myfile, $txt);
        }

        // $txt = "'vat_rev'=>1.".request('vat_percentage');
        // fwrite($myfile, $txt);
        $txt = "];";
        fwrite($myfile, $txt);
        fclose($myfile);
        return true;
    }
}
