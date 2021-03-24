<?php
/**
 * Created by iTec Assist
 * Website: https://itecassist.co.za
 * User: Stuart Harrison
 * Date: 2020-06-08
 * Time: 05:06:21 AM
 */

return [
	'title'=>'Tasks',
	'fields'=>[
		'customer_id'		=>'Customer',
		'action_date'		=>'Action Date',
		'title'		=>'Title',
		'customer_contact_id'		=>'Customer Contact',
		'deadline'		=>'Deadline',
		'tags'		=>'Tags',
		'status'		=>'Status',
		'user_id'		=>'User',
		'assigned_to'		=>'Assigned To',
	],

    'task_status'=>[
        'open'                      =>['name'=>'Open', 'badge'=>'badge-info'],
        'call_back'                 =>['name'=>'Call back', 'badge'=>'badge-info'],
        'credit'                    =>['name'=>'Credit', 'badge'=>'badge-warning'],
        'order_problem'             =>['name'=>'Order Problem', 'badge'=>'badge-danger'],
        'pending'                   =>['name'=>'Pending', 'badge'=>'badge-warning'],
        'urgent'                    =>['name'=>'Urgent', 'badge'=>'badge-danger'],
        'waiting_for_customer'      =>['name'=>'Waiting for Customer', 'badge'=>'badge-info'],
        'waiting_for_third_party'   =>['name'=>'Waiting for Third Party', 'badge'=>'badge-info'],
        'closed'                    =>['name'=>'Closed', 'badge'=>'badge-success']
    ]
];
