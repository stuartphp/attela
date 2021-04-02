<?php

namespace App\Http\Livewire\Documents;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;

class DocumentList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'action_date';
    public $sortDirection = 'desc';
    public $sortIcon = 'bi-arrow-down-short';
    public $categories = [];
    public $search = '';
    public $page = 1;
    public $size=15;
    public $currentStep=1;
    public $maxStep = 1;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'size'
    ];

    public function mount()
    {
        $this->categories = [
            'credit_note'=>'Credit Note',
            'credit_from_supplier'=>'Credit From Supplier',
            'debit_note'=>'Debit Note',
            'goods_delivery_note'=>'Goods Delivery Note',
            'goods_received_note'=>'Goods Received Note',
            'purchase_order'=>'Purchase Order',

            'receipts'=>'Receipt',
            'return_debit'=>'Return Debit',
            'sales_order'=>'Sales Order',
            'supplier_invoice'=>'Supplier Invoice',
            'tax_invoice'=>'Tax Invoice',
        ];
    }

    public function render()
    {
        // $period = explode('/', session()->get('financial_year'));
        // $start=$period[0].'-03-01';
        // $end = $period[1].'-03-01';
        if($this->search>'')
        {
            $this->page=1;
        }
        if($this->size==''){
            $this->size=15;
        }

        $data = Document::where('company_id', session()->get('company_id'))
            ->where(function($q){
                $q->where('action_date', 'like', '%'.$this->search.'%')
                    ->orWhere('total_amount', 'like', '%'.$this->search.'%')
                    ->orWhere('account_number', 'like', '%'.$this->search.'%')
                    ->orWhere('entity_name', 'like', '%'.$this->search.'%')
                    ->orWhere('document_number', 'like', '%'.$this->search.'%')
                    ->orWhere('document_reference', 'like', '%'.$this->search.'%')
                    ->orWhere('document_type', 'like', '%'.$this->search.'%');
            });

        return view('livewire.documents.document-list', ['documents'=>$data->paginate($this->size)]);
    }

    public function doAction($id, $action)
    {
        return redirect()->to('/documents/'.$id.'/edit');
    }
}
