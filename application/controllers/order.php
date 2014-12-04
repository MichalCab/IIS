<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        $this->load->model('mproduct');
        $this->load->model('maddress');
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
            if ($this->morder->addOrder($post_data, $this->userData->id))
            {
                $this->statman->setSuccessStatus("Úspěšně jste přidali objednávku");
                redirect('/order', 'refresh');
            }
            else
            {
                $data['data']['order'] = (object) $post_data;
                $data['data']['addresses'] = $this->maddress->getCustomerAddresses($this->userData->id);
                $data['data']['products'] = $this->mproduct->getProducts();
                $this->load->view('_container', $this->statman->setErrorNow((isset($post_data['error']) ? $post_data['error'] : "Nastala neočakávaná chyba"), $data));
            }
        }   
        else
        {
            $data['data']['addresses'] = $this->maddress->getCustomerAddresses($this->userData->id);
            $data['data']['products'] = $this->mproduct->getProducts();
            $this->load->view('_container', $this->statman->setActualStatus($data));
        }
    }
    public function get($id)
    {
        $data['data']['order'] = (object)$this->morder->getOrder($id);
        $data['data']['order_products'] = $this->morder->getOrderProducts($id);
        $data['view'] = 'cOrderDetail';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
}
