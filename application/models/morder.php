<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MOrder extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vObjednavka', 'vObjednavkaPecivo', 'vObjednavkaAdresa');
        $this->table_insert_names = array('Objednavka', 'Zoznam');
    }

    public function getCustomerOrders($id)
    {
        return $this->getRows('podal', $id, 2);
    }
    public function getDriverOrders($id)
    {
        return $this->getRows('vodic', $id, 2);
    }
    public function getManagementOrders()
    {
        return $this->getRows(NULL, NULL, 2);
    }
    public function getOrder($id)
    {
        return $this->getRow($id);
    }

    public function addOrder($data)
    {   
        if ($this->auth->isCustomer()) 
            $attributes = array('podal, suma');
        return $this->addRow($data, $attributes);
    }
    public function editOrder($data, $id)
    {
        if ($this->auth->isAdmin() || $this->auth->isDriver())
            $attributes = array('vybavene');
        return $this->editRow($data, $id, $attributes);
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
