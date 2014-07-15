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
		<table class="table table-striped table-bordered">
			<tr>
				<th>
					Name
				</th>
				<th>
					Gender
				</th>
				<th>
					Age
				</th>
			</tr>
		<?php foreach($this->data['CasaCase']['Child'] as $child): ?>
			<tr>
				<td>
					<?php
						$age = date_diff(date_create($child['dob']),date_create('now'));
						$age = $age->format('%y');
						echo $child['first_name'].' '.$child['last_name'];
					?>
				</td>
				<td>
					<?php echo $child['gender'] ?>
				</td>
				<td>
					<?php echo $age ?> y/o
				</td>
			</tr>
		<?php endforeach ?>
		</table>
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
		<table class="table table-striped table-bordered">
			<tr>
				<th>
					Date:
				</th>
				<th>
					Person:
				</th>
				<th>
					Type:
				</th>
				<th class="hidden-phone">
					Case Hours
				</div>
				<th class="hidden-phone">
					Non-Case Hours
				</th>
				<th class="hidden-phone">
					Mileage
				</th>
			</tr>
		<?php foreach($this->data['Record'] as $record): 
				if(!empty($record['notes'])) {
					$rowspan = 'rowspan="2"';
				} else {
					$rowspan = '';
				}
		?>
			<tr>
				<td <?php echo $rowspan ?>>
					<?php echo $this->Html->link('<i class="icon-edit"></i>','/records/edit/'.$record['id'],array('escape'=>false,'class'=>'btn')) ?>
					<?php echo date('M jS', strtotime($record['date'])) ?>
				</td>
				<td>
					<?php echo $record['person'] ?>
				</td>
				<td>
					<?php echo $record['Communication']['title'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['case_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['non_case_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['mileage'] ?>
				</div>
			</tr>
			<?php if(!empty($record['notes'])): ?>
			<tr>
				<td colspan="5">
					<i>Notes: <?php echo $record['notes'] ?></i>
				</td>
			</tr>
			<?php endif ?>
		<?php endforeach ?>
		</table>
		<?php echo $this->Html->link('Add Contact','/records/add/'.$this->data['Timesheet']['id'],array('class'=>'btn btn-primary')) ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->input('notes',array('label'=>'Timesheet Notes','class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4 offset8">
		<?php echo $this->Form->input('signature',array('class'=>'span12 pull-right')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="btn-group pull-right">
			<?php
				echo $this->Form->submit('Submit Timesheet',array('class'=>'btn','name'=>'data[Timesheet][submit]','div'=>false));
				echo $this->Form->submit('Save Timesheet',array('class'=>'btn btn-primary','div'=>false));
			?>
		</div>
	</div>
</div>
<?php echo $this->Form->end() ?>