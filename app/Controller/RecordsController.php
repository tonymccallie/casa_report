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
			if($this->Record->save($this->request->data)) {
				$this->Session->setFlash('Record added','success');
				$this->redirect('/timesheets/edit/'.$this->request->data['Record']['timesheet_id']);
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
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlash('The record has been saved','success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('The record could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Record.' . $this->Record->primaryKey => $id));
			$this->request->data = $this->Record->find('first', $options);
		}
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