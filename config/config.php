<?php

return [
    'subject' => [
        'prefix' => '[Issue Registration]'
    ],
    'emails' => [
        'to'   => ['newuser@localhost.com','testUser@localhost.com','nonexistent@localhost.com'],
        'from' => 'Admin@localhost.com'
    ],
    'messages' => [
        'error'   => 'There was a problem registering your issue.',
        'success' => 'Your issue has been registered succesfully.'
    ],
    'fields' => [
        'name'     => 'Name',
        'designation'    => 'Designation',
        'employee_id'    => 'Employee Code',
        'department'  => 'Department',
        'work' => 'Work',
		'description' => 'Issue Description',
		'submit' => 'Submit'
    ],
	'work_fields' => [
        '1'     => 'AC',
        '2'    => 'Electrical',
        '3'    => 'Vehicle Maintenance'
    ]
];
?>