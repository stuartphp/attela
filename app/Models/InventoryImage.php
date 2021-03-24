<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory_images';

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
    protected $fillable = ['inventory_item_id','site_image_id','file_name','sort_order',];
    public function images()
    {
        return $this->hasMany(SiteImage::class);
    }

    public function items()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id', 'id');
    }
}
