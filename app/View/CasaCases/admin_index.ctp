<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Cases
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Case', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="">
	<?php echo $this->element('search') ?>
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
		<?php foreach($cases as $case): ?>
			<tr>
				<td><?php echo $this->Html->link('<i class="icon-edit"></i> '.$case['CasaCase']['name'],array('action'=>'edit',$case['CasaCase']['id']),array('escape'=>false)) ?></td>
				<td><?php echo !empty($case['CasaCase']['user_id'])?$volunteers[$case['CasaCase']['user_id']]:'<i>Unassigned</i>' ?></td>
				<td><?php echo !empty($case['CasaCase']['supervisor_id'])?$supervisors[$case['CasaCase']['supervisor_id']]:'<i>Unassigned</i>' ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>