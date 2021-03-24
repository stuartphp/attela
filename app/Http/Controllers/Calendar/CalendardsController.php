<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Validator;

class CalendardsController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'calendars_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        return view('calendars.index');

    }
    public function get_data()
    {
        $gcs = request('gcs');
        switch($gcs)
        {
            case 'A':
                $query = Calendar::where('company_id', session()->get('company_id'))
                    ->where('start_date' ,'>', request('start'))
                    ->where('end_date' ,'<', request('end'))
                    ->get();
                break;
            case 'C':
                $query = Calendar::where('company_id', session()->get('company_id'))
                    ->where('gcs' ,'=', 'C')
                    ->where('start_date' ,'>', request('start'))
                    ->where('end_date' ,'<', request('end'))
                    ->get();
                break;
            case 'S':
                $query = Calendar::where('company_id', session()->get('company_id'))
                    ->where('gcs' ,'=', 'S')
                    ->where('start_date' ,'>', request('start'))
                    ->where('end_date' ,'<', request('end'))
                    ->get();
                break;
            case 'P':
                $query = Calendar::where('company_id', session()->get('company_id'))
                    ->where('assigned_to' ,'=', auth()->id())
                    ->where('start_date' ,'>', request('start'))
                    ->where('end_date' ,'<', request('end'))
                    ->get();
                break;
        }

        $data=[];

        foreach ($query as $row)
        {
            $data[]=[
                'id'    =>$row->id,
                'title' =>$row->entity_name,
                'start'=>$row->start_date,
                'end'=>$row->end_date
            ];
        }
        return response()->json($data);
    }
    public function show($id)
    {
        $data = Calendar::with(['user_creator', 'user_assigned_to'])->findOrFail($id);
        return \response()->json($data);
    }
}
