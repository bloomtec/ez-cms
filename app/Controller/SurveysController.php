<?php
class SurveysController extends AppController {

	var $name = 'Surveys';

	function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('sondeo');
	}

	function index() {
		$this -> Survey -> recursive = 0;
		$this -> set('surveys', $this -> paginate());
	}

	function sondeo() {
		return $oldActiva = $this -> Survey -> find("first", array("conditions" => array("Survey.estado" => true, )));
	}

	function view($id = null) {
		if (!$id) {
			$this -> Session -> setFlash(__('Invalid survey', true));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> set('survey', $this -> Survey -> read(null, $id));
	}

	function voting() {
		$this -> Survey -> SurveyOption -> recursive = -1;
		$surveyOption = $this -> Survey -> SurveyOption -> read(null, $_POST["optionId"]);
		$surveyOption["SurveyOption"]["votos"] += 1;
		//debug($surveyOption);
		if ($this -> Survey -> SurveyOption -> save($surveyOption)) {
			$this -> Session -> write("voto", true);
			echo true;
		} else {
			echo false;
		}
		configure::write("debug", 0);
		$this -> autorender = false;
		exit(0);

	}

	function admin_index() {
		$this -> Survey -> recursive = 0;
		$this -> set('surveys', $this -> paginate());		
	}

	function admin_view($id = null) {
		$this -> Survey -> id = $id;
		if (!$this -> Survey -> exists()) {
			throw new NotFoundException(__('Sondeo no válido'));
		}
		$this -> set('survey', $this -> Survey -> read(null, $id));
	}

	function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Survey -> create();
			if ($this -> Survey -> save($this -> request -> data)) {
				$surveyId = $this -> Survey -> id;
				if ($this -> request -> data["Survey"]["estado"]) {
					$oldActiva = $this -> Survey -> find("first", array("conditions" => array("Survey.estado" => true, "Survey.id <>" => $surveyId)));
					$oldActiva["Survey"]["estado"] = false;
					if (isset($oldActiva["Survey"]["id"]) && $surveyId != $oldActiva["Survey"]["id"])
						$this -> Survey -> save($oldActiva);
				}
				foreach ($this->data["Options"] as $option) {
					$surveyOption["SurveyOption"]["survey_id"] = $surveyId;
					$surveyOption["SurveyOption"]["name"] = $option["name"];
					$this -> Survey -> SurveyOption -> save($surveyOption);
					$this -> Survey -> SurveyOption -> id = 0;
				}
				$this -> Session -> setFlash(__('La encuesta ha sido guardada', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la encuesta. Por favor, intente de nuevo.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this -> Survey -> id = $id;
		if (!$this -> Survey -> exists()) {
			throw new NotFoundException(__('Sondeo no válido'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Survey -> save($this -> request -> data)) {
				//	debug($this->data);
				//$surveyId=$this->Survey->id;
				if ($this -> request -> data["Survey"]["estado"]) {
					$oldActiva = $this -> Survey -> find("first", array("conditions" => array("Survey.estado" => true, "Survey.id <>" => $this -> request -> data["Survey"]["id"])));
					$oldActiva["Survey"]["estado"] = false;
					//debug($oldActiva);
					if (isset($oldActiva["Survey"]["id"]))
						$this -> Survey -> save($oldActiva);
				}
				if (isset($this -> request -> data["Options"])) {
					foreach ($this -> request -> data["Options"] as $option) {
						$surveyOption = null;
						$surveyOption["SurveyOption"]["survey_id"] = $this -> request -> data["Survey"]["id"];
						if (isset($option["id"])) {
							$surveyOption["SurveyOption"]["id"] = $option["id"];
						}
						$surveyOption["SurveyOption"]["name"] = $option["name"];
						$this -> Survey -> SurveyOption -> save($surveyOption);
						$this -> Survey -> SurveyOption -> id = 0;
					}
				}

				$this -> Session -> setFlash(__('La Encuesta ha sido guardada', true));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la encuesta. Por favor, intente de nuevo.', true));
			}
		}
		if (empty($this -> request -> data)) {
			$this -> data = $this -> Survey -> read(null, $id);
		}
	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Survey -> id = $id;
		if (!$this -> Survey -> exists()) {
			throw new NotFoundException(__('Sondeo no válido'));
		}
		if ($this -> Survey -> delete()) {
			$this -> Session -> setFlash(__('Se elminó el sondeo'),'crud/success');
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó el sondeo'),'crud/error');
		$this -> redirect(array('action' => 'index'));
	}

}
?>