<?php
App::uses('AppModel', 'Model');
class CasaCase extends AppModel {
	public $useTable = 'cases';
	public $belongsTo = array(
		'Volunteer' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'sort' => array(
				'User.first_name' => 'asc',
				'User.last_name' => 'asc',
			)
		),
		'Supervisor' => array(
			'className' => 'User',
			'foreignKey' => 'supervisor_id',
			'sort' => array(
				'User.first_name' => 'asc',
				'User.last_name' => 'asc',
			)
		),
	);

	public $hasMany = array(
		'Child' => array(
			'className' => 'Child',
			'foreignKey' => 'case_id',
			'dependent' => true //true = delete child records on delete
		),
		'Timesheet' => array(
			'className' => 'Timesheet',
			'foreignKey' => 'case_id',
			'order' => '',
			'dependent' => true //true = delete child records on delete
		),
	);
}
?>