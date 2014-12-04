<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        
        if (!$this->auth->isCustomer())
            redirect('/user', 'refresh');
    }
    public function index()
    {
        $data['orders'] = $this->morder->getCustomerOrders($this->userData->id);
        $this->load->view('order', $data);
    }
    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            $post_data["id"] = $this->userData->id;
            echo json_encode($this->morder->addOrder($post_data));
            return;
        }   
        else
        {
            $data['addresses'] = $this->morder->getAddresses($this->userData->id);
            $data['products'] = $this->mproduct->getProducts();
            $this->load->view('product_add', $data);
        }
    }
    public function get($id)
    {
        $data['order'] = $this->morder->getOrder($id);
        $data['order_product'] = $this->morder->getOrderProduct($id);
        $this->load->view('order', $data);
    }
}
