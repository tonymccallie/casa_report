<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Timesheets
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Timesheet', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('name','<i class="icon-sort"></i> Name',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('user_id','<i class="icon-sort"></i> Volunteer',array('escape'=>false)); ?>
				</th>
				<th>
					<?php echo $this->Paginator->sort('supervisor_id','<i class="icon-sort"></i> Supervisor',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($timesheets as $timesheet): ?>
			<tr>
				<td><?php echo $this->Html->link($timesheet['CasaTimesheet']['name'],array('action'=>'edit',$timesheet['CasaTimesheet']['id'])) ?></td>
				<td><?php echo $volunteers[$timesheet['CasaTimesheet']['user_id']] ?></td>
				<td><?php echo $supervisors[$timesheet['CasaTimesheet']['supervisor_id']] ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>