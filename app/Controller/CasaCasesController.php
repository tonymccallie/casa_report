<?php
App::uses('AppController', 'Controller');
class CasaCasesController extends AppController {
	public function admin_index() {
		$paginate = array(
			'contain' => array(

			)
		);
		
		if(!empty($this->request->data['CasaCase']['search'])) {
			$paginate['conditions'] = array('OR' => array(
				'CasaCase.name LIKE' => '%'.$this->request->data['CasaCase']['search'].'%',
				'CasaCase.city LIKE' => '%'.$this->request->data['CasaCase']['search'].'%',
				'CasaCase.state LIKE' => '%'.$this->request->data['CasaCase']['search'].'%',
				'CasaCase.zip LIKE' => '%'.$this->request->data['CasaCase']['search'].'%',
			));
		}
		
		$this->paginate = $paginate;
		$cases = $this->paginate();
		$supervisors = $this->CasaCase->Supervisor->find('list',array(
			'conditions' => array(
				'Supervisor.role_id' => 3
			),
		));
		$volunteers = $this->CasaCase->Volunteer->find('list',array(
			'conditions' => array(
				'Volunteer.role_id' => 2
			),
		));
		$this->set(compact('cases','supervisors','volunteers'));
	}
	
	public function admin_add() {
		if(!empty($this->request->data)) {
			$this->CasaCase->create();
			if($this->CasaCase->save($this->request->data)) {
				$this->Session->setFlash('Case created.', 'success');
				$this->redirect(array('action'=>'index'));
			}
		}
		$supervisors = $this->CasaCase->Supervisor->find('list',array(
			'conditions' => array(
				'Supervisor.role_id' => 3
			)
		));
		$volunteers = $this->CasaCase->Volunteer->find('list',array(
			'conditions' => array(
				'Volunteer.role_id' => 2
			)
		));
		$this->set(compact('supervisors','volunteers'));
	}
	
	public function admin_edit($id = null) {
		if (!$this->CasaCase->exists($id)) {
			throw new NotFoundException(__('Invalid case'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CasaCase->save($this->request->data)) {
				$this->Session->setFlash('The case has been saved','success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The case could not be saved. Please, try again.','error');
			}
		} else {
			$options = array(
				'conditions' => array(
					'CasaCase.' . $this->CasaCase->primaryKey => $id
				),
				'contain'=>array(
					'Child' => array(
						'order' => array('Child.dob')
					)
				));
			$this->request->data = $this->CasaCase->find('first', $options);
		}
		$supervisors = $this->CasaCase->Supervisor->find('list',array(
			'conditions' => array(
				'Supervisor.role_id' => 3
			)
		));
		$volunteers = $this->CasaCase->Volunteer->find('list',array(
			'conditions' => array(
				'Volunteer.role_id' => 2
			)
		));
		$this->set(compact('supervisors','volunteers'));
	}
	
	public function admin_delete($id = null) {
		$this->CasaCase->id = $id;
		if (!$this->CasaCase->exists()) {
			throw new NotFoundException(__('Invalid case'));
		}
		if ($this->CasaCase->delete()) {
			$this->Session->setFlash('Cage deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Case was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>