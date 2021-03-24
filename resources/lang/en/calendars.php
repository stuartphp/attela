<?php
/**
 * Created by iTec Assist
 * Website: https://itecassist.co.za
 * User: Stuart Harrison
 * Date: 2020-06-08
 * Time: 05:06:21 AM
 */

return [
	'title'=>'Calendar',
	'fields'=>[
		'entity_id'		=>'Entity Id',
		'entity_name'		=>'Entity Name',
		'gcs'		=>'Gcs',
		'description'		=>'Description',
		'creator'		=>'Creator',
		'assigned_to'		=>'Assigned To',
		'subject'		=>'Subject',
		'comment'		=>'Comment',
		'status'		=>'Status',
		'start_date'		=>'Start Date',
		'end_date'		=>'End Date',
	],
    'gcs'=>[
        'A' =>'All',
        'P' =>'For Me',
        'C'=>'Customers',
        'S'=>'Suppliers'
    ],

    'customer'  =>'Customer',
    'supplier'  =>'Supplier',
];
