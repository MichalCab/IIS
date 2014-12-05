<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Class for operation around driver section with orders (Objednavky)
*/
class Orders extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        if (! $this->auth->isDriver())
            redirect('/user/', 'refresh');
    }

    /*
    Get driver orders (Objednavky) for processing 
    */
    public function index()
    {
        $data['data']['orders'] = $this->morder->getDriverOrders($this->userData->id);
        $data['view'] = 'dOrders';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Get detail of selected order
    */    
    public function get($id)
    {
        $data['data']['order'] = (object)$this->morder->getOrder($id);
        $data['data']['order_products'] = $this->morder->getOrderProducts($id);
        $data['view'] = 'dOrdersDetail';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Set up order as completed
    */
    public function set($id)
    {
        $post_data['vybavene'] = 1;
        if($this->morder->editOrder($id, $post_data))
        {
            $this->statman->setSuccessStatus("Objednávka označena za vyřízenou");
            redirect('/orders/get/'.$id, 'refresh');
        }
        else
        {
            $this->statman->setErrorStatus("Objednávku nelze označit za vyřízenou");
            redirect('/orders/get/'.$id, 'refresh');
        }
    }
}