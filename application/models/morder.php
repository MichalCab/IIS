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
        return $this->getRow($id, 2);
    }

    public function addOrder(&$data, $userId)
    {   
        if ($this->auth->isCustomer()) 
            $attributes = array('podal', 'termin', 'adresa');
        
        $data['podal'] = $userId;
        if (isset($data["adresa"]))
        {
            if ($data["adresa"] == 'null')
                unset($data["adresa"]);
        }
        else
            return false; 
        $orderError = $this->addRow($data, $attributes);
        if ($orderError)
        {
            $orderId = $this->db->insert_id();
            $orderError['order_products'] = array();
            foreach ($data as $key => $value)
            {
                if ($key != "termin" && $key != "adresa" && $key != "podal")
                {
                    $orderError['order_products'][$key] = $value;
                    $this->addProductToOrder($data, $orderId);
                }
            }
        }
        return $orderError;
    }
    public function addProductToOrder($idProduct, $idOrder, $value)
    {
        $data = array('objednavka'=>$idOrder, 'pecivo'=>$idProduct, 'mnozstvo'=>$value);
        $this->db->insert('vZoznam', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }   
    public function editOrder($id, &$data)
    {
        if ($this->auth->isAdmin() || $this->auth->isDriver())
            $attributes = array('vybavene');
        
        return $this->editRow($data, $attributes);
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
