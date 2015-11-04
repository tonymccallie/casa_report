<div class="admin_header">
	<div class="button-group pull-right">
		<?php echo $this->Html->link('<i class="icon-trash"></i> Delete',array('action'=>'delete',$this->data['CasaCase']['id']),array('escape'=>false,'class'=>'btn'),'Are you sure you want to delete this case?') ?>
	</div>
	<h3>
		<i class="icon-edit"></i> Edit Case
	</h3>
</div>
<?php echo $this->Form->create('CasaCase') ?>
<div class="row-fluid">
	<div class="span6">
		<h4>Case Information</h4>
		<?php
			echo $this->Form->input('id',array());
			echo $this->Form->input('name',array('class'=>'span12'));
		?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('user_id',array('label'=>'Volunteer','options'=>$volunteers,'empty'=>'Unassigned','class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('supervisor_id',array('label'=>'Supervisor','options'=>$supervisors,'empty'=>'Please Choose','class'=>'span12')); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('tmc',array()); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('pmc',array()); ?>
			</div>
		</div>
	</div>
	<div class="span6">
		<h4>Children</h4>
		<?php foreach($this->data['Child'] as $child): ?>
			<div class="row-fluid">
				<div class="span4">
					<?php
						$age = date_diff(date_create($child['dob']),date_create('now'));
						$age = $age->format('%y');
						echo $child['first_name'].' '.$child['last_name'];
					?>
				</div>
				<div class="span2">
					<?php echo $child['gender'] ?>
				</div>
				<div class="span2">
					<?php echo $age ?> y/o
				</div>
				<div class="span2">
					<?php echo !empty($child['closed'])?'<i>(closed)</i>':'' ?>
				</div>
				<div class="span2">
					<?php echo $this->Html->link('Edit','/admin/children/edit/'.$child['id'],array('class'=>'btn')) ?>
				</div>
			</div>
		<?php endforeach ?>
		<?php echo $this->Html->link('<i class="icon-plus"></i> Add Child','/admin/children/add/'.$this->data['CasaCase']['id'],array('class'=>'btn','escape'=>false)) ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h4>Latest Timesheets</h4>
		<table class="table table-striped table-bordered">
		<?php foreach($timesheets as $timesheet): ?>
			<tr>
				<td>
					<?php echo $this->Html->link(date('M Y',strtotime($timesheet['Timesheet']['date'])),'/admin/timesheets/edit/'.$timesheet['Timesheet']['id']) ?>
					<?php echo !empty($timesheet['Timesheet']['archived'])?' <i>archived</i>':'' ?>
				</td>
				<td>
					<?php echo $timesheet['User']['first_name'].' '.$timesheet['User']['last_name'] ?>
				</td>
			</tr>
		<?php endforeach ?>
		</table>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<?php echo $this->Form->input('closed',array('class'=>'span4','empty'=>true)); ?>
	</div>
	<div class="span6">
		<?php echo $this->Form->input('closed_descr',array('class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->submit('Save Case',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>