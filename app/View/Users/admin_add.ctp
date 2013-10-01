<?php echo $this->Form->create('User') ?>
<div class="span12">
	<div class="well">
		<div class="row-fluid">
			<div class="span12">
				<h2>Add a New Volunteer / Supervisor</h2>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->Form->input('role_id',array('options'=>$roles,'class'=>'span12')); ?>
				<div class="row-fluid">
					<div class="span6">
						<?php
							echo $this->Form->input('first_name',array('label' => 'First Name','class'=>'span12'));
						?>
					</div>
					<div class="span6">
						<?php
							echo $this->Form->input('last_name',array('label' => 'Last Name','class'=>'span12'));
						?>
					</div>
				</div>
				<?php
					echo $this->Form->input('badge', array('class'=>'span12'));
					echo $this->Form->input('email', array('label' => 'Email','class'=>'span12'));
					echo $this->Form->input('passwd', array('label' => 'Password','class'=>'span12')); 
					echo $this->Form->input('passwd_verify',array('type'=>'password','label' => 'Password Verify','class'=>'span12'));
					echo $this->Form->input('phone1',array('label' => 'Phone Number','class'=>'span12'));
					echo $this->Form->input('phone2',array('label' => 'Optional Phone Number','class'=>'span12'));
					echo $this->Form->input('address1',array('class'=>'span12'));
					echo $this->Form->input('address2',array('class'=>'span12'));
				?>
				<div class="row-fluid">
					<div class="span6">
						<?php echo $this->Form->input('city',array('class'=>'span12')); ?>
					</div>
					<div class="span6">
						<?php echo $this->Form->input('state',array('class'=>'span12','options'=>Common::states())); ?>
					</div>
				</div>
				<?php
					echo $this->Form->input('zip',array('class'=>'span12'));
				?>
			</div>
			<div class="span6">
				<?php
					echo $this->Form->input('dob',array('empty'=>true,'label'=>'Date of Birth','placeholder'=>'Date of Birth','class'=>'span4','maxYear'=>date('Y'),'minYear'=>date('Y')-80));
					echo $this->Form->input('gender',array('options'=>array(
						'F' => 'Female','M' => 'Male'
					),'empty'=>'Please Choose','class'=>'span12'));
					echo $this->Form->input('active_date',array('class'=>'span4','empty'=>true));
					echo $this->Form->input('inactive',array('class'=>'span4','empty'=>true));
					echo $this->Form->input('drivers_license_exp',array('class'=>'span4','empty'=>true));
					echo $this->Form->input('car_insurance_exp',array('class'=>'span4','empty'=>true));
					echo $this->Form->input('background_check',array('class'=>'span4','empty'=>true));
				?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<?php
					echo $this->Form->submit('Add User',array('class'=>'btn pull-right btn-primary'));
				?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>