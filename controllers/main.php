<?php
/**
 * default page controller example
 *
 *TODO filter post requests or use a request handler
 */
class Main extends Controller {

	function __construct() {

		Session::start();
		if (!Session::get('loggedIn')) {
			header('location:' . BASEPATH . 'login');
		} else {
			parent::__construct('main_model');
		}
	}

	function index() {

		$this -> viewLoader -> tableData = $this -> model -> getData();
		$this -> viewLoader -> render('main');

	}

	function insertRow() {

		$this -> model -> insertRow($_POST['text']);

	}

	function update($id) {

		$data = array('field' => $_POST['field'], 'value' => $_POST['value']);
		$this -> model -> updateSingleData($id, $data);

	}

	function delete($id) {

		$this -> model -> deleteRow($id);
	}

}
