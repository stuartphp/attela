<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEmergencyContact extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_emergency_contacts';

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
    protected $fillable = ['employee_id',
    'name',
    'email',
    'relationship',
    'work_number',
    'home_number',
    'mobile_number',
    'address',];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
