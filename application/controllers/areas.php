<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('marea');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/login/form/', 'refresh');
    }
    public function index()
    {
        $data['areas'] = $this->marea->getAreas()
        $data['drivers'] = $this->mdriver->getDrivers()
        $this->load->view('areas', $data);
    }
    public function asigndriver()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->marea->updateArea($post_data, $id));
        }
        else
            echo json_encode(FALSE);
    }
    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->marea->addArea($post_data));
        }
        else
        {
            $data['drivers'] = $this->mdriver->getDrivers()
            $this->load->view('area_add', $data);
        }
    }
    public function delete($id)
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
