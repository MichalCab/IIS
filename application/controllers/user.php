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
            redirect('/user/login', 'refresh');
        
        $data['data']['user'] = $this->auth->getUserData();
        $data['view'] = 'home';
        
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function add()
    {
        if ($this->auth->isLogged())
            redirect('/user', 'refresh');
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if ($post_data['heslo'] != $post_data['heslo_znovu']){
                $this->load->view('register', $this->statman->setErrorNow("Zadané heslá nie sú rovnaké", $this->input->post()));
            }
            else
            {
                if($this->muser->addUser($post_data))
                {
                    $this->statman->setSuccessStatus("Úspešne ste sa zaregistrovali. Po aktivácií vedením sa môžete prihlásiť");
                    redirect('/user/login', 'refresh');
                }
                else
                    $this->load->view('register', $this->statman->setErrorNow("Všetky polia sú povinné", $this->input->post()));
            }
        }
        else
            $this->load->view('register', $this->statman->setActualStatus());
    }
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
    public function logout()
    {
        $this->auth->logout();
        $this->statman->setSuccessStatus("Boli ste úspešne odhlásený");
        redirect('/user/login', 'refresh');
    }
}
