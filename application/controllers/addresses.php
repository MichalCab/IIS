<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addresses extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('maddress');
        if (! $this->auth->isLogged())
            redirect('/login/form/', 'refresh');
        if (! $this->auth->isCustomer())
            redirect('/user/', 'refresh')
    }
    public function index()
    {
        $data['addresses'] = $this->maddress->getManagementAddresses()
        $this->load->view('address', $data);
    }
    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->maddress->addAddress($post_data));
        }
        else
            $this->load->view('address_add', $data);
       
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