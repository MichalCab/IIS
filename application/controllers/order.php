<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Class for operation around customer section with order (Objednavky)
*/
class Order extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        $this->load->model('mproduct');
        $this->load->model('maddress');
        // check if role is customer
        if (!$this->auth->isCustomer())
            redirect('/user', 'refresh');
    }

    /*
    Get customer orders (Objednavky)
    */
    public function index()
    {
        $data['data']['orders'] = $this->morder->getCustomerOrders($this->userData->id);
        $data['view'] = 'cOrder';
        $this->load->view('_container', $data);
    }

    /*
    Add new order from customer
    */
    public function add()
    {
        $data = array('view' => 'cOrderAdd');
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $post_data = $this->input->post();
            if ($this->morder->addOrder($post_data, $this->userData->id)) //try to save to db
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

    /*
    Get detail of selected order 
    */
    public function get($id)
    {
        $data['data']['order'] = (object)$this->morder->getOrder($id);
        $data['data']['order_products'] = $this->morder->getOrderProducts($id);
        var_dump($data);
        $data['view'] = 'cOrderDetail';
        $this->load->view('_container', $data);
        #TODO
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }
}
