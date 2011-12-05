<?php
/**
 *
 * basic view class  
 *
 */

class LoadView {

	private $properties;

	function __construct() {

	}
/**
 * 
 * basic render function with fixed header and footer and data extract
 */
	public function render($name, $data = null) {
		if (is_array($data)) {
			extract($data);
		}
		if (!empty($properties)) {
			extract($properties);
		}

		include VIEWPATH . 'header.php';
		include VIEWPATH . $name . '.php';
		include VIEWPATH . 'footer.php';

	}

	public function __set($property, $value) {
		if (!isset($this -> $property)) {
			$this -> properties[$property] = $value;
		}
	}

	public function __get($property) {
		if (isset($this -> properties[$property])) {
			return $this -> properties[$property];
		}
	}

}
