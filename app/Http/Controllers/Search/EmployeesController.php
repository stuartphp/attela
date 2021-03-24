<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{
    public function index($id)
    {
        if (request()->ajax()) {
            if(!empty($id))
            {
                $res = Employee::where('id', $id)->get();
            }else{
                $search = request()->get('search');
                $res = Employee::where('company_id', session()->get('company_id'))
                ->where(function($q) use($search){
                    $q->where('employee_code', 'like', "%$search%")
                        ->orWhere('title', 'like', "%$search%")
                        ->orWhere('surname', 'like', "%$search%")
                        ->orWhere('first_name', 'like', "%$search%")
                        ->orWhere('second_name', 'like', "%$search%")
                        ->orWhere('known_as', 'like', "%$search%")
                        ->orWhere('id_number', 'like', "%$search%")
                        ->orWhere('date_of_birth', 'like', "%$search%");

                })->orderBy('surname', 'asc')
                ->limit(10)
                ->get();
            }
            foreach ($res as $r)
            {
                $z[]=['id'=>$r->id, 'text'=>$r->surname.' '.$r->initials.' ('.$r->first_name.')'];
            }
            return $z;
        }
    }
}
