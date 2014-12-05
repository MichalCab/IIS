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
        var_dump($data);
        $data['view'] = 'mAllorders';
        $this->load->view('_container', $data);
    }

    /*
    Get detail of selected order
    */
    public function get($id)
    {
        $data['data']['order'] = (object)$this->morder->getOrder($id);
        $data['data']['order_products'] = $this->morder->getOrderProducts($id);
        $data['view'] = 'mAllorderDetail';
        $this->load->view('_container', $data);
    }

    /*
    Set order state to completed. If customer want to pick up directly in bakery
    then management will check it.
    */
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
