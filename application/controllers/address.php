<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddressController extends CustomerController {

	function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('address', $data);
    }
    public function add()
    {
        $this->load->view('address_add', $data);
    }
    public function edit($id)
    {
        $this->load->view('address_edit', $data);
    }
    public function delete($id)
    {
        $this->load->view('address_delete', $data);
    }
}
