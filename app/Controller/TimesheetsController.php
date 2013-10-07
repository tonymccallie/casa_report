<?php
App::uses('AppController', 'Controller');
class TimesheetsController extends AppController {
	public function admin_index() {
		$this->paginate = array(
			'contain' => array(
				'CasaCase' => 'Volunteer'
			)
		);
		$timesheets = $this->paginate();
		$this->set(compact('timesheets'));
	}
	
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
				$supervisor = $info['CasaCase']['Supervisor']['email'].', alex@amarillocasa.org';
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
}
?>