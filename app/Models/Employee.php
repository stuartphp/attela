<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
             * The database table used by the model.
             *
             * @var string
             */
            protected $table = 'employees';

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
                'company_id',
'certificate_number',
'type_of_certificate',
'nature_of_person',
'employee_code',
'image',
'title',
'surname',
'first_name',
'second_name',
'initials',
'known_as',
'gender',
'id_number',
'passport_number',
'passport_country',
'date_of_birth',
'is_asylum_seeker',
'asylum_permin',
'tax_reference_number',
'tax_type',
'directive_1',
'directive_2',
'directive_3',
'reason_no_uif',
'retired',
'registered_medical_aid',
'medical_aid_members',
'is_active',
'physical_address_unit_number',
'physical_address_complex_name',
'physical_address_street_number',
'physical_address_street_name',
'physical_address_suburb',
'physical_address_city',
'physical_address_code',
'physical_address_country',
'postal_address_type',
'postal_postbox_type',
'postal_number',
'postal_agency',
'postal_post_office_name',
'postal_unit_numer',
'postal_complex_name',
'postal_street_number',
'postal_street_name',
'postal_suburb',
'postal_city',
'postal_code',
'postal_country',
'postal_care_of',
'postal_care_of_details',
'work_unit_number',
'work_complex_name',
'work_street_number',
'work_street_name',
'work_suburb',
'work_city',
'work_code',
'work_country',
'contact_mobile_number',
'contact_email',
'contact_home_number',
'contact_work_number',
'contact_fax_number',
'emergency_name',
'emergency_number1',
'emergency_number2',
            ];
}
