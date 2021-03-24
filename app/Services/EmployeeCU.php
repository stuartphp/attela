<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;

class EmployeeCU
{
    public function create($data)
    {
        dd($data);
    }

    public function update($id, $data = null){
        //dd($data);
        $addr = $data['addr'];
        $cont = $data['cont'];
        $emer = $data['emer'];
        unset($data['addr'], $data['cont'], $data['emer'], $data['_method'], $data['_token']);
        $addr['employee_id']=$id;
        $cont['employee_id']=$id;
        $emer['employee_id']=$id;
        try {
            DB::beginTransaction();
            DB::table('employees')->where('id', $id)->update($data);
            DB::table('employee_addresses')->upsert($addr, ['employee_id']);
            DB::table('employee_contact_details')->upsert($cont, ['employee_id']);
            DB::table('employee_emergency_contacts')->upsert($emer, ['employee_id']);
            session()->flash('success', __('global.record_updated'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }

    }
}
