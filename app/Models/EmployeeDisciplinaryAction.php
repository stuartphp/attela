<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDisciplinaryAction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_disciplinary_actions';

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
    protected $fillable = [
        'employee_id',
        'action_date',
	'incident',
	'disciplinary_reasons_id',
    'expire_date',];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function reason()
    {
        return $this->belongsTo(DisciplinaryReason::class,  'disciplinary_reasons_id','id');
    }

}
