<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Contact Records
	</h3>
</div>
<?php echo $this->Form->create('Record') ?>
	<?php echo $this->Form->input('timesheet_id',array('type'=>'hidden','value'=>$timesheet_id)); ?>
<div class="row-fluid">
	<div class="span4">
		<?php echo $this->Form->input('person',array('class'=>'span12')); ?>
	</div>
	<div class="span4">
		<?php echo $this->Form->input('date',array('class'=>'span4')); ?>
	</div>
	<div class="span4">
		<?php echo $this->Form->input('communication_id',array('options'=>$communications,'empty'=>'Please Choose','class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<?php
			echo $this->Form->input('case_hours',array('class'=>'span12'));
		?>
	</div>
	<div class="span4">
		<?php
			echo $this->Form->input('non_case_hours',array('class'=>'span12'));
		?>
	</div>
	<div class="span4">
		<?php
			echo $this->Form->input('mileage',array('class'=>'span12'));
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->input('notes',array('class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->submit('Add Contact Record',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>