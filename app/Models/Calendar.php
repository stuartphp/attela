<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calendars';

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
    protected $fillable = ['company_id','entity_id','entity_name','gcs','description','creator','assigned_to','status','start_date','end_date',];

    public function user_creator()
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }
    public function user_assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

}
