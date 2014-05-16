<?php
App::uses('AppModel', 'Model');
class Report extends AppModel {
	var $order = array('Report.year' => 'desc','Report.quarter' => 'desc');
	public $hasMany = array(
		'Timesheet'
	);
}
?>