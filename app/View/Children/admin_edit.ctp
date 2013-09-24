<div class="admin_header">
	<?php echo $this->Html->link('<i class="icon-trash"></i>',array('action'=>'delete',$this->data['Child']['id'],$this->data['Child']['case_id']),array('escape'=>false,'class'=>'btn pull-right'),'Are you sure you want to delete this child record?') ?>
	<h3>
		<i class="icon-edit"></i> Edit Child
	</h3>
</div>
<?php echo $this->Form->create('Child') ?>
<div class="row-fluid">
	<div class="span5">
		<?php
			echo $this->Form->input('case_id',array('type'=>'hidden'));
			echo $this->Form->input('id',array('type'=>'hidden'));
		?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('first_name',array()); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('last_name',array()); ?>
			</div>
		</div>
	</div>
	<div class="span2">
		<?php
			echo $this->Form->input('gender',array('options'=>array(
				'F' => 'Female','M' => 'Male'
			),'empty'=>'Please Choose','class'=>'span12')); 
		?>
	</div>
	<div class="span5">
		<?php echo $this->Form->input('dob',array('empty'=>true,'label'=>'Date of Birth','placeholder'=>'Date of Birth','class'=>'span4','maxYear'=>date('Y'),'minYear'=>date('Y')-80)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->submit('Save Child',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>