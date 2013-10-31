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
			<?php echo $this->Html->link('Add Timesheet', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="">
	<div class="row-fluid">
		<div class="span4 offset8">
			<?php
				$value = !empty($this->request->params['named']['supervisor'])?$this->request->params['named']['supervisor']:'';
				echo $this->Form->input('supervisor_id',array('value'=>$value,'options'=>$supervisors,'empty'=>'Filter by Supervisor','class'=>'span12','label'=>false));
			?>
		</div>
	</div>
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
				<td><?php echo $this->Html->link($timesheet['CasaCase']['name'],array('action'=>'edit',$timesheet['Timesheet']['id'])) ?></td>
				<td><?php echo date('M Y',strtotime($timesheet['Timesheet']['date'])) ?></td>
				<td><?php echo $timesheet['CasaCase']['Volunteer']['first_name'].' '.$timesheet['CasaCase']['Volunteer']['last_name'] ?></td>
				<td><?php echo !empty($timesheet['Timesheet']['submitted'])?date('M d, Y',strtotime($timesheet['Timesheet']['submitted'])):'' ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>