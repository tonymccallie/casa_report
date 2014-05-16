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
				1 => 'First (Jan-Mar)',
				2 => 'Second (Apr-Jun)',
				3 => 'Third (Jul-Sep)',
				4 => 'Fourth (Oct-Dec)'
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


