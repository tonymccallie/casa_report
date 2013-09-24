<?php
App::uses('AppController', 'Controller');
class ChildrenController extends AppController {
	public function admin_add($case_id = null) {
		if(!empty($this->request->data)) {
			$this->Child->create();
			if($this->Child->save($this->request->data)) {
				$this->Session->setFlash('The child has been added','success');
				$this->redirect('/admin/casa_cases/edit/'.$this->request->data['Child']['case_id']);
			}
		}
		$this->set(compact('case_id'));
	}
	
	public function admin_edit($id = null) {
		if (!$this->Child->exists($id)) {
			throw new NotFoundException(__('Invalid child'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Child->save($this->request->data)) {
				$this->Session->setFlash('The child has been saved','success');
				$this->redirect('/admin/casa_cases/edit/'.$this->request->data['Child']['case_id']);
			} else {
				$this->Session->setFlash('The child could not be saved. Please, try again.','error');
			}
		} else {
			$options = array('conditions' => array('Child.' . $this->Child->primaryKey => $id));
			$this->request->data = $this->Child->find('first', $options);
		}
	}
	
	public function admin_delete($id = null,$case_id = null) {
		$this->Child->id = $id;
		if (!$this->Child->exists()) {
			throw new NotFoundException(__('Invalid child record'));
		}
		if ($this->Child->delete()) {
			$this->Session->setFlash('Child record deleted','success');
			$this->redirect('/admin/casa_cases/edit/'.$case_id);
		}
		$this->Session->setFlash('Child record was not deleted','error');
		$this->redirect(array('controller'=>'casa_cases','action' => 'index'));
	}
}
?>