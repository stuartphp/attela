<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;
use App\Models\JournalEntry;
use DataTables;
use Validator;
use App\Traits\SelectJournalTrait;
class JournalEntriesController extends Controller
{
    use SelectJournalTrait;
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'journal_entries_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $keyword = request()->get('search');
            $period = explode('/', config(session()->get('company_id').'.financial_year'));
                $start=$period[0].'-03-01';
                $end = $period[1].'-03-01';
                if(!empty($keyword))
                {
                    $data = JournalEntry::where('company_id', session()->get('company_id'))
                ->whereBetween('action_date', [$start, $end])
                ->where(function($q) use($keyword){
                    $q->where('action_date', 'like', "%$keyword%")
                        ->orWhere('account_number', 'like', "%$keyword%")
                        ->orWhere('entity_name', 'like', "%$keyword%")
                        ->orWhere('description', 'like', "%$keyword%")
                        ->orWhere('reference', 'like', "%$keyword%")
                        ->orWhere('type', 'like', "%$keyword%")
                        ->orWhere('ledger', 'like', "%$keyword%")
                        ->orWhere('debit_amount', 'like', "%$keyword%")
                        ->orWhere('credit_amount', 'like', "%$keyword%");
                })
                ->paginate(20);
                }else{
                    $data = JournalEntry::where('company_id', session()->get('company_id'))
                ->whereBetween('action_date', [$start, $end])->paginate(20);
                }

            $cats = $this->getCategory();

            return view('accounting.journal-entries', compact('cats', 'data'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            JournalEntry::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = JournalEntry::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = JournalEntry::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
'transaction_flow_id'=>'required',
'action_date'=>'required',
'account_number'=>'required',
'tax_type'=>'required',
'ledger'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            JournalEntry::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
