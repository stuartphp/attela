<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTaskComment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_task_comments';

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
    protected $fillable = ['customer_task_id','action_date','content','status','user_id',];
}
