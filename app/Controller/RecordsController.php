<?php
App::uses('AppController', 'Controller');
class RecordsController extends AppController {
	public function admin_index() {
		$records = $this->paginate();
		$this->set(compact('records'));
	}
	
	public function add($timesheet_id = null) {
		if(!empty($this->request->data)) {
			$this->Record->create();
			$this->request->data['Record']['case_hours'] = $this->request->data['case_hours'][0]['hours'].$this->request->data['case_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			if($this->Record->save($this->request->data)) {
				$this->Session->setFlash('Record added','success');
				$this->redirect('/timesheets/edit/'.$this->request->data['Record']['timesheet_id']);
			}
		}
		$communications = $this->Record->Communication->find('list');
		$this->set(compact('timesheet_id','communications'));
	}
	
	public function admin_add($timesheet_id = null) {
		$this->view = 'add';
		if(!empty($this->request->data)) {
			$this->Record->create();
			$this->request->data['Record']['case_hours'] = $this->request->data['case_hours'][0]['hours'].$this->request->data['case_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			if($this->Record->save($this->request->data)) {
				$this->Session->setFlash('Record added','success');
				$this->redirect('/admin/timesheets/edit/'.$this->request->data['Record']['timesheet_id']);
			}
		}
		$communications = $this->Record->Communication->find('list');
		$this->set(compact('timesheet_id','communications'));
	}
	
	public function edit($id = null) {
		if (!$this->Record->exists($id)) {
			throw new NotFoundException(__('Invalid record'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Record']['case_hours'] = $this->request->data['case_hours'][0]['hours'].$this->request->data['case_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlash('The record has been saved','success');
				$this->redirect('/timesheets/edit/'.$this->request->data['Record']['timesheet_id']);
			} else {
				$this->Session->setFlash('The record could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Record.' . $this->Record->primaryKey => $id));
			$this->request->data = $this->Record->find('first', $options);
		}
		
		$case_hours = explode('.', $this->request->data['Record']['case_hours']);
		$this->request->data['case_hours'][0]['hours'] = $case_hours[0];
		if(!empty($case_hours[1])) {
			$this->request->data['case_hours'][0]['minutes'] = '.'.$case_hours[1];	
		}
		
		$non_case_hours = explode('.', $this->request->data['Record']['non_case_hours']);
		$this->request->data['non_case_hours'][0]['hours'] = $non_case_hours[0];
		if(!empty($non_case_hours[1])) {
			$this->request->data['non_case_hours'][0]['minutes'] = '.'.$non_case_hours[1];	
		}
		$communications = $this->Record->Communication->find('list');
		$this->set(compact('timesheet_id','communications'));
	}
	
	public function admin_edit($id = null) {
		$this->view = 'edit';
		if (!$this->Record->exists($id)) {
			throw new NotFoundException(__('Invalid record'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Record']['case_hours'] = $this->request->data['case_hours'][0]['hours'].$this->request->data['case_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlash('The record has been saved','success');
				$this->redirect('/admin/timesheets/edit/'.$this->request->data['Record']['timesheet_id']);
			} else {
				$this->Session->setFlash('The record could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Record.' . $this->Record->primaryKey => $id));
			$this->request->data = $this->Record->find('first', $options);
		}
		
		$case_hours = explode('.', $this->request->data['Record']['case_hours']);
		$this->request->data['case_hours'][0]['hours'] = $case_hours[0];
		if(!empty($case_hours[1])) {
			$this->request->data['case_hours'][0]['minutes'] = '.'.$case_hours[1];	
		}
		
		$non_case_hours = explode('.', $this->request->data['Record']['non_case_hours']);
		$this->request->data['non_case_hours'][0]['hours'] = $non_case_hours[0];
		if(!empty($non_case_hours[1])) {
			$this->request->data['non_case_hours'][0]['minutes'] = '.'.$non_case_hours[1];	
		}
		$communications = $this->Record->Communication->find('list');
		$this->set(compact('timesheet_id','communications'));
	}
	
	public function delete($id = null,$case_id = null) {
		$this->Record->id = $id;
		if (!$this->Record->exists()) {
			throw new NotFoundException(__('Invalid record record'));
		}
		if ($this->Record->delete()) {
			$this->Session->setFlash('Record record deleted','success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('Record record was not deleted','error');
		$this->redirect(array('action'=>'index'));
	}
}
?>