<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    //use SoftDeletes;
    public $table = 'document_types';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
    		'document_id',
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

    ];

    public function documents()
    {
        return $this->hasOne(Document::class, 'document_id','id');
    }

    public function customer_docs()
    {
        return $this->belongsTo(Document::class,  'document_id','id');
    }

    public function items()
    {
        return $this->hasMany(DocumentItem::class, 'document_type_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
