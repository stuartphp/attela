<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeContactDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_contact_details';

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
        'main_number',
        'email',
        'home_number',
        'work_number',
        'mobile_number',
        'fax_number',
        ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
