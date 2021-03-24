<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    public function index()
    {
        $data = DB::select("SHOW TABLES");

        return view('crud.index', compact('data'));
    }
    public function table($tbl){
        $table = DB::select("DESCRIBE $tbl");
        $data = '';

        foreach($table as $field)
        {
            // $data .= '<div class="form-group row">
            //     <label class="col-md-3">{{ __(\''.$tbl.'.fields.'.$field->Field.'\') }}</label>
            //     <div class="col-md-9">
            //         {{ $item->'.$field->Field.' }}
            //     </div>
            // </div>';
            $data .="'".$field->Field."',\n";
        }
        echo $data;
        // $types =DB::table('document_types')->get();
        // $data = '';
        // foreach($types as $type)
        // {
        //     $doc = DB::table('documents')->where('id', $type->document_id)->first();
        //     DB::table('documentsx')->insert(['company_id'=>$doc->company_id,
        //     'gcs'=>$doc->gcs,
        //     'account_number'=>$doc->account_number,
        //     'entity_id'=>$doc->entity_id,
        //     'entity_name'=>$doc->entity_name,
        //     'physical_address'=>$doc->physical_address,
        //     'delivery_address'=>$doc->delivery_address,
        //     'tax_exempt'=>$doc->tax_exempt,
        //     'tax_reference'=>$doc->tax_reference,
        //     'sales_code'=>$doc->sales_code,
        //     'discount_perc'=>$doc->discount_perc,
        //     'exchange_rate'=>$doc->exchange_rate,
        //     'terms'=>$doc->terms,
        //     'expire_delivery'=>$doc->expire_delivery,
        //     'freight_method'=>$doc->freight_method,
        //     'ship_deliver'=>$doc->ship_deliver,
        //     'journal_id'=>$type->journal_id,
        //     'action_date'=>$type->action_date,
        //     'document_number'=>$type->document_number,
        //     'document_reference'=>$type->document_reference,
        //     'reference_number'=>$type->reference_number,
        //     'user_id'=>$type->user_id,
        //     'document_type'=>$type->document_type,
        //     'inclusive'=>$type->inclusive,
        //     'note'=>$type->note,
        //     'total_nett_price'=>$type->total_nett_price,
        //     'total_excl'=>$type->total_excl,
        //     'total_discount'=>$type->total_discount,
        //     'total_tax'=>$type->total_tax,
        //     'total_amount'=>$type->total_amount,
        //     'total_due'=>$type->total_due,
        //     'total_cost'=>$type->total_cost,
        //     'is_locked'=>$type->is_locked,
        //     'is_paid'=>$type->is_paid,
        //     'period'=>0]);
        // }
    }

    public function generate()
    {
        $table = request()->input('table');
        $link = request()->input('directory');
        $directory = strtolower(str_replace(' ', '-', $link));
        $controller = ucwords(str_replace('_', ' ',$table));
        $controllerName = str_replace(' ', '', $controller).'Controller';
        $thisUrl = strtolower(str_replace('_', '-', $directory.'/'.$table));

        // Get table
        $tbl = DB::select("DESCRIBE $table");
        $model_name = str_replace(' ', '', $controller);
        //dd($tbl);
        $lang = '<?php return [';
        $validate="";
        $model="";
        $head_fields = "";
        $form_fields="";
        $form_update="";
        $dt_fields="";
        $x=1;
        foreach($tbl as $field)
        {
            if($field->Null == 'NO' && $field->Field != 'id')
            {
                $validate .= "'".$field->Field."'=>'required',\n";
                $model .="'".$field->Field."',";

            }

            if($field->Field != 'created_at' && $field->Field != 'updated_at'){
                $form_update .="\$('#".$field->Field."').val(response.data.".$field->Field.");\n\t\t\t\t\t";
            }

            if($field->Field != 'id' && $field->Field != 'created_at' && $field->Field != 'updated_at')
            {
                $f_name = $field->Field;
                $trans =$table.'.fields.'.$f_name;
                if($x<5)
                {
                    $dt_fields .="<td>{{ \$item->".$field->Field."}}</td>";
                   $head_fields .= "<th>{{__('".$trans."')}}</th>";
                }

                $switch = substr($field->Type,0,3);
                switch($switch)
                {
                    case 'int':
                        $input = '<input type="number" name="'.$f_name.'" id="'.$f_name.'" class="form-control form-control-sm">';
                        break;
                    case 'dat':
                        $input = '<input type="text" name="'.$f_name.'" id="'.$f_name.'" class="form-control date form-control-sm">';
                        break;
                    case 'big':
                        $input = '<input type="number" name="'.$f_name.'" id="'.$f_name.'" class="form-control form-control-sm">';
                        break;
                    case 'var':
                        $input = '<input type="text" name="'.$f_name.'" id="'.$f_name.'" class="form-control form-control-sm">';
                        break;
                    case 'tex':
                        $input = '<textarea name="'.$f_name.'" id="'.$f_name.'" class="form-control form-control-sm"></textarea>';
                        break;

                    default:
                    $input = '<input type="text" name="'.$f_name.'" id="'.$f_name.'" class="form-control form-control-sm">';
                }
                $lang .= "'".$f_name."'=>'".ucwords(str_replace('_', ' ',$f_name))."',\n\t";
                $group ='<div class="form-group row">
                <label class="col-md-3">{{__(\''.$trans.'\')}}</label>
                <div class="col-md-9">
                    '.$input.'
                </div>
            </div>';
                $form_fields .=$group;
            }
            $x++;
        }

        $lang .="];";
        $controller ="/** Controller **/";
        $controller .="
        /** php artisan make:controller $directory\\$controllerName --resource
        *   Route::resource('$thisUrl', '$directory\\$controllerName');
        */
        use $model_name;
        use Validator;

        public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', '".$table."_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            \$search = request('search');
            if(!empty(\$search)){
                \$data =$model_name::paginate(15);
            }else{
                \$data =$model_name::paginate(15);
            }
            return view('view.file', compact('data', 'search'));

        }

        public function store(){
            \$error = Validator::make(\\request()->all(), \$this->validateRules());
            if(\$error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                \$form_data = request()->all();
                $model_name::create(\$form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit(\$id){
            \$data = $model_name::findOrFail(\$id);
            return response()->json(['data'=>\$data]);
        }

        public function update(\$id){
            \$res = request()->all();
            \$data = $model_name::findOrFail(\$id);
            \$data->update(\$res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            \$data =[ $validate ];
            return \$data;
        }

        public function destroy(\$id)
        {
            $model_name::destroy(\$id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
        ";
        $model ="/** Model **/
        class $model_name extends Model {

            /**
             * The database table used by the model.
             *
             * @var string
             */
            protected \$table = '$table';

            /**
             * The database primary key value.
             *
             * @var string
             */
            protected \$primaryKey = 'id';

            /**
             * Un Comment if you want to use soft deletes
             *
             * @var array
             */
            protected \$fillable = [$model];
        }
        ";
        $template = Storage::get('template.blade.php');
        $template = str_replace('[model]', ucwords(str_replace('_',' ',$table)), $template);
        $template = str_replace('[form_fields]', $form_fields, $template);
        $template = str_replace('*dt_fields*', $dt_fields, $template);
        $template = str_replace(' [head_fields]', $head_fields, $template);
        $template = str_replace('[form_update]', $form_update, $template);
        $template = str_replace('[link]', $link, $template);
        $template = str_replace('thisurl', $thisUrl, $template);
        $template = str_replace('tables', $table, $template);
        $index="/** Index **/\n";
        $index .=$template;

        $txt = "# ".strtoupper($table)."\n\n# ".$controller."\n\n# ".$model."\n\n# ".$index."\n\n# ".$lang;
        Storage::put('crud_'.$table.'.md', $txt);
        return redirect()->back();
    }
}
