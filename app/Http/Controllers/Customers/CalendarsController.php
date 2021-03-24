<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Validator;
class CalendarsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'calendars_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            return view('customers.calendards');

        }
        public function get_data()
        {
            $id = explode('~', request('id'));
            $query = Calendar::where('company_id', session()->get('company_id'))
                ->where('entity_id', $id[0])
                ->where('gcs', $id[1])
                ->where('start_date' ,'>', request('start'))
                ->where('end_date' ,'<', request('end'))
                ->get();
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
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();
            $form_data['company_id']=session()->get('company_id');
            Calendar::create($form_data);
            return response()->json(['success'=>'yes']);
        }


        public function edit($id){
            $data = Calendar::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = Calendar::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function show($id)
        {
            $data=['id'=>$id, 'gcs'=>'C'];
            return view('customers.calendards', compact('data'));
        }
        public function validateRules()
        {
            $data =[
                'entity_id'=>'required',
                'entity_name'=>'required',
                'gcs'=>'required',
                'description'=>'required',
                'creator'=>'required',
                'assigned_to'=>'required',
                'status'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            Calendar::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
