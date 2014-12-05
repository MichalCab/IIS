<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Class for operation around management section with order (Objednavky)
*/
class AllOrders extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('morder');
        if (! $this->auth->isLogged() || ! $this->auth->isAdmin())
            redirect('/user/login/', 'refresh');
    }

    /*
    Get all orders (Objednavky)
    */
    public function index()
    {
        $data['data']['orders'] = $this->morder->getManagementOrders();
        $data['view'] = 'mAllorders';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Get detail of selected order
    */
    public function get($id)
    {
        $data['data']['order'] = (object)$this->morder->getOrder($id);
        $data['data']['order_products'] = $this->morder->getOrderProducts($id);
        $data['view'] = 'mAllordersDetail';
        $this->load->view('_container', $this->statman->setActualStatus($data));
    }

    /*
    Set order state to completed. If customer want to pick up directly in bakery
    then management will check it.
    */
    public function set($id)
    {
        $post_data['vybavene'] = 1;
        if($this->morder->editOrder($id, $post_data, array('vybavene'), NULL, array('vybavene')))
        {
            $this->statman->setSuccessStatus("Objednávka označena za vyřízenou");
            redirect('/allorders/get/'.$id, 'refresh');
        }
        else
        {
            $this->statman->setErrorStatus("Objednávku nelze označit za vyřízenou");
            redirect('/allorders/get/'.$id, 'refresh');
        }
    }
}
