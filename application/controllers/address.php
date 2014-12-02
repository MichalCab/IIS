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
        $data['addresses'] = $this->maddress->getAddresses()
        $this->load->view('address', $data);
    }
    public function add()
    {
        $data = array('view' => 'cAddressAdd"');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            $post_data["id"] = $this->userData->id;
            if($this->maddress->addAddress($post_data))
            {
                $this->statman->setSuccessStatus("Úspěšně jste změnili adresu");
                redirect('/addres', 'refresh');
            }
            else
            {
                $data['data']['wrong'] = $post_data;
                $this->load->view('_container', $this->statman->setErrorNow("Nesprávny login alebo heslo", $data));
            }
        }
        else
            $this->load->view('_container', $this->statman->setActualStatus($data));
       
    }
    public function edit($id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->maddress->updateAddress($post_data, $id));
        }
        else
        {
            $data = $this->maddress->getAddress($id);
            $this->load->view('address_edit', $data);
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
