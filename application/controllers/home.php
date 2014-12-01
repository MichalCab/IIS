<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
	    var_dump($this->auth->getUserData()); 
		//$this->load->view('welcome_message');
	}
}
