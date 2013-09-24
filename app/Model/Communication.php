<?php
App::uses('AppModel', 'Model');
class Communication extends AppModel {
	var $order = array('Communication.title');
	public $hasMany = array(
		'Record' => array(
			'className' => 'Record',
			'foreignKey' => 'communication_id',
			'order' => '',
			'dependent' => true //true = delete child records on delete
		),
	);
}
?>