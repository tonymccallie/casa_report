<div class="admin_header">
	<?php echo $this->Html->link('<i class="icon-trash"></i>',array('action'=>'delete',$this->data['Child']['id'],$this->data['Child']['case_id']),array('escape'=>false,'class'=>'btn pull-right'),'Are you sure you want to delete this child record?') ?>
	<h3>
		<i class="icon-edit"></i> Edit Child
	</h3>
</div>
<?php
	echo $this->Form->create('Child');
		echo $this->Form->input('case_id',array('type'=>'hidden'));
		echo $this->Form->input('id',array('type'=>'hidden'));
?>
<div class="row-fluid">
	<div class="span3">
		<?php echo $this->Form->input('first_name',array('class'=>'span12')); ?>
	</div>
	<div class="span3">
		<?php echo $this->Form->input('last_name',array('class'=>'span12')); ?>
	</div>
	<div class="span6">
		<?php echo $this->Form->input('dob',array('empty'=>true,'label'=>'Date of Birth','placeholder'=>'Date of Birth','class'=>'span4','maxYear'=>date('Y'),'minYear'=>date('Y')-80)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span2">
		<?php echo $this->Form->input('tmc',array()); ?>
	</div>
	<div class="span2">
		<?php echo $this->Form->input('pmc',array()); ?>
	</div>
	<div class="span2">
		<?php echo $this->Form->input('placements',array('class'=>'span12')); ?>
	</div>
	<div class="span6">
		<?php echo $this->Form->input('placement_date',array('class'=>'span4','empty'=>true)); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span4">
		<?php
			echo $this->Form->input('gender',array('options'=>array(
				'F' => 'Female','M' => 'Male'
			),'empty'=>'Please Choose','class'=>'span12')); 
		?>
	</div>
	<div class="span4">
		<?php
			echo $this->Form->input('race',array('options'=>array(
				'African-American' => 'African-American',
				'Anglo' => 'Anglo',
				'Asian' => 'Asian',
				'Hispanic' => 'Hispanic',
				'Native American' => 'Native American',
				'Other' => 'Other'
			),'empty'=>'Please Choose','class'=>'span12')); 
		?>
	</div>
	<div class="span4">
		<?php echo $this->Form->input('abuse',array('class'=>'span12','empty'=>true,'options'=>array(
			'Sexual Assault/Abuse' => 'Sexual Assault/Abuse',
			'Family Violence' => 'Family Violence',
			'Physical Abuse/Neglect' => 'Physical Abuse/Neglect',
			'Drugs' => 'Drugs',
			'Risk' => 'Risk',
			'Survivors of Homicide Victims' => 'Survivors of Homicide Victims'
		))); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<?php
			echo $this->Form->input('placement_name',array('class'=>'span12'));
			echo $this->Form->input('phone1',array('class'=>'span12'));
			echo $this->Form->input('phone2',array('class'=>'span12'));
			echo $this->Form->input('county',array('class'=>'span12'));
			echo $this->Form->input('address',array('class'=>'span12'));
			echo $this->Form->input('city',array('class'=>'span12'));
			echo $this->Form->input('parent_attorney_contact',array('class'=>'span12'));
		?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('state',array('class'=>'span12','options'=>Common::states())); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('zip',array('class'=>'span12')); ?>
			</div>
		</div>
	</div>
	<div class="span6">
		<?php
			echo $this->Form->input('removal_reason',array('label'=>'Reason for removal','class'=>'span12','options'=>array(
				'' => 'Please Choose',
				'Physical Abuse' => 'Physical Abuse',
				'Sexual Abuse' => 'Sexual Abuse',
				'Emotional Abuse' => 'Emotional Abuse',
				'Physical Neglect' => 'Physical Neglect',
				'RAPER' => 'RAPER',
			)));
			echo $this->Form->input('therapist',array('class'=>'span12'));
			echo $this->Form->input('attorney',array('class'=>'span12'));
			echo $this->Form->input('cps_worker',array('class'=>'span12'));
			echo $this->Form->input('school',array('class'=>'span12'));
		?>
		<label>Biological Mother</label>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('bio_mother_first',array('class'=>'span12','label'=>false)); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('bio_mother_last',array('class'=>'span12','label'=>false)); ?>
			</div>
		</div>
		<label>Biological Father</label>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('bio_father_first',array('class'=>'span12','label'=>false)); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('bio_father_last',array('class'=>'span12','label'=>false)); ?>
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
	<div class="span6">
		<?php echo $this->Form->input('closed',array('class'=>'span4','empty'=>true)); ?>
	</div>
	<div class="span6">
		<?php echo $this->Form->input('closed_descr',array('class'=>'span12')); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->submit('Save Child',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>