<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AllOrders extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }
    public function index()
    {
        $data['orders'] = $this->morder->getManagementOrders();
        $this->load->view('orders', $data);
    }
    public function get($id)
    {
        $data['order'] = $this->morder->getOrder($id);
        $this->load->view('order', $data);
    }
    public function set()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->morder->updateOrder($post_data, $id, array('vybavene')));
        }
        else
            echo json_encode(FALSE);
    }
}
