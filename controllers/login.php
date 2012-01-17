<?php
/**
 * 
 * basic login controller example
 * 
 */
class Login extends Controller {

	function __construct() {
		parent::__construct('login_model');	
	}
	
	function index( ) 
	{	 
		
		$token=$this->model->session->get('token');
		$this->viewLoader->render('login',array('token'=>$token) );
	}
	
	function runLogin()
	{
		$this->model->login();
	}
		function runLogout()
	{
		$this->model->logout();
	}

}
