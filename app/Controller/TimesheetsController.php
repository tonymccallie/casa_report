<?php
App::uses('AppController', 'Controller');
class TimesheetsController extends AppController {
	public function add($id = null) {
		if(empty($id)) {
			$this->view = 'choose';
			$cases = $this->Timesheet->CasaCase->find('all',array(
				'conditions' => array(
					'CasaCase.user_id' => Authsome::get('User.id')
				),
				'contain' => array()
			));
			$this->set(compact('cases'));
		} else {
			$this->Timesheet->create();
			$data = array(
				'Timesheet' => array(
					'timesheet_id' => Authsome::get('User.id'),
					'case_id' => $id,
					'user_id' => Authsome::get('User.id'),
					'date' => date('Y-m-d')
				)
			);
			if($this->Timesheet->save($data)) {
				$this->redirect(array('action'=>'edit',$this->Timesheet->getLastInsertId()));
			} else {
				$this->Session->setFlash('There was an error creating the Timesheet','error');
			}
		}
	}
	
	public function edit($id = null) {
		if (!$this->Timesheet->exists($id)) {
			throw new NotFoundException(__('Invalid timesheet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!empty($this->request->data['Timesheet']['submit'])) {
				$this->request->data['Timesheet']['submitted'] = date('Y-m-d H:i:s');
				$info = $this->Timesheet->find('first', array(
					'conditions' => array(
						'Timesheet.id' => $this->request->data['Timesheet']['id']
					),
					'contain' => array(
						'CasaCase' => array(
							'Supervisor'
						),
						'User'
					)
				));
				$supervisor = array($info['CasaCase']['Supervisor']['email'],'alex@amarillocasa.org');
				//EMAIL ADMINS
				Common::email(array(
					'to' => $supervisor,
					'subject' => 'Timesheet submitted',
					'template' => 'submit',
					'variables' => array(
						'timesheet' => $info
					)
				),'');
			}
			$this->request->data['Timesheet']['date']['day'] = '01';
			if ($this->Timesheet->save($this->request->data)) {
				$this->Session->setFlash('The timesheet has been saved','success');
				$this->redirect('/');
			} else {
				$this->Session->setFlash('The timesheet could not be saved. Please, try again.','error');
			}
		} else {
			$options = array(
				'conditions' => array('Timesheet.' . $this->Timesheet->primaryKey => $id),
				'contain' => array(
					'Record' => array(
						'Communication'
					),
					'CasaCase' => array(
						'Child' =>  array(
							'order' => array('Child.dob')
						)
					)
				)
			);
			$this->request->data = $this->Timesheet->find('first', $options);
		}
		$communications = $this->Timesheet->Record->Communication->find('list');
		$this->set(compact('communications'));
	}
	
	public function admin_index() {
		$paginate = array(
			'conditions' => array(
				'Timesheet.archived' => 0
			),
			'contain' => array(
				'CasaCase' => 'Volunteer'
			),
			'order' => array(
				'Timesheet.date' => 'desc'
			)
		);
		
		if(!empty($this->request->data['Timesheet']['supervisor_id'])) {
			$this->request->params['named']['supervisor'] = $this->request->data['Timesheet']['supervisor_id'];
		}
		
		$caseids = array();
		$searchCases = false;
		
		if(!empty($this->request->params['named']['supervisor'])) {
			$caselist = $this->Timesheet->CasaCase->find('all',array(
				'conditions' => array(
					'CasaCase.supervisor_id' => $this->request->params['named']['supervisor']
				),
				'contain' => array()
			));
			$searchCases = true;
			$caseids = Set::extract('/CasaCase/id',$caselist);
		}
		
		if(!empty($this->request->data['Timesheet']['name'])) {
			$caselist = $this->Timesheet->CasaCase->find('all',array(
				'conditions' => array(
					'CasaCase.name LIKE' => '%'.$this->request->data['Timesheet']['name'].'%'
				),
				'contain' => array()
			));
			$searchCases = true;
			$tmpcaseids = Set::extract('/CasaCase/id',$caselist);
			$caseids = am($tmpcaseids,$caseids);
		}
		if($searchCases) {
			$paginate['conditions']['Timesheet.case_id'] = $caseids;
		}
		
		if(!empty($this->request->data['Timesheet']['archived'])) {
			$paginate['conditions']['Timesheet.archived'] = $this->request->data['Timesheet']['archived'];
		}
		
		if(!empty($this->request->data['Timesheet']['name'])) {
			//$paginate['conditions']['Timesheet.name LIKE'] = '%'.$this->request->data['Timesheet']['name'].'%';
		}
		//debug($paginate);
		$this->paginate = $paginate;
		
		$supervisors = $this->Timesheet->CasaCase->Volunteer->Supervisor->find('list',array(
			'conditions' => array(
				'Supervisor.role_id' => 3
			),
			'order' => array(
				'first_name' => 'asc', 'last_name' => 'asc'
			)
		));

		$timesheets = $this->paginate();
		$this->set(compact('timesheets','supervisors'));
	}
	
	public function admin_edit($id = null) {
		if (!$this->Timesheet->exists($id)) {
			throw new NotFoundException(__('Invalid timesheet'));
		}
		$this->request->data['Timesheet']['date']['day'] = '01';
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Timesheet->save($this->request->data)) {
				$this->Session->setFlash('The timesheet has been saved','success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('The timesheet could not be saved. Please, try again.','error');
			}
		} else {
			$options = array(
				'conditions' => array('Timesheet.' . $this->Timesheet->primaryKey => $id),
				'contain' => array(
					'Record' => array(
						'Communication'
					),
					'CasaCase' => array(
						'Child' =>  array(
							'order' => array('Child.dob')
						)
					)
				)
			);
			$this->request->data = $this->Timesheet->find('first', $options);
		}
		$communications = $this->Timesheet->Record->Communication->find('list');
		$this->set(compact('communications'));
	}
	
	public function admin_delete($id = null) {
		$this->Timesheet->id = $id;
		if (!$this->Timesheet->exists()) {
			throw new NotFoundException(__('Invalid timesheet'));
		}
		if ($this->Timesheet->delete()) {
			$this->Session->setFlash('Timesheet deleted','success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('Timesheet was not deleted','error');
		$this->redirect(array('action' => 'index'));
	}
}
?>