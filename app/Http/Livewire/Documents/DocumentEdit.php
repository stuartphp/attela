<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Models\DocumentItem;
use App\Models\Customer;
use App\Models\InventoryItem;
use App\Models\Supplier;
use App\Models\InventoryUnit;
use App\Models\Store;

class DocumentEdit extends Component
{
    public $doc_id;
    protected $listUnits=[];
    protected $listVat=[];
    public $searchItem;
    public $searchItemResult =[];
    public $editAddress;
    public $editAddressField;
    public $physical_address;
    public $delivery_address;
    public $stores=[];
    public $store;
    public $document=[];
    public $items;
    public $entity=[];
    public $color;
    public $type;
    public $doc_number;
    public $entity_name;
    public $credit_limit;
    public $balance;
    public $available;
    public $qty=0;
    public $nett=0;
    public $discount=0;
    public $sub_total=0;
    public $total=0;
    public $vat=0;
    protected $listeners = ['searchItem'=>'updThis'];



    public function mount($doc_id)
    {
        $this->searchItem='';
        $this->doc_id=$doc_id;
        $this->document = Document::findOrFail($this->doc_id)->toArray();
        $this->color=$this->getColor($this->document['document_type']);
        $this->entity_name = $this->document['entity_name'];
        $this->type = __('documents.documents.'.$this->document['document_type']);
        $this->doc_number = $this->document['document_number'];
        $this->entity=$this->getEntity($this->document['gcs'], $this->document['entity_id']);
        $this->credit_limit = $this->entity['credit_limit'];
        $this->balance = $this->entity['current_balance'];
        $this->available = ($this->credit_limit-$this->balance);
        $this->physical_address = $this->document['physical_address'];
        $this->delivery_address = $this->document['delivery_address'];
        $this->items = DocumentItem::where('document_id', $this->doc_id)->get()->toArray();
        $this->stores = Store::where('company_id', session()->get('company_id'))->pluck('name', 'id')->toArray();
        $this->store = array_key_first($this->stores);
        $this->listUnits = $this->getUnits();
        $this->listVat = $this->getVat();
        $this->doCalculation($this->items);
    }

    public function hydrate()
    {
        $this->listUnits= $this->getUnits();
        $this->listVat = array(
            '00'    =>'NON VAT Vendor',
            '01'    =>'VAT Standard',
            '02'    =>'Zero Rated',
            '03'    =>'Exempt',
            '04'    =>'Bad',
            '05'    =>'Capital',
            '06'    =>'VAT Adjustment',
            '07'    =>'Account Exceed 45',
            '08'    =>'Account Less 45',
            '09'    =>'Export',
            '10'    =>'Change'
        );
    }

    public function updatedSearchItem()
    {
        if(strlen($this->searchItem)>1)
        {
            // return $this->searchItemResult = InventoryItem::join('inventory_prices', 'inventory_prices.inventory_item_id', '=', 'inventory_items.id')
            // ->where('company_id', session()->get('company_id'))
            // ->where('inventory_prices.store_id', $this->store)
            // ->where(function($q){
            //     $q->where('description', 'like', '%'.$this->searchItem.'%')
            //         ->orWhere('item_code', 'like', '%'.$this->searchItem.'%')
            //         ->orWhere('barcode', 'like', '%'.$this->searchItem.'%')
            //         ->orWhere('dictation', 'like', '%'.$this->searchItem.'%')
            //         ->orWhere('keywords', 'like', '%'.$this->searchItem.'%')
            //         ->orWhere('tags', 'like', '%'.$this->searchItem.'%');
            // })
            // ->where('is_active', 1)
            // ->orderBy('description')
            // ->limit(10)
            // ->get()
            // ->toArray();
            $item_list=[];
            $items = DB::select("SELECT inventory_items.id, inventory_items.description FROM `inventory_items` inner join inventory_prices on inventory_item_id= inventory_items.id where company_id=".session()->get('company_id')." and inventory_prices.store_id=".$this->store." and (description LIKE '%".$this->searchItem."%' OR item_code LIKE '%".$this->searchItem."%' OR barcode LIKE '%".$this->searchItem."%' OR dictation LIKE '%".$this->searchItem."%' OR keywords LIKE '%".$this->searchItem."%' OR tags LIKE '%".$this->searchItem."%')");
            foreach($items as $item)
            {
                $item_list[$item->id]=$item->description;
            }
            return $this->searchItemResult =$item_list;
        }

    }

    public function editAddress($field)
    {
        $this->editAddressField=$field;
    }

    public function saveAddress()
    {
        $this->editAddressField='';
    }
    public function addItem($id){
        $add_line=true;
        for($i=0; $i<count($this->items); $i++)
        {
            if($this->items[$i]['item_id']==$id)
            {
                $add_line=false; 
                $qty = $this->items[$i]['quantity'];
                $this->items[$i]['quantity']=$qty+1;
            }
        }

        if($add_line==true)
        {

            // $item = InventoryItem::with(['prices'=>function($q){
            //     $q->where('store_id', $this->store);
            // }])

                // ->find($id);
            $item = DB::select("SELECT inventory_items.*, inventory_prices.cost_price, inventory_prices.".$this->entity['price_list']." as price FROM `inventory_items` inner join inventory_prices on inventory_item_id= inventory_items.id where inventory_items.id=$id and inventory_prices.store_id=".$this->store."");
                //dd($item);

            $arr = [
                'store_id'=>$this->store,
                'item_id'=>$id,
                'item_code'=>$item[0]->item_code,
                'item_description'=>$item[0]->description,
                'project'=>'',
                'unit'=>$item[0]->unit,
                'quantity'=>1,
                'options'=>'',
                'unit_price'=>$item[0]->cost_price,
                'tax_type'=>$item[0]->sales_tax_type ,
                'price_excl'=>$item[0]->price,
                'discount_perc'=>NULL,
                'is_service'=>$item[0]->is_service,
            ];
            array_push($this->items, $arr);
        }

        $this->items = array_values($this->items);
        $this->doCalculation($this->items);
        $this->searchItem='';
    }

    public function getUnits()
    {
        return InventoryUnit::whereIn('company_id', [0, session()->get('company_id')])->orderBy('name', 'desc')->pluck('name', 'name')->toArray();
    }

    public function getVat()
    {
        return array(
            '00'    =>'NON VAT Vendor',
            '01'    =>'VAT Standard',
            '02'    =>'Zero Rated',
            '03'    =>'Exempt',
            '04'    =>'Bad',
            '05'    =>'Capital',
            '06'    =>'VAT Adjustment',
            '07'    =>'Account Exceed 45',
            '08'    =>'Account Less 45',
            '09'    =>'Export',
            '10'    =>'Change'
        );
    }

    public function render()
    {
        return view('livewire.documents.document-edit', ['items'=>$this->items, 'listUnits'=>$this->listUnits, 'listVat'=>$this->listVat]);
    }

    public function getColor($document_type)
    {
        switch($document_type){
            case 'tax_invoice':
                return '#F3FCF3';
                break;
            default:
                return '#F3FCF3';
        }
    }

    public function getEntity($gcs, $id){
        switch($gcs)
        {
            case 'C':
                return Customer::findOrFail($id)->toArray();
                break;
            case 'S':
                return Supplier::findOrFail($id)->toArray();
                break;
        }
    }


    public function deleteItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->doCalculation($this->items);
    }

    public function updateItem()
    {
        $this->items = array_values($this->items);
        $this->doCalculation($this->items);
    }

    public function doCalculation($items)
    {
        $this->sub_total=0;
        $this->total=0;
        $this->discount=0;
        $this->vat=0;
        $this->nett=0;
        $this->qty=0;
        foreach($items as $item)
        {
            $this->qty +=$item['quantity'];
            $this->nett += ($item['quantity'] * $item['price_excl']);
            $this->discount += ($item['quantity'] * $item['discount_perc']);
            $value = $item['quantity'] * ($item['price_excl'] - $item['discount_perc']);
            $this->vat +=$this->vatCalc($item['tax_type'], $value);
        }
        $this->sub_total = $this->nett-$this->discount;
        $this->total = $this->sub_total + $this->vat;
    }

    public function vatCalc($tax_type, $value)
    {
        $tax_rate = __('accounting_lookup.vat.reverse');
        switch($tax_type)
        {
            case '00':
                //$this->vat += ($value * $tax_rate);
                break;
            case '01':
                return ($value * $tax_rate);

                break;
            case '08':
                return ($value * $tax_rate);
                break;
            case '09':
                return ($value * $tax_rate);
                break;
            case '10':
                return ($value * $tax_rate);
                break;
            default:
                return 0;
                break;
        }
    }
}
