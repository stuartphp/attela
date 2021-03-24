<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetupLeave;
use Validator;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SetupLeave::where('company_id', session()->get('company_id'))->get();
        return view('setup.leave', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }else{
            $form_data = request()->all();
            SetupLeave::create($form_data);
        }
        return redirect()->back()->with(['success'=> __('global.record_added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SetupLeave::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $res = request()->all();
        $data = SetupLeave::findOrFail($id);
        $data->update($res);
        return redirect()->back()->with(['success'=> __('global.record_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SetupLeave::destroy($id);
        return redirect()->back()->with(['success'=> __('global.record_deleted')]);
    }
    public function validateRules()
        {
            $data =[ 'company_id'=>'required',
                'leave_type'=>'required',
                'leave_cycle'=>'required',
                'estimated_value'=>'required|numeric',
            ];
            return $data;
        }
}
