<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryActivity extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory_activities';

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
    protected $fillable = ['company_id',
    'inventory_item_id',
    'action_date',
    'action',
    'document_reference',
    'store_id',
    'down',
    'up',];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function items()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id','id');
    }
}
