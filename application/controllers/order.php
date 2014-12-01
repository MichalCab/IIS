<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {

	function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('order', $data);
    }
    public function add()
    {
        $this->load->view('order_add', $data);
    }
    public function edit($id)
    {
        $this->load->view('order_edit', $data);
    }
}
