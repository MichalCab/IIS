<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('maddress');
    }
    public function index()
    {
        $this->maddress->loadAddresses()
        $this->load->view('address', $data);
    }
    public function add()
    {
        $post_data = $this->input->post();
        $this->maddress->saveAddress($post_data);
        $this->load->view('address_add', $data);
    }
    public function edit($id)
    {
        $data = $this->maddress->getAddress($id);
        $this->load->view('address_edit', $data);
    }
    public function delete()
    {
        $id = $this->input->post($id, FALSE)
        echo json_encode($this->maddress->deleteAddress($id));
    }
}
