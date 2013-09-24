<?php
App::uses('AppController', 'Controller');
class CommunicationsController extends AppController {
	public function admin_index() {
		$communications = $this->paginate();
		$this->set(compact('communications'));
	}
	
	public function admin_add() {
		if(!empty($this->request->data)) {
			$this->Communication->create();
			if($this->Communication->save($this->request->data)) {
				$this->Session->setFlash('Communication saved','success');
				$this->redirect(array('action'=>'index'));
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$this->Communication->exists($id)) {
			throw new NotFoundException(__('Invalid communication'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Communication->save($this->request->data)) {
				$this->Session->setFlash('The communication has been saved','success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('The communication could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id));
			$this->request->data = $this->Communication->find('first', $options);
		}
	}
	
	public function admin_delete($id = null,$case_id = null) {
		$this->Communication->id = $id;
		if (!$this->Communication->exists()) {
			throw new NotFoundException(__('Invalid communication record'));
		}
		if ($this->Communication->delete()) {
			$this->Session->setFlash('Communication record deleted','success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('Communication record was not deleted','error');
		$this->redirect(array('action'=>'index'));
	}
}
?>