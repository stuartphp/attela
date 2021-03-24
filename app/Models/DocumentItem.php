<?php
/**
 * Created by iTec Assist
 * Website: https://itecassist.co.za
 * User: Stuart Harrison
 * Date: 2020-06-08
 * Time: 05:06:22 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentItem extends Model
{
    //use SoftDeletes;
    public $table = 'document_items';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
        'document_id',
		'store_id',
		'item_id',
		'item_code',
		'item_description',
		'project',
		'unit',
		'quantity',
		'options',
		'unit_price',
		'tax_type',
		'price_excl',
		'discount_perc',
		'is_service',
    ];

    public function documents()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
}
