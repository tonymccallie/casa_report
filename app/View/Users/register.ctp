<?php echo $this->Form->create('User') ?>
<div class="span12">
	<div class="well">
		<div class="row-fluid">
			<div class="span12">
				<h2>Register a New Volunteer</h2>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="row-fluid">
					<div class="span6">
						<?php
							echo $this->Form->input('first_name',array('label' => false,'placeholder'=>'First Name','class'=>'span12'));
						?>
					</div>
					<div class="span6">
						<?php
							echo $this->Form->input('last_name',array('label' => false,'placeholder'=>'Last Name','class'=>'span12'));
						?>
					</div>
				</div>
				<?php
					echo $this->Form->input('email', array('label' => false,'placeholder'=>'Email','class'=>'span12'));
					echo $this->Form->input('passwd', array('label' => false,'placeholder'=>'Password','class'=>'span12')); 
					echo $this->Form->input('passwd_verify',array('type'=>'password','label'=>false,'placeholder'=>'Password Verify','class'=>'span12'));
					echo $this->Form->input('phone1',array('label' => false,'placeholder'=>'Phone Number','class'=>'span12'));
					echo $this->Form->input('phone2',array('label' => false,'placeholder'=>'Optional Phone Number','class'=>'span12'));		
				?>
			</div>
			<div class="span6">
				<?php
					echo $this->Form->input('dob',array('empty'=>true,'label'=>'Date of Birth','placeholder'=>'Date of Birth','class'=>'span4','maxYear'=>date('Y'),'minYear'=>date('Y')-80));
					echo $this->Form->input('gender',array('options'=>array(
						'F' => 'Female','M' => 'Male'
					),'empty'=>'Please Choose','class'=>'span12'));
				?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<?php
					echo $this->Form->submit('Send Registration',array('class'=>'btn pull-right btn-primary'));
				?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>