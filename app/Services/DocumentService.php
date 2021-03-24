<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;

class DocumentService
{
    public function convert($id){
        $doc = DB::table('documents')->where('id', $id)->first();
        $items = DB::table('document_items')->where('document_id', $id)->get();
        try{
            DB::beginTransaction();
            $doc_number = DB::table('counters')->where('company_id', session()->get('company_id'))->where('name', 'tax_invoice')->first();
            $tn = $doc_number->prefix.$doc_number->number;
            DB::table('counters')->where('id', $doc_number->id)->increment('number');

            $doc->document_reference=$doc->document_number;
            $doc->document_number=$tn;
            $doc->document_type='tax_invoice';
            $doc =(array) $doc;
            unset($doc['id']);

            $document_id = DB::table('documents')->insertGetId($doc);
            foreach($items as $item)
            {
                $item->document_id = $document_id;
                $item = (array) $item;
                unset($item['id']);
                
                DB::table('document_items')->insert($item);
            }
            DB::table('documents')->where('id', $id)->update(['is_paid'=>1, 'is_locked'=>1]);

            DB::commit();
            session()->flash('success', __('global.record_updated'));
            return true;
        }catch(\Exception $e)
        {
            DB::rollBack();
            dd($e);
        }
    }
    public function create($id, $gcs, $document_type, $reference)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        try {
            DB::beginTransaction();
            // Document Type Number
            $doc_number = DB::table('counters')->where('company_id', session()->get('company_id'))->where('name', $document_type)->first();
            $tn = $doc_number->prefix.$doc_number->number;
            DB::table('counters')->where('id', $doc_number->id)->increment('number');
            // Create document
            $document = ['company_id'=>session()->get('company_id'),
            'gcs'=>$gcs,
            'account_number'=>$customer->account_number,
            'entity_id'=>$customer->id,
            'entity_name'=>$customer->description,
            'physical_address'=>$customer->physical_address,
            'delivery_address'=>$customer->delivery_address,
            'tax_exempt'=>$customer->default_tax,
            'sales_code'=>$customer->sales_person_id,
            'terms'=>$customer->payment_terms,
            'freight_method'=>'',
            'ship_deliver'=>'',
            'action_date'=>date('Y-m-d H:i:s'),
            'document_number'=>$tn,
            'document_reference'=>'',
            'reference_number'=>$reference,
            'user_id'=>\Auth::id(),
            'document_type'=>$document_type,
            'inclusive'=>1,
            'note'=>'',
            'total_nett_price'=>0,
            'total_excl'=>0,
            'total_discount'=>0,
            'total_tax'=>0,
            'total_amount'=>0,
            'total_due'=>0,
            'total_cost'=>0,
            'is_locked'=>0,
            'is_paid'=>0,
            ];
            //dd($document);
            $document_id = DB::table('documents')->insertGetId($document);
            DB::commit();
            session()->flash('success', __('global.record_added'));
            return $document_id;
        } catch (\Exception $e)
        {
            DB::rollback();
            dd($e);
            session()->flash('error', __('global.error_add'));
            return false;
        }
    }

    public function update($id, $request)
    {
        try {
            //dd($request);
            DB::beginTransaction();
            $doc = DB::table('documents')->where('id', $id)->first();
            // Delete document_items
            DB::table('document_items')->where('document_id', $id)->delete();
            $store= request('store');
            // Add Document Items
            $item_id = request('item_id');
            $item_code = request('item_code');
            $item_project = request('project');
            $item_unit = request('unit');
            $item_unit_price = request('unit_price');
            $item_options = request('options');
            $item_tax_type = request('tax_type');
            $item_price = request('price');
            $item_service = request('service');
            $item_description = request('item_description');
            $item_qty = request('qty');
            $item_disc = request('disc');
            $profit=0;
            for ($i=0; $i<count($item_id); $i++)
            {
                $tax_type = substr($item_tax_type[$i], 0,2);
                // Save item if it does not exist
                if($item_id[$i]=='blank')
                {
                    // Create Item
                    // Supplier Item
                    $new_item = [
                        'supplier_id'=>$doc->entity_id,
                        'inventory_item_id'=>0,
                        'item_code'=>$item_code[$i],
                        'description'=>$item_description[$i],
                        'unit'=>strtoupper($item_unit[$i]),
                        'currency'=>'ZAR',
                        'tax_code'=>'01',
                        'price_excl'=>$item_price[$i],
                        'price_incl'=>($item_price[$i]*session()->get('settings')['vat_percentage']),
                        'ledger_account'=>'2000000',
                        'min_order_quantity'=>1,
                    ];
                    $new_id=DB::table('supplier_items')->insertGetId($new_item);
                    $item = [
                        'document_id'=>$id,
                        'store_id'=>$store[$i],
                        'item_id'=>$new_id,
                        'item_code'=>$item_code[$i],
                        'item_description'=>$item_description[$i],
                        'project'=>$item_project[$i],
                        'unit'=>$item_unit[$i],
                        'quantity'=>$item_qty[$i],
                        'options'=>$item_options[$i],
                        'unit_price'=>($item_unit_price[$i]=='undefined')?NULL:$item_unit_price[$i],
                        'tax_type'=>$tax_type,
                        'price_excl'=>$item_price[$i],
                        'discount_perc'=>$item_disc[$i],
                        'is_service'=>$item_service[$i],
                    ];
                    DB::table('document_items')->insert($item);
                }else{
                    $item = [
                        'document_id'=>$id,
                        'store_id'=>$store[$i],
                        'item_id'=>$item_id[$i],
                        'item_code'=>$item_code[$i],
                        'item_description'=>$item_description[$i],
                        'project'=>$item_project[$i],
                        'unit'=>$item_unit[$i],
                        'quantity'=>$item_qty[$i],
                        'options'=>$item_options[$i],
                        'unit_price'=>($item_unit_price[$i]=='undefined')?NULL:$item_unit_price[$i],
                        'tax_type'=>$tax_type,
                        'price_excl'=>$item_price[$i],
                        'discount_perc'=>$item_disc[$i],
                        'is_service'=>$item_service[$i],
                    ];
                    $profit += isset($item_unit_price[$i])?($item_unit_price[$i]*$item_qty[$i]):0;
                    DB::table('document_items')->insert($item);
                }
            }
            DB::table('documents')->where('id', $id)->update([
                'action_date'=>$request['action_date'],
                'expire_delivery'=>$request['expire_delivery'],
                'reference_number'=>isset($request['reference_number'])?$request['reference_number']:$doc->reference_number,
                'total_nett_price'=>$request['nett_price'],
                'total_excl'=>$request['exclusive'],
                'total_discount'=>$request['discount'],
                'total_tax'=>$request['doc_tax'],
                'total_amount'=>$request['doc_total'],
                'total_due'=>$request['doc_total'],
                'total_cost'=>$profit,
            ]);
            DB::commit();
            session()->flash('success', __('global.record_updated'));
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            session()->flash('error', __('global.error_update'));
            return false;
        }
    }

    public function lock($id){
        try {
            DB::beginTransaction();
            $doc = DB::table('documents')->where('id', $id)->first();

            if($doc->gcs=='C')
            {
                DB::table('customers')->where('id', $doc->entity_id)->increment('current_balance', $doc->total_amount);
            }else{
                DB::table('suppliers')->where('id', $doc->entity_id)->increment('current_balance', $doc->total_amount);
            }
            // Transaction flow id
            $trans = DB::table('counters')->where('company_id', session()->get('company_id'))->where('name', 'transactions')->first();
            $flow_id = $trans->number;
            DB::table('counters')->where('id', $trans->id)->increment('number', 1);
            // Journal Entries
            if($doc->gcs=='C') {
                DB::table('journal_entries')->insert([
                    'company_id' => session()->get('company_id'),
                    'transaction_flow_id' => $flow_id,
                    'action_date' => $doc->action_date,
                    'document_id' => $id,
                    'account_number' => $doc->account_number,
                    'type'=>__('global.sales'),
                    'entity_name'=>$doc->entity_name,
                    'description' => 'Tax Invoice: ' . $doc->document_number,
                    'reference' => $doc->document_reference,
                    'tax_type' => config(session()->get('company_id').'.is_vat_registered'),
                    'ledger' => config(session()->get('company_id').'.sales_account'),
                    'debit_amount' => 0,
                    'credit_amount' => (config(session()->get('company_id').'.is_vat_registered')== 1) ? $doc->total_excl : $doc->total_amount,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                DB::table('journal_entries')->insert([
                    'company_id' => session()->get('company_id'),
                    'transaction_flow_id' => $flow_id,
                    'action_date' => $doc->action_date,
                    'document_id' => $id,
                    'account_number' => $doc->account_number,
                    'type'=>__('global.sales'),
                    'entity_name'=>$doc->entity_name,
                    'description' => $doc->entity_name . ' : ' . $doc->document_number,
                    'reference' => $doc->document_reference,
                    'tax_type' => config(session()->get('company_id').'.is_vat_registered'),
                    'ledger' => config(session()->get('company_id').'.debtor_control_account'),
                    'debit_amount' => $doc->total_amount,
                    'credit_amount' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                // Stock Sale

                $items = DB::table('document_items')->where('document_id', $id)->get();

                foreach ($items as $item)
                {
                    DB::table('inventory_activities')->insert([
                        'company_id'=>session()->get('company_id'),
                        'inventory_item_id'=>$item->item_id,
                        'action_date'=>date('Y-m-d'),
                        'action'=>'Sale',
                        'document_reference'=>$doc->document_number,
                        'store_id'=>$item->store_id,
                        'down'=>$item->quantity,
                        'up'=>0,
                    ]);
                    // Update Levels
                    DB::table('inventory_levels')->where('inventory_item_id', $item->item_id)->where('store_id', $item->store_id)->decrement('on_hand', $item->quantity);
                }


                if ( config(session()->get('company_id').'.is_vat_registered') == 1) {
                    DB::table('journal_entries')->insert([
                        'company_id' => session()->get('company_id'),
                        'transaction_flow_id' => $flow_id,
                        'action_date' => $doc->action_date,
                        'document_id' => $id,
                        'account_number' => $doc->account_number,
                        'type'=>__('global.sales'),
                        'entity_name'=>$doc->entity_name,
                        'description' => 'VAT (Output)',
                        'reference' => $doc->document_number,
                        'tax_type' => config(session()->get('company_id').'.is_vat_registered'),
                        'ledger' => config(session()->get('company_id').'.vat_output'),
                        'debit_amount' => 0,
                        'credit_amount' => $doc->total_tax,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }else{
                DB::table('journal_entries')->insert([
                    'company_id' => session()->get('company_id'),
                    'transaction_flow_id' => $flow_id,
                    'action_date' => $doc->action_date,
                    'document_id' => $id,
                    'account_number' => $doc->account_number,
                    'type'=>__('global.purchase'),
                    'entity_name'=>$doc->entity_name,
                    'description' => __('accounting_lookup.documents.'.$doc->document_type).': ' . $doc->document_number,
                    'reference' => $doc->document_reference,
                    'tax_type' => config(session()->get('company_id').'.is_vat_registered'),
                    'ledger' => config(session()->get('company_id').'.sales_account'),
                    'debit_amount' => (config(session()->get('company_id').'.is_vat_registered') == 1) ? $doc->total_excl : $doc->total_amount,
                    'credit_amount' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                DB::table('journal_entries')->insert([
                    'company_id' => session()->get('company_id'),
                    'transaction_flow_id' => $flow_id,
                    'action_date' => $doc->action_date,
                    'document_id' => $id,
                    'account_number' => $doc->account_number,
                    'type'=>__('global.purchase'),
                    'entity_name'=>$doc->entity_name,
                    'description' => $doc->entity_name . ' : ' . $doc->document_number,
                    'reference' => $doc->document_reference,
                    'tax_type' => config(session()->get('company_id').'.is_vat_registered'),
                    'ledger' => config(session()->get('company_id').'.supplier_control_account'),
                    'debit_amount' => 0,
                    'credit_amount' => $doc->total_amount,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $tax_exempt = __('accounting_lookup.tax_types.'.$doc->tax_exempt);
                if ($tax_exempt['impact']==1) {
                    DB::table('journal_entries')->insert([
                        'company_id' => session()->get('company_id'),
                        'transaction_flow_id' => $flow_id,
                        'action_date' => $doc->action_date,
                        'document_id' => $id,
                        'account_number' => $doc->account_number,
                        'entity_name'=>$doc->entity_name,
                        'type'=>__('global.purchase'),
                        'description' => 'VAT (Input)',
                        'reference' => $doc->document_number,
                        'tax_type' => config(session()->get('company_id').'.is_vat_registered'),
                        'ledger' => config(session()->get('company_id').'.vat_input'),
                        'debit_amount' => $doc->total_tax,
                        'credit_amount' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }

            }
            DB::table('documents')->where('id', $id)->update(['is_locked'=>1]);
            DB::commit();
            session()->flash('success', __('global.record_updated'));
        } catch (\Exception $e)
        {
            DB::rollBack();
            dd($e);
        }

    }
}

