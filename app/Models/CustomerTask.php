<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTask extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_tasks';

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
    protected $fillable = ['customer_id','action_date','title','customer_contact_id','deadline','status','user_id','assigned_to',];
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->where('company_id', session()->get('company_id'));
    }
}
