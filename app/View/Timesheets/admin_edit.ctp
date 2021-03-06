<?php
	$case_hours = 0;
	$non_case_hours = 0;
	$mileage = 0;
	$b_hours = 0;
	$c_hours = 0;
?>
<div class="admin_header row-fluid">
	<div class="span12">
		<h3>
			<i class="icon-edit"></i> Admin View: Edit Timesheet
			<div class="button-group pull-right">
				<?php echo $this->Html->link('<i class="icon-trash"></i> Delete',array('action'=>'delete',$this->data['Timesheet']['id']),array('escape'=>false,'class'=>'btn'),'Are you sure you want to delete this timesheet?') ?>
			</div>
		</h3>
	</div>
</div>
<?php echo $this->Form->create('Timesheet') ?>
<?php echo $this->Form->input('id',array()); ?>
<div class="row-fluid">
	<div class="span6">
		<h4>Archive?</h4>
		<?php echo $this->Form->input('archived',array('label'=>'Archive this timesheet?','type'=>'checkbox')); ?>
		<h4>Case Info</h4>
		<div class="row-fluid">
			<div class="span2">
				Name:
			</div>
			<div class="span10">
				<?php echo $this->Html->link('<i class="icon-edit"></i> '.$this->data['CasaCase']['name'],'/admin/casa_cases/edit/'.$this->data['CasaCase']['id'],array('escape'=>false)) ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span2">
				Supervisor:
			</div>
			<div class="span10">
				<?php echo $this->data['CasaCase']['Supervisor']['first_name'].' '.$this->data['CasaCase']['Supervisor']['last_name'] ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span2">
				Advocate:
			</div>
			<div class="span10">
				<?php echo $this->data['CasaCase']['Volunteer']['first_name'].' '.$this->data['CasaCase']['Volunteer']['last_name'] ?>
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
					A1
				</th>
				<th class="hidden-phone">
					A2
				</th>
				<th class="hidden-phone">
					A3
				</th>
				<th class="hidden-phone">
					A4
				</th>
				<th class="hidden-phone">
					A5
				</th>
				<th class="hidden-phone">
					A6
				</th>
				<th class="hidden-phone">
					B
				</th>
				<th class="hidden-phone">
					C
				</th>
				<th class="hidden-phone">
					D / Non-Case Hours
				</th>
				<th class="hidden-phone">
					Total VOCA
				</div>
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
				if(!empty($record['case_hours'])){$case_hours += $record['case_hours'];}
				if(!empty($record['non_case_hours'])){$non_case_hours += $record['non_case_hours'];}
				if(!empty($record['mileage'])){$mileage += $record['mileage'];}
		?>
			<tr>
				<td <?php echo $rowspan ?>>
					<?php echo $this->Html->link('<i class="icon-edit"></i>','/admin/records/edit/'.$record['id'],array('escape'=>false,'class'=>'btn')) ?>
					<?php echo date('M jS', strtotime($record['date'])) ?>
				</td>
				<td>
					<?php echo $record['person'] ?>
				</td>
				<td>
					<?php echo $record['Communication']['title'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['a1_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['a2_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['a3_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['a4_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['a5_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['a6_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['b_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['c_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['non_case_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['case_hours'] ?>
				</td>
				<td class="hidden-phone">
					<?php echo $record['mileage'] ?>
				</div>
			</tr>
			<?php if(!empty($record['notes'])): ?>
			<tr>
				<td colspan="13">
					<i>Notes: <?php echo $record['notes'] ?></i>
				</td>
			</tr>
			<?php endif ?>
			<?php
				$b_hours+=$record['b_hours'];
				$c_hours+=$record['c_hours'];
			?>
		<?php endforeach ?>
			<tr>
				<td colspan="11" align="right">Totals:</td>
				<td><?php echo $non_case_hours ?></td>
				<td><?php echo $case_hours ?></td>
				<td><?php echo $mileage ?></td>
			</tr>
		</table>
		<?php echo $this->Html->link('Add Contact','/admin/records/add/'.$this->data['Timesheet']['id'],array('class'=>'btn btn-primary')) ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->input('notes',array('label'=>'Volunteer Notes','class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->input('admin_notes',array('label'=>'Supervisor Notes','class'=>'span12')); ?>
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
				echo $this->Form->submit('Save Timesheet',array('class'=>'btn btn-primary','div'=>false));
			?>
		</div>
	</div>
</div>
<?php echo $this->Form->end() ?>