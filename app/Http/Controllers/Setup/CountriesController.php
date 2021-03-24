<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\CompanyCountry;
use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{

    public function index()
    {
        $search = request('search');

        if(!empty($search))
        {
            $data =DB::table('countries')
                ->leftJoin('company_countries', 'company_countries.country_id', '=', 'countries.country_id')
                ->select('countries.*','company_countries.id as own_id')
                ->where('countries.name', 'like', "%$search%")
                ->orWhere('company_countries.name', 'like', "%$search%")
                ->orderBy('countries.name')
                ->paginate(15);
        }else{
            $data =DB::table('countries')
                ->leftJoin('company_countries', 'company_countries.country_id', '=', 'countries.country_id')
                ->select('countries.*','company_countries.id as own_id')
                ->orderBy('countries.name')
                ->paginate(15);
        }


        return view('setup.countries', compact('data'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $country = Country::findOrFail(request('id'));
        CompanyCountry::create([
            'company_id'=>session()->get('company_id'),
		'country_id'=>$country->id,
        'name'=>$country->name,
		'iso_code_2'=>$country->iso_code_2,
		'iso_code_3'=>$country->iso_code_3,
        'is_active'=>1
        ]);
        return response()->json(['success'=>'yes']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $rec = CompanyCountry::where('company_id', session()->get('company_id'))->where('country_id', $id)->first();
        $rec->delete();
        return response()->json(['success'=>'yes']);
    }
}
