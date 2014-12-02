<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('maddress');
        if (! $this->auth->isLogged() || ! $this->auth->isCustomer())
            redirect('/user/login/', 'refresh');
    }
    public function index()
    {
        $data['data']['addresses'] = $this->maddress->getAddresses();
        $data['view'] = 'cAddress';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function add()
    {
        $data = array('view' => 'cAddressAdd');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            $post_data["id"] = $this->userData->id;
            if($this->maddress->addAddress($post_data))
            {
                $this->statman->setSuccessStatus("Úspěšně jste přidali adresu");
                redirect('/address', 'refresh');
            }
            else
            {
                $data['data'] = $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $post_data));
            }
        }
        else
            $this->load->view('_container', $this->statman->setActualStatus($data));
       
    }
    public function edit($id)
    {
        $data = array('view' => 'cAddressEdit');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if ($this->maddress->updateAddress($post_data, $id))
            {
                $this->statman->setSuccessStatus("Úspěšně jste změnili adresu");
                redirect('/address', 'refresh');
            }
            else
            {
                $data['data'] = $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $post_data));
            }
        }
        else
        {
            $data['data'] = $this->maddress->getAddress($id);
            $this->load->view('_container', $this->statman->setActualStatus($data));
        }
    }
    public function delete()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $id = $this->input->post('id', FALSE);
            echo json_encode($this->maddress->deleteAddress($id));
        }
        else
            echo json_encode(FALSE);
    }
}
