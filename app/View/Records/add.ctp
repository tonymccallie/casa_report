<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Contact Records
	</h3>
</div>
<?php echo $this->Form->create('Record') ?>
	<?php echo $this->Form->input('timesheet_id',array('type'=>'hidden','value'=>$timesheet_id)); ?>
<div class="row-fluid">
	<div class="span6">
		<?php echo $this->Form->input('person',array('class'=>'span12')); ?>
	</div>
	<div class="span6">
		<?php echo $this->Form->input('date',array('class'=>'span4')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<?php echo $this->Form->input('communication_id',array('options'=>$communications,'empty'=>'Please Choose','class'=>'span12')); ?>
	</div>
	<div class="span6">
		<?php
			echo $this->Form->input('mileage',array('class'=>'span12'));
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h4>A. Services to the Child(ren)</h4>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>1) Visiting with the child to ensure the current placement meets child's needs and that immediate safety needs are being met.</p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('a1_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('a1_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>2) Providing educational advocacy to ensure that the child's educational needs are being met. This may involve meeting with teachers and counselors, ensuring that tutoring and special education needs are being address, etc. </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('a2_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('a2_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>3) Providing medical advocacy to ensure that the child's mental and physical needs are being met. This may involve meeting with doctors, nurses, psychologists, counselors, therapists, etc. </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('a3_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('a3_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>4) Research permanent placement options for the child to ensure long-term safety. </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('a4_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('a4_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>5) Training: Pre-service (initial training) and continuing education training. </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('a5_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('a5_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>6) VOCA documentation (case documentation, VOCA timesheets, etc). </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('a6_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('a6_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h4>B. Documentation</h4>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>Writing court reports, keeping notes, completing forms, any written other documentation. </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('b_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('b_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h4>C. Court Advocacy</h4>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>Attending court hearing, depositions, staffing with Attorney Ad Litem </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('c_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('c_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h4>D. Other / Non-Case</h4>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p>Assissting with fundraising activities, newsletter, office clerical telephone, CASA events, etc. </p>
	</div>
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('non_case_hours.0.hours',array('label'=>false,'class'=>'span12')); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('non_case_hours.0.minutes',array('label'=>false,'class'=>'span12','options'=>array(
					'.0' => '00',
					'.25' => '15',
					'.5' => '30',
					'.75' => '45'
				))); ?>
			</div>
		</div>
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