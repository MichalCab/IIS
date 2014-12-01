<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller {

	function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('orders', $data);
    }
    public function done($id)
    {
        $this->load->view('orders_done', $data);
    }
}
