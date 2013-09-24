<?php
App::uses('AppModel', 'Model');
class Child extends AppModel {
	var $order = array('Child.dob' => 'desc');
	public $belongsTo = array(
		'CasaCase' => array(
			'className' => 'CasaCase',
			'foreignKey' => 'case_id'
		),
	);	
}
?>