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
        $data['view'] = 'dOrders';
        $this->load->view('_container', $data);
    }
    public function get($id)
    {
        $data['data']['order'] = (object)$this->morder->getOrder($id);
        $data['data']['order_products'] = $this->morder->getOrderProducts($id);
        $data['view'] = 'dOrdersDetail';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
    public function set($id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            echo json_encode($this->morder->editOrder($post_data, $id));
        }
        else
            echo json_encode(FALSE);
    }
}
