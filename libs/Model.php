<?php
/**
 * Generic model make db connections or what you need
 *
 */
class Model {

	function __construct() {
		$this -> db = new Database();

	}

}
