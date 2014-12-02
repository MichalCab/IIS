<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        #$this->userData = $this->auth->getUserData();
        if (! $this->auth->isLogged())
            redirect('/user/login/', 'refresh');
        if (! $this->auth->isDriver())
            redirect('/user/', 'refresh')
    }
    public function index()
    {
        $data['orders'] = $this->morder->getDriverOrders($this->userData->id)
        $this->load->view('orders', $data);
    }
    public function get($id)
    {
        $data['order'] = $this->morder->getOrder($id)
        $this->load->view('order', $data);
    }
    public function set($id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->morder->updateOrder($post_data, $id));
        }
        else
            echo json_encode(FALSE);
    }
}
