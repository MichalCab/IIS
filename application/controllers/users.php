<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('muser');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }
    public function index()
    {
        $data['users'] = $this->muser->getUsers();
        $this->load->view('users', $data);
    }
    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->muser->addUser($post_data));
        }
        else
        {
            $this->load->view('user_add', $data);
        }
    }
    public function set()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->muser->updateUser($post_data, $id, array('evidovany')));
        }
        else
            echo json_encode(FALSE);
    }
    public function delete()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $id = $this->input->post('id', FALSE);
            echo json_encode($this->muser->deleteUser($id));
        }
        else
            echo json_encode(FALSE);
    }

}
