<div class="admin_header">
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
			echo $this->Form->input('user_id',array('label'=>'Volunteer','options'=>$volunteers,'empty'=>'Please Choose','class'=>'span12'));
			echo $this->Form->input('supervisor_id',array('label'=>'Supervisor','options'=>$supervisors,'empty'=>'Please Choose','class'=>'span12'));
		?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('tmc',array()); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('pmc',array()); ?>
			</div>
		</div>
		<?php
			echo $this->Form->input('phone1',array('class'=>'span12'));
			echo $this->Form->input('phone2',array('class'=>'span12'));
			echo $this->Form->input('address',array('class'=>'span12'));
			echo $this->Form->input('city',array('class'=>'span12'));
		?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('state',array('class'=>'span12','options'=>Common::states())); ?>
			</div>
			<div class="span6">
				<?php echo $this->Form->input('zip',array('class'=>'span12')); ?>
			</div>
		</div>
		<?php
			echo $this->Form->input('county',array('class'=>'span12'));
		?>
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
				<div class="span4">
					<?php echo $age ?> y/o
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
		<?php echo $this->Form->submit('Save Case',array('class'=>'btn btn-primary pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end() ?>