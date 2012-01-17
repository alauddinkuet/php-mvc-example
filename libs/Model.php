<?php
/**
 * Generic model make db connection or what you need
 *
 */
class Model {

	function __construct() {
		
		$this->session=new Session();
		$this->session->start();
		
		
		$this -> db = new Database();

	}

}
