<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AreasController extends ManagementController {

	function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('address', $data);
    }
    public function asigndriver()
    {
        $this->load->view('areas_asigndriver', $data);
    }
    public function add()
    {
        $this->load->view('areas_edit', $data);
    }
    public function delete($id)
    {
        $this->load->view('areas_delete', $data);
    }
}
