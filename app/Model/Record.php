<?php
App::uses('AppModel', 'Model');
class Record extends AppModel {
	public $belongsTo = array(
		'Timesheet','Communication'
	);

	var $validate = array(
		'person' => array(
			'ruleName' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please enter the person you contacted'
			)
		),
		'communication_id' => array(
			'ruleName' => array(
				'rule' => array('notEmpty'),
				'message' => 'Please choose a communication type'
			)
		),
	);
}
?>