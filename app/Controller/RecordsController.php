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
			$this->request->data['Record']['a1_hours'] = $this->request->data['a1_hours'][0]['hours'].$this->request->data['a1_hours'][0]['minutes'];
			$this->request->data['Record']['a2_hours'] = $this->request->data['a2_hours'][0]['hours'].$this->request->data['a2_hours'][0]['minutes'];
			$this->request->data['Record']['a3_hours'] = $this->request->data['a3_hours'][0]['hours'].$this->request->data['a3_hours'][0]['minutes'];
			$this->request->data['Record']['a4_hours'] = $this->request->data['a4_hours'][0]['hours'].$this->request->data['a4_hours'][0]['minutes'];
			$this->request->data['Record']['a5_hours'] = $this->request->data['a5_hours'][0]['hours'].$this->request->data['a5_hours'][0]['minutes'];
			$this->request->data['Record']['a6_hours'] = $this->request->data['a6_hours'][0]['hours'].$this->request->data['a6_hours'][0]['minutes'];
			$this->request->data['Record']['b_hours'] = $this->request->data['b_hours'][0]['hours'].$this->request->data['b_hours'][0]['minutes'];
			$this->request->data['Record']['c_hours'] = $this->request->data['c_hours'][0]['hours'].$this->request->data['c_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			$this->request->data['Record']['case_hours'] = $this->request->data['Record']['a1_hours']+$this->request->data['Record']['a2_hours']+$this->request->data['Record']['a3_hours']+$this->request->data['Record']['a4_hours']+$this->request->data['Record']['a5_hours']+$this->request->data['Record']['a6_hours']+$this->request->data['Record']['b_hours']+$this->request->data['Record']['c_hours'];
			
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
			$this->request->data['Record']['a1_hours'] = $this->request->data['a1_hours'][0]['hours'].$this->request->data['a1_hours'][0]['minutes'];
			$this->request->data['Record']['a2_hours'] = $this->request->data['a2_hours'][0]['hours'].$this->request->data['a2_hours'][0]['minutes'];
			$this->request->data['Record']['a3_hours'] = $this->request->data['a3_hours'][0]['hours'].$this->request->data['a3_hours'][0]['minutes'];
			$this->request->data['Record']['a4_hours'] = $this->request->data['a4_hours'][0]['hours'].$this->request->data['a4_hours'][0]['minutes'];
			$this->request->data['Record']['a5_hours'] = $this->request->data['a5_hours'][0]['hours'].$this->request->data['a5_hours'][0]['minutes'];
			$this->request->data['Record']['a6_hours'] = $this->request->data['a6_hours'][0]['hours'].$this->request->data['a6_hours'][0]['minutes'];
			$this->request->data['Record']['b_hours'] = $this->request->data['b_hours'][0]['hours'].$this->request->data['b_hours'][0]['minutes'];
			$this->request->data['Record']['c_hours'] = $this->request->data['c_hours'][0]['hours'].$this->request->data['c_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			$this->request->data['Record']['case_hours'] = $this->request->data['Record']['a1_hours']+$this->request->data['Record']['a2_hours']+$this->request->data['Record']['a3_hours']+$this->request->data['Record']['a4_hours']+$this->request->data['Record']['a5_hours']+$this->request->data['Record']['a6_hours']+$this->request->data['Record']['b_hours']+$this->request->data['Record']['c_hours'];
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
			$this->request->data['Record']['a1_hours'] = $this->request->data['a1_hours'][0]['hours'].$this->request->data['a1_hours'][0]['minutes'];
			$this->request->data['Record']['a2_hours'] = $this->request->data['a2_hours'][0]['hours'].$this->request->data['a2_hours'][0]['minutes'];
			$this->request->data['Record']['a3_hours'] = $this->request->data['a3_hours'][0]['hours'].$this->request->data['a3_hours'][0]['minutes'];
			$this->request->data['Record']['a4_hours'] = $this->request->data['a4_hours'][0]['hours'].$this->request->data['a4_hours'][0]['minutes'];
			$this->request->data['Record']['a5_hours'] = $this->request->data['a5_hours'][0]['hours'].$this->request->data['a5_hours'][0]['minutes'];
			$this->request->data['Record']['a6_hours'] = $this->request->data['a6_hours'][0]['hours'].$this->request->data['a6_hours'][0]['minutes'];
			$this->request->data['Record']['b_hours'] = $this->request->data['b_hours'][0]['hours'].$this->request->data['b_hours'][0]['minutes'];
			$this->request->data['Record']['c_hours'] = $this->request->data['c_hours'][0]['hours'].$this->request->data['c_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			$this->request->data['Record']['case_hours'] = $this->request->data['Record']['a1_hours']+$this->request->data['Record']['a2_hours']+$this->request->data['Record']['a3_hours']+$this->request->data['Record']['a4_hours']+$this->request->data['Record']['a5_hours']+$this->request->data['Record']['a6_hours']+$this->request->data['Record']['b_hours']+$this->request->data['Record']['c_hours'];
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
		
		$hours = array(
			'a1_hours','a2_hours','a3_hours','a4_hours','a5_hours','a6_hours','b_hours','c_hours'
		);
		
		foreach($hours as $hour) {
			$case_hours = explode('.', $this->request->data['Record'][$hour]);
			$this->request->data[$hour][0]['hours'] = $case_hours[0];
			if(!empty($case_hours[1])) {
				$this->request->data[$hour][0]['minutes'] = '.'.$case_hours[1];	
			}	
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
			$this->request->data['Record']['a1_hours'] = $this->request->data['a1_hours'][0]['hours'].$this->request->data['a1_hours'][0]['minutes'];
			$this->request->data['Record']['a2_hours'] = $this->request->data['a2_hours'][0]['hours'].$this->request->data['a2_hours'][0]['minutes'];
			$this->request->data['Record']['a3_hours'] = $this->request->data['a3_hours'][0]['hours'].$this->request->data['a3_hours'][0]['minutes'];
			$this->request->data['Record']['a4_hours'] = $this->request->data['a4_hours'][0]['hours'].$this->request->data['a4_hours'][0]['minutes'];
			$this->request->data['Record']['a5_hours'] = $this->request->data['a5_hours'][0]['hours'].$this->request->data['a5_hours'][0]['minutes'];
			$this->request->data['Record']['a6_hours'] = $this->request->data['a6_hours'][0]['hours'].$this->request->data['a6_hours'][0]['minutes'];
			$this->request->data['Record']['b_hours'] = $this->request->data['b_hours'][0]['hours'].$this->request->data['b_hours'][0]['minutes'];
			$this->request->data['Record']['c_hours'] = $this->request->data['c_hours'][0]['hours'].$this->request->data['c_hours'][0]['minutes'];
			$this->request->data['Record']['non_case_hours'] = $this->request->data['non_case_hours'][0]['hours'].$this->request->data['non_case_hours'][0]['minutes'];
			$this->request->data['Record']['case_hours'] = $this->request->data['Record']['a1_hours']+$this->request->data['Record']['a2_hours']+$this->request->data['Record']['a3_hours']+$this->request->data['Record']['a4_hours']+$this->request->data['Record']['a5_hours']+$this->request->data['Record']['a6_hours']+$this->request->data['Record']['b_hours']+$this->request->data['Record']['c_hours'];
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
		
		$hours = array(
			'a1_hours','a2_hours','a3_hours','a4_hours','a5_hours','a6_hours','b_hours','c_hours'
		);
		
		foreach($hours as $hour) {
			$case_hours = explode('.', $this->request->data['Record'][$hour]);
			$this->request->data[$hour][0]['hours'] = $case_hours[0];
			if(!empty($case_hours[1])) {
				$this->request->data[$hour][0]['minutes'] = '.'.$case_hours[1];	
			}	
		}
		
		$non_case_hours = explode('.', $this->request->data['Record']['non_case_hours']);
		$this->request->data['non_case_hours'][0]['hours'] = $non_case_hours[0];
		if(!empty($non_case_hours[1])) {
			$this->request->data['non_case_hours'][0]['minutes'] = '.'.$non_case_hours[1];	
		}
		$communications = $this->Record->Communication->find('list');
		$this->set(compact('timesheet_id','communications'));
	}
	
	public function delete($id = null,$timesheet_id = null) {
		$this->Record->id = $id;
		if (!$this->Record->exists()) {
			throw new NotFoundException(__('Invalid record record'));
		}
		if ($this->Record->delete()) {
			$this->Session->setFlash('Record record deleted','success');
			$this->redirect(array('controller'=>'timesheets','action'=>'edit',$timesheet_id));
		}
		$this->Session->setFlash('Record record was not deleted','error');
		$this->redirect(array('action'=>'index'));
	}
	
	public function admin_delete($id = null,$timesheet_id = null) {
		$this->Record->id = $id;
		if (!$this->Record->exists()) {
			throw new NotFoundException(__('Invalid record record'));
		}
		if ($this->Record->delete()) {
			$this->Session->setFlash('Record record deleted','success');
			$this->redirect(array('admin'=>true,'controller'=>'timesheets','action'=>'edit',$timesheet_id));
		}
		$this->Session->setFlash('Record record was not deleted','error');
		$this->redirect(array('action'=>'index'));
	}
}
?>