<?php
/**
 *
 * Very basic example of login model
 *
 * TODO security and error management!  
 * 
 */
class Login_Model extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function login() {
 

		$userName = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
		$passw = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS); 
		
		if(!$this->session->checkToken($_POST['token'])){
			throw new Exception('Invalid token');
			}
		 
		$passw = hash('sha256', $passw);

		$sth = $this -> db -> fetchSingle("SELECT id, level FROM users WHERE 
				username = :username AND password = :password", array(':username' => $userName, ':password' => $passw));
 
		
		if ($sth==true) {

			$this->session->start();
			$this->session->set('user', $userName);
			$this->session->set('level', $user['level']);
			$this->session->set('loggedIn', true);
			$sessionId = session_id();
			$sth = $this -> db -> onlyExecute("UPDATE users SET sessionId=$sessionId WHERE 
				username = :username AND password = :password",array(':username' => $userName, ':password' => $passw));
		
			header('location:' . BASEPATH . DEFAULTCONTROLLER);

		} else {
			header('location:' . BASEPATH . 'login');
		}

	}

	function logout() {
		$this->session->start();
		$this->session->set('loggedIn', false);
		$this->session->set('user', null);
		$this->session->set('level', null);
		$sth = $this -> db -> onlyExecute("UPDATE users SET sessionId='' WHERE 
				username = :username AND password = :password",array(':username' => $userName, ':password' => $passw));

		$this->session->destroy();
		header('location:' . BASEPATH);
	}

}
