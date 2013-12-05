<?php
App::uses('AppModel', 'Model');
class Report extends AppModel {
	public $hasMany = array(
		'Timesheet'
	);
}
?>