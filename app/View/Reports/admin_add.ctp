<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Add Report
	</h3>
</div>
<div class="">
	<?php echo $this->Form->create() ?>
	<div class="row-fluid">
		<div class="span2">
			<?php echo $this->Form->input('quarter',array('class'=>'span12','options'=>array(
				1 => 'First (Sep-Nov)',
				2 => 'Second (Dec-Feb)',
				3 => 'Third (Mar-May)',
				4 => 'Fourth (Jun-Aug)'
			))); ?>
		</div>
		<div class="span2">
			<?php
				$years = array();
				for($year = date('Y'); $year >= date('Y')-5; $year--) {
					$years[$year] = $year;
				}
				echo $this->Form->input('year',array('class'=>'span12','options'=>$years));1
			?>
		</div>
	</div>
	<?php echo $this->Form->end(array('label'=>'Add Report','class'=>'btn')); ?>
</div>


