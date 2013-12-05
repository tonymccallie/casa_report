<div class="span12">
	<h2><i class="icon-dash"></i> Dashboard</h2>
	<p>Welcome to the CASA timesheet reporting site.</p>
	<?php if(Authsome::get('Role.name') == 'Supervisor'): ?>
	<div class="row-fluid">
		<div class="span12">
			<h4>Admin Functions</h4>
			<div class="btn-group">
				<?php
					echo $this->Html->link('Volunteers/Supervisors','/admin/users',array('class'=>'btn'));
					echo $this->Html->link('Cases','/admin/casa_cases',array('class'=>'btn'));
					echo $this->Html->link('Timesheets','/admin/timesheets',array('class'=>'btn'));
					echo $this->Html->link('Reports','/admin/reports',array('class'=>'btn'));
					echo $this->Html->link('Communications','/admin/communications',array('class'=>'btn'));
				?>
			</div>
		</div>
	</div>
	<?php endif ?>
	<div class="row-fluid">
		<div class="span6">
			<h4>Timesheets</h4>
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
	</div>
	<div class="row-fluid">
		<div class="span12">
			<p></p>
			<?php echo $this->Html->link('Create a New Timesheet','/timesheets/add',array('escape'=>false,'class'=>'btn btn-primary')) ?>
		</div>
	</div>
</div>