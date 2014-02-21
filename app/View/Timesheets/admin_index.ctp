<script type="text/javascript">
/* <![CDATA[ */

$(document).ready(function() {
	$('#supervisor_id').change(function() {
		var value = $(this).val();
		window.location = '<?php echo Common::currentUrl() ?>admin/timesheets/index/supervisor:'+value;
	});
});

/* ]]> */
</script>
<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Timesheets
		<div class="btn-group pull-right">
			<?php
				echo $this->Html->link('Add Timesheet', array('action' => 'add'),array('class'=>'btn','escape'=>false));
			?>
		</div>
	</h3>
</div>
<div class="">
	<?php echo $this->Form->create(); ?>
	<div class="row-fluid">
		<div class="span2">
			<?php echo $this->Form->input('name',array('label'=>false,'placeholder'=>'Name','class'=>'span12')); ?>
		</div>
		<div class="span3">
			<?php
				echo $this->Form->input('supervisor_id',array('options'=>$supervisors,'empty'=>'Filter by Supervisor','class'=>'span12','label'=>false));
			?>
		</div>
		<div class="span3">
			<?php echo $this->Form->input('date',array('label'=>false,'empty'=>'Date','dateFormat'=>'MY','minYear'=>date('Y')-10,'maxYear'=>date('Y'),'class'=>'span6')); ?>
						
		</div>
		<div class="span2">
			<?php echo $this->Form->input('archived',array('type'=>'checkbox')); ?>
		</div>
		<div class="span2">
			<?php echo $this->Form->submit('Filter',array('class'=>'btn span12')); ?>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('name','<i class="icon-sort"></i> Name',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('date','<i class="icon-sort"></i> Date',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('user_id','<i class="icon-sort"></i> Volunteer',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('submitted','<i class="icon-sort"></i> Submitted',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($timesheets as $timesheet): ?>
			<tr>
				<td>
					<?php
						$name = !empty($timesheet['CasaCase']['name'])?$timesheet['CasaCase']['name']:'<i>Untitled</i>';
						echo $this->Html->link($name,array('action'=>'edit',$timesheet['Timesheet']['id']),array('escape'=>false));
					?>
				</td>
				<td><?php echo !empty($timesheet['Timesheet']['date'])?date('M Y',strtotime($timesheet['Timesheet']['date'])):'<i>Not Set</i>' ?></td>
				<td><?php echo !empty($timesheet['CasaCase']['Volunteer']['first_name'])?$timesheet['CasaCase']['Volunteer']['first_name'].' '.$timesheet['CasaCase']['Volunteer']['last_name']:'<i>Unassigned</i>' ?></td>
				<td><?php echo !empty($timesheet['Timesheet']['submitted'])?date('M d, Y',strtotime($timesheet['Timesheet']['submitted'])):'' ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>