<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisciplinaryReason extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'disciplinary_reasons';

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
    protected $fillable = ['company_id','incident','first','second','third','fourth',];
}
