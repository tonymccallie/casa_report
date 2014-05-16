<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Report
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Report', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('quarter','<i class="icon-sort"></i> Report Date',array('escape'=>false)); ?>
				</th>
				<th>Timesheets</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($reports as $report): ?>
			<tr>
				<td><?php echo $report['Report']['quarter'].'/'.$report['Report']['year'] ?></td>
				<td><?php echo count($report['Timesheet']) ?></td>
				<th>
					<div class="btn-group">
						<?php echo $this->Html->link('<i class="icon-edit"></i> Edit',array('action'=>'edit',$report['Report']['id']),array('escape'=>false,'class'=>'btn')) ?>
						<?php echo $this->Html->link('<i class="icon-search"></i> View',array('action'=>'view',$report['Report']['id']),array('escape'=>false,'class'=>'btn')) ?>
					</div>
				</th>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>