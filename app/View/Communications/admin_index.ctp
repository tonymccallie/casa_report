<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Communications
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Add Communication', array('action' => 'add'),array('class'=>'btn','escape'=>false)); ?>
		</div>
	</h3>
</div>
<div class="">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>
					<?php echo $this->Paginator->sort('title','<i class="icon-sort"></i> Type',array('escape'=>false)); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($communications as $communication): ?>
			<tr>
				<td><?php echo $this->Html->link($communication['Communication']['title'],array('action'=>'edit',$communication['Communication']['id'])) ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<?php echo $this->element('paging') ?>
</div>