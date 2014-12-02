<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Material extends MY_Controller {

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
}