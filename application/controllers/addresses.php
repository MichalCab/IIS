<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addresses extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('maddress');
        $this->load->model('areaaddress');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }
    public function index()
    {
        $data['addresses'] = $this->maddress->getManagementAddresses()
        $data['']
        $this->load->view('_container', $this->address, $data);
    }
    public function assignarea()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->maddress->asignArea($post_data));
        }
        else
            echo json_encode(FALSE);
       
    }
}
