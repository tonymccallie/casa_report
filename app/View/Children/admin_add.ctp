<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Add Child
	</h3>
</div>
<?php echo $this->Form->create('Child') ?>
<div class="row-fluid">
	<div class="span5">
		<?php
			echo $this->Form->input('case_id',array('value'=>$case_id,'type'=>'hidden'));
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
		<?php echo $this->Form->submit('Next',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>