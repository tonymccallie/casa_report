<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Edit Timesheet
	</h3>
</div>
<?php echo $this->Form->create('Timesheet') ?>
<?php echo $this->Form->input('id',array()); ?>
<div class="row-fluid">
	<div class="span6">
		<h4>Case Info</h4>
		<div class="row-fluid">
			<div class="span2">
				Name:
			</div>
			<div class="span10">
				<?php echo $this->data['CasaCase']['name'] ?>
			</div>
		</div>
		<h4>Children</h4>
		<?php foreach($this->data['CasaCase']['Child'] as $child): ?>
			<div class="row-fluid">
				<div class="span6">
					<?php
						$age = date_diff(date_create($child['dob']),date_create('now'));
						$age = $age->format('%y');
						echo $child['first_name'].' '.$child['last_name'];
					?>
				</div>
				<div class="span2">
					<?php echo $child['gender'] ?>
				</div>
				<div class="span4">
					<?php echo $age ?> y/o
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<div class="span6">
		<?php echo $this->Form->input('date',array('label'=>'Timesheet month','empty'=>true,'dateFormat'=>'MY','minYear'=>date('Y')-10,'maxYear'=>date('Y'))); ?>
		<h4>Checklist</h4>
		<?php
			echo $this->Form->input('check_child',array('label'=>'Child'));
			echo $this->Form->input('check_caseworker',array('label'=>'DFPS Caseworker'));
			echo $this->Form->input('check_provider',array('label'=>'Placement Provider'));
			echo $this->Form->input('check_supervisor',array('label'=>'CASA Supervisor'));
			echo $this->Form->input('check_teachers',array('label'=>'Therapist / Teachers'));
			echo $this->Form->input('check_attorney',array('label'=>'Attorney ad litem'));
			echo $this->Form->input('check_family',array('label'=>'Family Members'));
			echo $this->Form->input('check_ppt',array('label'=>'PPT Meeting'));
			echo $this->Form->input('check_court',array('label'=>'Court Hearing'));
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h4>Contact Log</h4>
		<div class="row-fluid">
			<div class="span2">
				Date:
			</div>
			<div class="span2">
				Person:
			</div>
			<div class="span2">
				Type:
			</div>
			<div class="span2">
				Case Hours
			</div>
			<div class="span2">
				Non-Case Hours
			</div>
			<div class="span2">
				Mileage
			</div>
		</div>
		<?php foreach($this->data['Record'] as $record): ?>
			<div class="row-fluid">
				<div class="span2">
					<?php echo date('M jS', strtotime($record['date'])) ?>
				</div>
				<div class="span2">
					<?php echo $record['person'] ?>
				</div>
				<div class="span2">
					<?php echo $record['Communication']['title'] ?>
				</div>
				<div class="span2">
					<?php echo $record['case_hours'] ?>
				</div>
				<div class="span2">
					<?php echo $record['non_case_hours'] ?>
				</div>
				<div class="span2">
					<?php echo $record['mileage'] ?>
				</div>
			</div>
			<?php if(!empty($record['notes'])): ?>
			<div class="row-fluid">
				<div class="span11 offset1">
					<i>Contact notes: <?php echo $record['notes'] ?></i>
				</div>
			</div>
			<?php endif ?>
		<?php endforeach ?>
		<?php echo $this->Html->link('Add Contact','/records/add/'.$this->data['Timesheet']['id'],array('class'=>'btn btn-primary')) ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->input('notes',array('label'=>'Timesheet Notes','class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->submit('Save Timesheet',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>