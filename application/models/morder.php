<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MOrder extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = array('vObjednavka', 'vObjednavkaPecivo');
    }

    public function getCustomerOrders($id)
    {
        return $this->getRows('podal', $id, 0);
    }
    public function getDriverOrders($id)
    {
        return $this->getRows('vodic', $id);
    }
    public function getOrder($id)
    {
        return $this->getRow($id);
    }
    public function addOrder($data)
    {    
        return $this->addRow($data);
    }
    public function editOrder($data, $id)
    {
        return $this->editRow($data, $id);
    }
    public function deleteOrder($id)
    {
        return $this->deleteRow($id);
    }

    public function getOrdersProducts()
    {
        return $this->getRows(NULL, NULL, 1);
    }
    public function getOrderProducts($id)
    {
        return $this->getRows('id', $id, 1);
    }
}
