<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    private $userData;
    
	function __construct()
    {
        parent::__construct();       
        $this->userData = $this->auth->getUserData();
    }
}
