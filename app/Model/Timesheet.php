<?php
App::uses('AppModel', 'Model');
class Timesheet extends AppModel {
	public $belongsTo = array(
		'CasaCase' => array(
			'className' => 'CasaCase',
			'foreignKey' => 'case_id'
		),'User'
	);	
	
	public $hasMany = array(
		'Record' => array(
			'className' => 'Record',
			'foreignKey' => 'timesheet_id',
			'order' => '',
			'dependent' => true //true = delete child records on delete
		),
	);
}
?>