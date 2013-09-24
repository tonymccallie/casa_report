<?php
App::uses('AppModel', 'Model');
class Record extends AppModel {
	public $belongsTo = array(
		'Timesheet','Communication'
	);

	
}
?>