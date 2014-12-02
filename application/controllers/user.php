<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('muser');
        $this->load->model('maddress');
    }
    public function index()
    {
        if (! $this->auth->isLogged())
            redirect('/user/login/', 'refresh');
        $data['addresses'] = $this->maddress->getAddresses();
        $data['user'] = $this->auth->getUserData();
        $this->load->view('address', $data);
    }
    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->muser->addUser($post_data));
        }
        else
            $this->load->view('user_add', $data);
    }
    public function login()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $login = $this->input->post('login');
            $heslo = $this->input->post('heslo');
            echo json_encode($this->auth->login($login, $heslo));
        }
        else
            $this->load->view('user_login', $data);
    }
}
