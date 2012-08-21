<?php
class SurveyOptionsController extends AppController {

	var $name = 'SurveyOptions';
	
	function index() {
		$this->SurveyOption->recursive = 0;
		$this->set('surveyOptions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid survey option', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('surveyOption', $this->SurveyOption->read(null, $id));
	}

	
	function admin_index() {
		$this->SurveyOption->recursive = 0;
		$this->set('surveyOptions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid survey option', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('surveyOption', $this->SurveyOption->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SurveyOption->create();
			if ($this->SurveyOption->save($this->data)) {
				$this->Session->setFlash(__('The survey option has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey option could not be saved. Please, try again.', true));
			}
		}
		$surveys = $this->SurveyOption->Survey->find('list');
		$this->set(compact('surveys'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid survey option', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SurveyOption->save($this->data)) {
				$this->Session->setFlash(__('The survey option has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey option could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SurveyOption->read(null, $id);
		}
		$surveys = $this->SurveyOption->Survey->find('list');
		$this->set(compact('surveys'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for survey option', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SurveyOption->delete($id)) {
			$this->Session->setFlash(__('Survey option deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Survey option was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>