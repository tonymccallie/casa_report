<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Choose Case
	</h3>
	<p>Which case are you wanting to start a timesheet for?</p>
</div>
<?php foreach($cases as $case): ?>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Html->link('Start','/timesheets/add/'.$case['CasaCase']['id'],array('class'=>'btn')) ?>
		<?php echo $case['CasaCase']['name'] ?>
	</div>
</div>
<?php endforeach ?>
