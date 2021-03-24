<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_addresses';

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
    'physical_address_unit_number',
    'physical_address_complex_name',
    'physical_address_street_number',
    'physical_address_street_name',
    'physical_address_suburb',
    'physical_address_city',
    'physical_address_code',
    'physical_address_country',
    'postal_street_box_number',
    'postal_street_post_office_name',
    'postal_suburb',
    'postal_city',
    'postal_code',
    'postal_country',
    'postal_care_of',
    'postal_care_of_details',];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
