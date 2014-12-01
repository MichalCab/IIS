<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrdersController extends DriverController {

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
