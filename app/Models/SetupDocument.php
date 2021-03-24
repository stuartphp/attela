<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetupDocument extends Model
{
    public $table = 'setup_documents';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
        'company_id',
        'user_id',
        'document_type',
        'sales_code',
        'note',
        'options',
        'project',
        'store',
        'unit_price',
        'tax_type',
        'price_excl',
        'discount_perc',
    ];
}
