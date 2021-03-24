<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
    protected $fillable = ['company_id',
    'account_number',
    'description',
    'physical_address1',
    'physical_address2',
    'physical_suburb',
    'physical_city',
    'physical_province',
    'physical_country',
    'physical_code',
    'delivery_address1',
    'delivery_address2',
    'delivery_suburb',
    'delivery_city',
    'delivery_province',
    'delivery_country',
    'delivery_code',
    'category',
    'contact_person',
    'telephone',
    'fax',
    'mobile_phone',
    'email',
    'credit_limit',
    'current_balance',
    'currency_code',
    'payment_terms',
    'is_open_item',
    'delivery_group_id',
    'vat_reference',
    'default_tax',
    'accept_electronic_document',
    'documents_contact',
    'documents_email',
    'statement_message',
    'statement_contact',
    'statement_email',
    'price_list',
    'sales_person_id',
    'discount',
    'psw',
    'password',
    'twitter_id',
    'facebook_id',
    'is_active',];
}
