<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $search = request()->get('search');
            $res = Customer::where('company_id', session()->get('company_id'))
            ->where(function($q) use($search){
                $q->where('description', 'like', "%$search%")
            ->orWhere('account_number', 'like', "%$search%");

            })->orderBy('description', 'asc')
            ->pluck('description', 'id');
            foreach ($res as $key=>$val)
            {
                $z[]=['id'=>$key, 'text'=>$val];
            }
            return $z;
        }
    }
}
