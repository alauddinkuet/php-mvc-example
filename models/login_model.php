<?php
/**
 *
 * Very basic example of login model
 *
 * TODO security! remember through cookies
 * 
 */
class Login_Model extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function login() {

		/**
		 * better filter the fields!
		 *
		 * */

		$userName = $_POST['username'];
		$passw = $_POST['password']; 
		/**
		 * use your algorithm
		 *
		 * */
		$passw = hash('sha256', $passw);

		$sth = $this -> db -> fetchSingle("SELECT id, level FROM users WHERE 
				username = :username AND password = :password", array(':username' => $userName, ':password' => $passw));
 
		
		if ($sth==true) {

			Session::start();
			Session::set('user', $userName);
			Session::set('level', $user['level']);
			Session::set('loggedIn', true);
			$sessionId = session_id();
			$sth = $this -> db -> onlyExecute("UPDATE users SET sessionId=$sessionId WHERE 
				username = :username AND password = :password",array(':username' => $userName, ':password' => $passw));
		
			header('location:' . BASEPATH . DEFAULTCONTROLLER);

		} else {
			header('location:' . BASEPATH . 'login');
		}

	}

	function logout() {
		Session::start();
		Session::set('loggedIn', false);
		Session::set('user', null);
		Session::set('level', null);
		$sth = $this -> db -> onlyExecute("UPDATE users SET sessionId='' WHERE 
				username = :username AND password = :password",array(':username' => $userName, ':password' => $passw));

		Session::destroy();
		header('location:' . BASEPATH);
	}

}
