<?php
/**
 * Created by iTec Assist
 * Website: https://itecassist.co.za
 * User: Stuart Harrison
 * Date: 2020-06-08
 * Time: 05:06:23 AM
 */

return [
	'title'=>'Activities',
	'fields'=>[
		'inventory_item_id'		=>'Inventory Item',
		'action_date'		=>'Action Date',
		'action'		=>'Action',
		'document_reference'		=>'Document Reference',
		'store_id'		=>'Store',
		'down'		=>'Down',
		'up'		=>'Up',
	],
    'action' => [
        'Adjustment'=>'Adjustment',
        'Purchased' =>'Purchased',
        'Returned'  => 'Returned',
        'Sale'      => 'Sale',
    ],
];
