<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Class for operation around all users.
Provides register, login and logout functionality.
*/
class User extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('muser');
        $this->load->model('maddress');
    }

    /*
    Get user data (Clen systemu) if user is logged.
    If not, then redirect to login
    */
    public function index()
    {
        if (! $this->auth->isLogged())
            redirect('/user/login', 'refresh');
        
        $data['data']['user'] = $this->auth->getUserData();
        $data['view'] = 'home';
        
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Visitors can do "addition to system request"
    */
    public function add()
    {
        // if not already logged
        if ($this->auth->isLogged())
            redirect('/user', 'refresh');
        
        // if any request
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            // check password with "password repead field"
            if ($post_data['heslo'] != $post_data['heslo_znovu']){
                $this->load->view('register', $this->statman->setErrorNow("Zadané heslá nie sú rovnaké", $this->input->post()));
            }
            else
            {
                if($this->muser->addUser($post_data)) // try to add to DB
                {
                    $this->statman->setSuccessStatus("Úspešne ste sa zaregistrovali. Po aktivácií vedením sa môžete prihlásiť");
                    redirect('/user/login', 'refresh');
                }
                else
                    $this->load->view('register', $this->statman->setErrorNow($post_data['error'], $this->input->post()));
            }
        }
        else
            $this->load->view('register', $this->statman->setActualStatus());
    }

    /*
    Login user to system (implemented in auth)
    */
    public function login()
    {
        if ($this->auth->isLogged())
            redirect('/user', 'refresh');
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $login = $this->input->post('login');
            $heslo = $this->input->post('heslo');
            if ($this->auth->login($login, $heslo))
            {
                $this->statman->setSuccessStatus("Prihlásenie prebehlo úspešne");
                redirect('/user', 'refresh');
            }
            else
                $this->load->view('login', $this->statman->setErrorNow("Nesprávny login alebo heslo"));
        }
        else
            $this->load->view('login', $this->statman->setActualStatus());
    }

    /*
    Log out user form system (implemented in auth)
    */
    public function logout()
    {
        $this->auth->logout();
        $this->statman->setSuccessStatus("Boli ste úspešne odhlásený");
        redirect('/user/login', 'refresh');
    }
}
