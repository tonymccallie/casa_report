<div class="span12">
	<h2><i class="icon-dash"></i> Dashboard</h2>
	<div class="row-fluid">
		<div class="span6">
			<h4>Work on an open timesheet</h4>
			<?php foreach($timesheets as $timesheet): ?>
			<div class="row-fluid">
				<div class="span6">
					<?php echo $this->Html->link('Edit','/timesheets/edit/'.$timesheet['Timesheet']['id'],array('class'=>'btn')).' '.$timesheet['CasaCase']['name'] ?>
				</div>
				<div class="span6">
					<?php echo date('F Y',strtotime($timesheet['Timesheet']['date'])) ?>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="span6">
			<h4>Create a new timesheet</h4>
			<?php echo $this->Html->link('New Timesheet','/timesheets/add',array('escape'=>false,'class'=>'btn btn-large')) ?>
		</div>
	</div>
</div>