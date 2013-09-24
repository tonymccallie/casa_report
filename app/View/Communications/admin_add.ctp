<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Add Communication Type
	</h3>
</div>
<?php echo $this->Form->create('Communication') ?>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->input('title',array('class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->submit('Add Communication Type',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>