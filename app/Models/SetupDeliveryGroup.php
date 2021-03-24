<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetupDeliveryGroup extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'setup_delivery_groups';

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
    protected $fillable = ['company_id','name','standard_rate','standard_weight_gram','additional_cost','additional_weight_per_gram',];
}
