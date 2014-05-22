<?php
App::uses('AppController', 'Controller');
class ReportsController extends AppController {
	public function admin_index() {
		$reports = $this->paginate();
		$this->set(compact('reports'));
	}
	
	public function admin_add() {
		if(!empty($this->request->data)) {
			$this->Report->create();
			if($this->Report->save($this->request->data)) {
				$report_id = $this->Report->getLastInsertID();
				$this->Session->setFlash('Report created','success');
				$this->redirect(array('action'=>'edit',$report_id));
			} else {
				$this->Session->setFlash('There was a problem creating the Report.','success');
			}
		}
	}
	
	public function admin_view($id = null) {
		if (!$this->Report->exists($id)) {
			throw new NotFoundException(__('Invalid report'));
		}
		$report = $this->Report->find('first',array(
			'conditions' => array(
				'Report.id' => $id
			),
			'contain' => array(
				'Timesheet' => array(
					'Record',
					'CasaCase' => array(
						'Child'
					)
				)
			)
		));
		$this->set(compact('report'));
	}
	
	public function admin_edit($id = null) {
		if (!$this->Report->exists($id)) {
			throw new NotFoundException(__('Invalid report'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Report->save($this->request->data)) {
				$this->Report->Timesheet->updateAll(
					array(
						'Timesheet.report_id' => null
					),
					array(
						'Timesheet.report_id' => $this->request->data['Report']['id']
					)
				);
				
				
				$this->Report->Timesheet->updateAll(
					array(
						'Timesheet.report_id' => $this->request->data['Report']['id']
					),
					array(
						'Timesheet.id' => $this->request->data['Timesheet']['Timesheet']
					)
				);
			
				$this->Session->setFlash('The report has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The report could not be saved. Please, try again.','error');
			}
		} else {
			$this->request->data = $this->Report->findById($id);
		}
		$listing = Set::extract('/Timesheet/id',$this->request->data);
		switch($this->request->data['Report']['quarter']) {
			case 1:
				$range = array(
					"Timesheet.date >= '".$this->request->data['Report']['year']."-09-01'",
					"Timesheet.date <= '".$this->request->data['Report']['year']."-11-30'",
				);
				break;
			case 2:
				$range = array(
					"Timesheet.date >= '".($this->request->data['Report']['year']-1)."-12-01'",
					"Timesheet.date <= '".$this->request->data['Report']['year']."-02-28'",
				);
				break;
			case 3:
				$range = array(
					"Timesheet.date >= '".$this->request->data['Report']['year']."-03-01'",
					"Timesheet.date <= '".$this->request->data['Report']['year']."-05-31'",
				);
				break;
			case 4:
				$range = array(
					"Timesheet.date >= '".$this->request->data['Report']['year']."-06-01'",
					"Timesheet.date <= '".$this->request->data['Report']['year']."-08-31'",
				);
				break;
			
		}
		$timesheets = $this->Report->Timesheet->find('all',array(
			'conditions' => array(
				'OR' => array(
					'Timesheet.report_id IS NULL',
					'Timesheet.report_id' => $id,
				),
				'AND' => $range,
				'Timesheet.submitted NOT' => null
			),
			'order' => array(
				'Timesheet.date' => 'asc'
			)
		));
		$this->set(compact('timesheets','listing'));
	}
}
?>