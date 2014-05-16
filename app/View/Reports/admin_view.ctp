<?php
	$caseids = array();
	$cases = array(
		'opened' => 0,
		'open' => 0,
		'closed' => 0,
		'novolunteer' => 0,
		'hadvolunteer' => 0,
		'counties' => array()
	);
	$children = array(
		'opened' => 0,
		'open' => 0,
		'closed' => 0,
		'tmc' => 0,
		'pmc' => 0,
		'gender' => array(
			'male' => 0,
			'female' => 0,
			'unknown' => 0
		),
		'age' => array(
			'5' => 0,
			'6' => 0,
			'13' => 0,
			'18' => 0,
			'unknown' => 0
		),
		'ethnicity' => array(
			'African-American' => 0,
			'Anglo' => 0,
			'Asian' => 0,
			'Hispanic' => 0,
			'Native American' => 0,
			'Other' => 0,
			'Ethnicity Unknown' => 0
		),
		'counties' => array()
	);
	
	switch($report['Report']['quarter']) {
		case 1:
			$quarter = 'First';
			$start_date = strtotime($report['Report']['year'].'-01-01');
			$stop_date = strtotime($report['Report']['year'].'-03-31');
			break;
		case 2:
			$quarter = 'Second';
			$start_date = strtotime($report['Report']['year'].'-04-01');
			$stop_date = strtotime($report['Report']['year'].'-06-30');
			break;
		case 3:
			$quarter = 'Third';
			$start_date = strtotime($report['Report']['year'].'-07-01');
			$stop_date = strtotime($report['Report']['year'].'-09-30');
			break;
		case 4:
			$quarter = 'Fourth';
			$start_date = strtotime($report['Report']['year'].'-10-01');
			$stop_date = strtotime($report['Report']['year'].'-12-31');
			break;	
	}
	
	foreach($report['Timesheet'] as $timesheet) {
		if(!in_array($timesheet['CasaCase']['id'], $caseids)) {
			array_push($caseids, $timesheet['CasaCase']['id']);
			
			//update case stats
			$timesheet['CasaCase']['county'] = ($timesheet['CasaCase']['county']=='')?'UNKNOWN':strtoupper(trim($timesheet['CasaCase']['county']));
			
			if(!isset($cases['counties'][$timesheet['CasaCase']['county']])) {
				$cases['counties'][$timesheet['CasaCase']['county']] = array(
					'opened' => 0,
					'open' => 0,
					'closed' => 0
				);
			}
			
			if((!empty($timesheet['CasaCase']['closed'])) && (strtotime($timesheet['CasaCase']['cloased']) <= $stop_date)) {
				$cases['counties'][$timesheet['CasaCase']['county']]['closed']++;
				$cases['closed']++;
			}
			
			if(strtotime($timesheet['CasaCase']['created']) < $start_date) {
				$cases['counties'][$timesheet['CasaCase']['county']]['open']++;
				$cases['open']++;
			}
			
			if(strtotime($timesheet['CasaCase']['created']) > $start_date) {
				$cases['counties'][$timesheet['CasaCase']['county']]['opened']++;
				$cases['opened']++;
			}

			foreach($timesheet['CasaCase']['Child'] as $child) {
				//update child stats
				$child['county'] = ($child['county']=='')?'UNKNOWN':strtoupper(trim($child['county']));
			
				if(!isset($children['counties'][$child['county']])) {
					$children['counties'][$child['county']] = array(
						'opened' => 0,
						'open' => 0,
						'closed' => 0
					);
				}
				
				if($child['tmc']) {
					$children['tmc']++;
				}
				
				if($child['pmc']) {
					$children['pmc']++;
				}
				
				switch($child['gender']) {
					case 'M':
						$children['gender']['male']++;
						break;
					case 'F':
						$children['gender']['female']++;
						break;
					default:
						$children['gender']['unknown']++;
						break;
					
				}
				
				if(!empty($child['race'])) {
					$children['ethnicity'][$child['race']]++;
				} else {
					$children['ethnicity']['Ethnicity Unknown']++;
				}
				
				if((!empty($child['closed'])) && (strtotime($child['cloased']) <= $stop_date)) {
					$children['counties'][$child['county']]['closed']++;
					$children['closed']++;
				}
				
				if(strtotime($child['created']) < $start_date) {
					$children['counties'][$child['county']]['open']++;
					$children['open']++;
				}
				
				if(strtotime($child['created']) > $start_date) {
					$children['counties'][$child['county']]['opened']++;
					$children['opened']++;
				}
				
				if(!empty($child['dob'])) {
					$dob = new DateTime($child['dob']);
					$today = new DateTime();
					$age = $dob->diff($today);
					$age = $age->y;
					switch($age) {
						case ($age <= 5):
							$children['age']['5']++;
							break;
						case ($age <= 12):
							$children['age']['6']++;
							break;
						case ($age <= 17):
							$children['age']['13']++;
							break;
						default:
							$children['age']['18']++;
							break;
						
					}
				} else {
					$children['age']['unknown']++;
				}
				
				
			}			
			
			

			
		}
	}
	ksort($cases['counties']);
	ksort($children['counties']);
	//debug(array($cases,$children));
	
?>
<div class="admin_header">
	<h3>
		<i class="icon-edit"></i> View Report - <?php echo $quarter.' Quarter '.$report['Report']['year'] ?>
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('<i class="icon-search"></i> Back to reports', array('action' => 'index'), array('escape'=>false,'class'=>'btn')); ?>
		</div>
	</h3>
</div>
<div class="">
	<table class="table table-striped table-bordered">
		<tr>
			<th colspan="3">
				<h4>CPS Case and Child Counts</h4>
			</th>
		</tr>
		<tr>
			<td></td>
			<td>Cases</td>
			<td>Children</td>
		</tr>
		<tr>
			<td><div class="text-right"><b>Beginning of Quarter</b></div></td>
			<td><?php echo $cases['open'] ?></td>
			<td><?php echo $children['open'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>Opened during Quarter</b></div></td>
			<td><?php echo $cases['opened'] ?></td>
			<td><?php echo $children['opened'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>Closed during Quarter</b></div></td>
			<td><?php echo $cases['closed'] ?></td>
			<td><?php echo $children['closed'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>End of Quarter</b></div></td>
			<td><?php echo $cases['open']+$cases['opened']-$cases['closed'] ?></td>
			<td><?php echo $children['open']+$children['opened']-$children['closed'] ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><b>No volunteer</b><br /><?php echo $cases['open'] ?></td>
			<td><b>TMC</b><br /><?php echo $children['tmc'] ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><b>Had volunteer</b><br /><?php echo $cases['open'] ?></td>
			<td><b>PMC</b><br /><?php echo $children['pmc'] ?></td>
		</tr>
	</table>
	<table class="table table-striped table-bordered">
		<tr>
			<th colspan="4">
				<h4>Child Demographics</h4>
			</th>
		</tr>
		<tr>
			<td colspan="2">Number of Children by Age</td>
			<td colspan="2">Number of Children by Ethnicity</td>
		</tr>		
		<tr>
			<td><div class="text-right"><b>5 years and Younger</b></div></td>
			<td><?php echo $children['age']['5']?></td>
			<td><div class="text-right"><b>African-American</b></div></td>
			<td><?php echo $children['ethnicity']['African-American'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>6 through 12 Years</b></div></td>
			<td><?php echo $children['age']['6']?></td>
			<td><div class="text-right"><b>Anglo</b></div></td>
			<td><?php echo $children['ethnicity']['Anglo'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>13 through 17 years</b></div></td>
			<td><?php echo $children['age']['13']?></td>
			<td><div class="text-right"><b>Asian</b></div></td>
			<td><?php echo $children['ethnicity']['Asian'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>18 years and older</b></div></td>
			<td><?php echo $children['age']['18']?></td>
			<td><div class="text-right"><b>Hispanic</b></div></td>
			<td><?php echo $children['ethnicity']['Hispanic'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>Age unknown</b></div></td>
			<td><?php echo $children['age']['unknown']?></td>
			<td><div class="text-right"><b>Native American</b></div></td>
			<td><?php echo $children['ethnicity']['Native American'] ?></td>
		</tr>
		<tr>
			<td colspan="2">Number of Children By Gender</td>
			<td><div class="text-right"><b>Other</b></div></td>
			<td><?php echo $children['ethnicity']['Other'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>Male</b></div></td>
			<td><?php echo $children['gender']['male']?></td>
			<td><div class="text-right"><b>Ethnicity Unknown</b></div></td>
			<td><?php echo $children['ethnicity']['Ethnicity Unknown'] ?></td>
		</tr>
		<tr>
			<td><div class="text-right"><b>Female</b></div></td>
			<td><?php echo $children['gender']['female']?></td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td><div class="text-right"><b>Unknown</b></div></td>
			<td><?php echo $children['gender']['unknown']?></td>
			<td colspan="2">&nbsp;</td>
		</tr>
	</table>
	<table class="table table-striped table-bordered">
		<tr>
			<th colspan="4">
				<h4>Cases by County</h4>
			</th>
		</tr>
		<tr>
			<td><b>County</b></td>
			<td><b>Beginning of Quarter</b></td>
			<td><b>Opened</b></td>
			<td><b>Closed</b></td>
		</tr>
		<?php foreach($cases['counties'] as $name => $county): ?>
		<tr>
			<td><?php echo $name ?></td>
			<td><?php echo $county['open'] ?></td>
			<td><?php echo $county['opened'] ?></td>
			<td><?php echo $county['closed'] ?></td>
		</tr>
		<?php endforeach ?>
	</table>
	<table class="table table-striped table-bordered">
		<tr>
			<th colspan="4">
				<h4>Children by County</h4>
			</th>
		</tr>
		<tr>
			<td><b>County</b></td>
			<td><b>Beginning of Quarter</b></td>
			<td><b>Opened</b></td>
			<td><b>Closed</b></td>
		</tr>
		<?php foreach($children['counties'] as $name => $county): ?>
		<tr>
			<td><?php echo $name ?></td>
			<td><?php echo $county['open'] ?></td>
			<td><?php echo $county['opened'] ?></td>
			<td><?php echo $county['closed'] ?></td>
		</tr>
		<?php endforeach ?>
	</table>
</div>