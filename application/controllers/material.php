<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('mmaterial');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }
    public function index()
    {
        $data['materials'] = $this->mmaterial->getMaterials();
        $this->load->view('materials', $data);
    }
    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->mmaterial->addMaterial($post_data, array('nazov')));
        }
        else
            $this->load->view('material_add');
    }
}
