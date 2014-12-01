<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductController extends ManagementController {

	function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('material', $data);
    }
    public function add()
    {
        $this->load->view('material_add', $data);
    }
    public function edit($id)
    {
        $this->load->view('material_edit', $data);
    }
    public function set($id, $status)
    {
        $this->load->view('material_set', $data);
    }
}
