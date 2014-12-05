<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Class for operation around admin section with material (Suroviny)
*/
class Material extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('mmaterial');

        $this->mmaterial->setUpOptionalParams(
                $attributes=array('nazov', 'nakupniCena', 'naSklade'),  
                $nonEmptyColumns=array('nazov', 'nakupniCena', 'naSklade'))

        // it can be used only by Admin
        if (! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }

    /*
    Get materials (Suroviny)
    */
    public function index()
    {
        $data['data']['materials'] = $this->mmaterial->getMaterials();
        $data['view'] = 'cMaterial';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Add new material (Surovina) to database
    */
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
