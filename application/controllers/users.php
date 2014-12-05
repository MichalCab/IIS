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
        $data['view'] = 'mUsers';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function add()
    {
        $data = array('view' => 'mUsersAdd');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if($this->muser->addUser($post_data))
            {
                $this->statman->setSuccessStatus("Úspěšně jste přidali uživatele");
                redirect('/users', 'refresh');
            }
            else
            {
                $data['data']['user'] = (object) $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
            }
        }
        else
            $this->load->view('_container', $this->statman->setActualStatus($data));
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
