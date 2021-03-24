<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryImage;

use Validator;

class InventoryImagesController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_images_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $search = request('search');
        if(!empty($search))
        {
            $data = InventoryImage::whereHas('items', function ($q) use($search){
                $q->where('company_id', session()->get('company_id'))
                    ->where('description', 'like', "%search")
                    ->orWhere('file_name', 'like', "%$search");
            })->with(['items'])->paginate(15);
        }else{
            $data = InventoryImage::whereHas('items', function ($q){
                $q->where('company_id', session()->get('company_id'));
            })->with(['items'])->paginate(15);
        }
        return view('inventory.images', compact('data','search'));

    }

    public function store(){

        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json(['error'=> $error->errors()->all()]);
        }else{
            $form_data = request()->all();

            $file = request()->file('file_name');
            $nuName = time().$file->getClientOriginalName();
            $dir = 'companies/'.session()->get('company_id').'/stock/'.$nuName;
            if(move_uploaded_file($_FILES["file_name"]["tmp_name"], $dir)){
                $form_data['file_name']=$dir;
                $res=InventoryImage::create($form_data);
                return response()->json(['success'=>$res]);
            }else{
                return response()->json(['error'=>'upload error']);
            }
        }
        // return redirect()->back();
    }

    public function edit($id){
        $data = InventoryImage::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $res = request()->all();
        $data = InventoryImage::findOrFail($id);
        $data->update($res);
        session()->flash('success', __('global.record_updated'));
        return redirect()->back();
    }

    public function validateRules()
    {
        $data =[ 'inventory_item_id'=>'required',
        'file_name'=>'required',
        'sort_order'=>'required',
        ];
        return $data;
    }

    public function destroy($id)
    {
        InventoryImage::destroy($id);
        session()->flash('success', __('global.record_deleted'));
        return response()->json(['success'=>'yes']);
    }
}
