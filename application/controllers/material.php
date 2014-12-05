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
        $data['data']['materials'] = $this->mmaterial->getMaterials();
        $data['view'] = 'cMaterial';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function add()
    {
        $data = array('view' => 'mMaterialAdd');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if($this->mmaterial->addMaterial($post_data, array('nazov'), array(), array()))
            {
                $this->statman->setSuccessStatus("Úspěšně jste přidali surovinu");
                redirect('/material', 'refresh');
            }
            else
            {
                $data['data']['address'] = (object) $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
            }
        }
        else
        {
            $this->load->view('_container', $this->statman->setActualStatus($data));
        }
    }
}
