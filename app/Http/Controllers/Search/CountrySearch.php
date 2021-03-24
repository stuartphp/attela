<?php

namespace App\Http\Controllers\Search;

use App\Models\CompanyCountry;
use App\Models\Zone;

class CountrySearch
{
    public function index($id=null)
    {
        $search = request()->get('search');
        if($id>0)
        {
            $res = CompanyCountry::where('country_id', $id)->pluck('name', 'country_id');
        }else{
            $res = CompanyCountry::where('company_id', session()->get('company_id'))->where('name', 'like', "%$search%")->orderBy('name', 'asc')->limit(10)->pluck('name', 'country_id');
        }

        foreach ($res as $key=>$val)
        {
            $z[]=['id'=>$key, 'text'=>$val];
        }
        return $z;

    }

    public function zone($id){
        $res = Zone::where('country_id', $id)->orderBy('name', 'asc')
        ->pluck('name', 'id');
        foreach ($res as $key=>$val)
        {
            $z[]=['id'=>$key, 'text'=>$val];
        }
        return $z;
    }
}
