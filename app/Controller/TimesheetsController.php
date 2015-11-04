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
		$bolSubmit = true;
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!empty($this->request->data['Timesheet']['submit'])) {
				if(!empty($this->request->data['Timesheet']['signature'])) {
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
				} else {
					$this->Session->setFlash('You must enter a digital signature to submit the Timesheet.','error');
					$bolSubmit = false;
				}
			}
			$this->request->data['Timesheet']['date']['day'] = '01';
			if($bolSubmit) {
				if ($this->Timesheet->save($this->request->data)) {
					$this->Session->setFlash('The timesheet has been saved','success');
					$this->redirect('/');
				} else {
					$this->Session->setFlash('The timesheet could not be saved. Please, try again.','error');
				}
			}
		} else {
			$this->request->data = array();
		}
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
		$timesheet = $this->Timesheet->find('first', $options);
		$this->request->data = am($timesheet, $this->request->data);
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
		
		if(!empty($this->request->data)) {
			$url = '';
			foreach($this->request->data['Timesheet'] as $field => $option) {
				if((!empty($option))&&(!is_array($option))) {
					$url.='/'.$field.':'.$option;
				}
				if(is_array($option)) {
					if(!empty($option['month'])) {
						$url.='/month:'.$option['month'];	
					}
					if(!empty($option['year'])) {
						$url.='/year:'.$option['year'];	
					}
				}
			}
			if(!empty($url)) {
				$this->redirect('/admin/timesheets/index'.$url);
			}
		}

		$caseids = array();
		$searchCases = false;
		$data = array('Timesheet');
		
		if(!empty($this->request->named)) {
			$data['Timesheet'] = $this->request->named;
			$data['Timesheet']['date'] = array();
		}
		
		if((!empty($this->request->params['named']['month']))||(!empty($this->request->params['named']['year']))) {
			$year = date('Y');
			$month = date('m');
			if(!empty($this->request->params['named']['month'])) {
				$month = $this->request->params['named']['month'];
				$data['Timesheet']['date']['month'] = $this->request->params['named']['month'];
			}
			
			if(!empty($this->request->params['named']['year'])) {
				$year = $this->request->params['named']['year'];
				$data['Timesheet']['date']['year'] = $this->request->params['named']['year'];
			}
			
			$paginate['conditions']['AND'] = array(
				'Timesheet.date' =>  $year.'-'.$month.'-01'
			);
		}
		
		
		
		$this->data = $data;
		
		if(!empty($this->request->params['named']['supervisor_id'])) {
			$caselist = $this->Timesheet->CasaCase->find('all',array(
				'conditions' => array(
					'CasaCase.supervisor_id' => $this->request->params['named']['supervisor_id']
				),
				'contain' => array()
			));
			$searchCases = true;
			$caseids = Set::extract('/CasaCase/id',$caselist);
		}
		
		if(!empty($this->request->params['named']['name'])) {
			$caselist = $this->Timesheet->CasaCase->find('all',array(
				'conditions' => array(
					'CasaCase.name LIKE' => '%'.$this->request->params['named']['name'].'%'
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
		
		if(!empty($this->request->params['named']['archived'])) {
			$paginate['conditions']['Timesheet.archived'] = $this->request->params['named']['archived'];
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
						'Supervisor','Volunteer',
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