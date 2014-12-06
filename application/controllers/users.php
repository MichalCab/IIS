<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Class for operation around management section with users (Clen systemu)
*/
class Users extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('muser');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }

    /*
    Get all users of system (Clen systemu)
    */
    public function index()
    {
        $data['data']['users'] = $this->muser->getUsers();
        $data['view'] = 'mUsers';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Add new user to system (driver/managment person/customer)
    */
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

    /*
    Approve request for registration from visitor. 
    */
    public function set()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $id = $this->input->post('id', FALSE);
            $post_data['evidovany'] = 1;
            $this->statman->setSuccessStatus("Úspěšně jste potvrdili uživatele");
            echo json_encode($this->muser->editUser($id, $post_data, array('evidovany'), NULL, array('evidovany')));
        }
        else
            echo json_encode(FALSE);
    }

    /*
    Delete user, for example driver, from system (again only hide)
    */
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
