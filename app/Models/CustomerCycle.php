<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCycle extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_cycles';

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
    protected $fillable = ['company_id','customer_id','activity','time','frequency',];
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->where('company_id', session()->get('company_id'));
    }
}
