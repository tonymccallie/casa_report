<script type="text/javascript">
/* <![CDATA[ */

$(document).ready(function() {
	$('#selectall').change(function() {
		var self = this;
		$('input[type=checkbox]').each(function() {
			this.checked = self.checked;
		});
	});
});

/* ]]> */
</script>
<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> Edit Report
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-trash"></i> ', array('action' => 'delete', $this->data['Report']['id']), array('escape'=>false,'class'=>'btn'),'Are you sure you want to delete this Report'); ?>
		</div>
	</h3>
</div>
<div class="">
	<?php echo $this->Form->create() ?>
	<?php echo $this->Form->input('id',array('class'=>'span12')); ?>
	<div class="row-fluid">
		<div class="span2">
			<?php echo $this->Form->input('quarter',array('class'=>'span12','options'=>array(
				1 => 'First (Jan-Mar)',
				2 => 'Second (Apr-Jun)',
				3 => 'Third (Jul-Sep)',
				4 => 'Fourth (Oct-Dec)'
			))); ?>
		</div>
		<div class="span2">
			<?php
				$years = array();
				for($year = date('Y'); $year >= date('Y')-5; $year--) {
					$years[$year] = $year;
				}
				echo $this->Form->input('year',array('class'=>'span12','options'=>$years));1
			?>
		</div>
		<div class="span8">
			<h3>Available Timesheets</h3>
			<table class="table table-striped table-bordered">
				<tr>
					<th><input type="checkbox" id="selectall"> Name</th>
					<th>Date</th>
					<th>Submitted</th>
					<th>Edit</th>
				</tr>
				<?php foreach($timesheets as $timesheet): ?>
				<tr>
					<td><div class="input checkbox"><input type="checkbox" name="data[Timesheet][Timesheet][]" <?php echo in_array($timesheet['Timesheet']['id'], $listing)?'checked="checked"':'' ?> value="<?php echo $timesheet['Timesheet']['id'] ?>" id="TimesheetTimesheet<?php echo $timesheet['Timesheet']['id'] ?>"><label for="TimesheetTimesheet<?php echo $timesheet['Timesheet']['id'] ?>"><?php echo $timesheet['CasaCase']['name'] ?></label></div></td>
					<td><?php echo date('m/Y',strtotime($timesheet['Timesheet']['date']))?></td>
					<td><?php echo date('m/d/Y',strtotime($timesheet['Timesheet']['submitted']))?></td>
					<td><?php echo $this->Html->link('<i class="icon-edit"></i> Edit',array('controller'=>'timesheets','action'=>'edit',$timesheet['Timesheet']['id']),array('escape'=>false,'target'=>'_blank')) ?></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
	<?php echo $this->Form->end(array('label'=>'Save Report','class'=>'btn')); ?>
</div>


