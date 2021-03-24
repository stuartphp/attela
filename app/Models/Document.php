<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'documents';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Un Comment if you want to use soft deletes
     *
     * @var array
     */
    protected $fillable = [
    'company_id',
    'gcs',
    'account_number',
    'entity_id',
    'entity_name',
    'physical_address',
    'delivery_address',
    'tax_exempt',
    'tax_reference',
    'sales_code',
    'discount_perc',
    'exchange_rate',
    'terms',
    'expire_delivery',
    'freight_method',
    'ship_deliver',
    'journal_id',
    'action_date',
    'document_number',
    'document_reference',
    'reference_number',
    'user_id',
    'document_type',
    'inclusive',
    'note',
    'total_nett_price',
    'total_excl',
    'total_discount',
    'total_tax',
    'total_amount',
    'total_due',
    'total_cost',
    'is_locked',
    'is_paid',
    'period',];

    function tax_invoices()
    {
        return $this->belongsTo(DocumentType::class, 'id', 'document_id');
    }
    public function types()
    {
        return $this->belongsTo(DocumentType::class, 'id', 'document_id');
    }
}
