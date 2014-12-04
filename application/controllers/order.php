<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        $this->load->model('mproduct');
        if (!$this->auth->isCustomer())
            redirect('/user', 'refresh');
    }
    public function index()
    {
        $data['orders'] = $this->morder->getCustomerOrders($this->userData->id);
        $data['view'] = 'cOrder';
        $this->load->view('_container', $data);
    }
    public function add()
    {
        $data = array('view' => 'cOrderAdd');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            $post_data["id"] = $this->userData->id;
            if ($this->morder->addOrder($post_data))
            {
                $this->statman->setSuccessStatus("Úspěšně jste přidali objednávku");
                redirect('/order', 'refresh');
            }
            else
            {
                $data['data']['order'] = (object) $post_data;
                $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
            }
        }   
        else
        {
            $data['data']['addresses'] = $this->morder->getAddresses($this->userData->id);
            $data['data']['products'] = $this->mproduct->getProducts();
            $this->load->view('_container', $this->statman->setErrorNow($post_data['error'], $data));
        }
    }
    public function get($id)
    {
        $data['data']['order'] = $this->morder->getOrder($id);
        $data['data']['order_product'] = $this->morder->getOrderProducts($id);
        $data['view'] = 'cOrderDetail';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
}
