<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('marea');
        $this->load->model('muser');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login', 'refresh');
    }
    public function index()
    {
        $data['data']['areas'] = $this->marea->getAreas();
        $data['data']['drivers'] = $this->muser->getDrivers();
        $data['view'] = 'mAreas';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function assigndriver()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            $id = $post_data['id'];
            unset($post_data['id']);
            echo json_encode($this->marea->updateArea($post_data, $id));
        }
        else
            echo json_encode(FALSE);
    }
    public function add()
    {
        $data = array('view' => 'mAreasAdd');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if($this->marea->addArea($post_data))
            {
                $this->statman->setSuccessStatus("Úspěšně jste přidali oblast rozvozu");
                redirect('/areas', 'refresh');
            }
            else
            {
                $data['data']['area'] = (object) $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
            }
        }
        else
        {
            $this->load->view('_container', $this->statman->setActualStatus($data));
        }
    }
    public function delete()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $id = $this->input->post('id', FALSE);
            echo json_encode($this->marea->deleteArea($id));
        }
        else
            echo json_encode(FALSE);
    }
}
