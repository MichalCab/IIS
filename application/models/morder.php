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
        // validation
        if (isset($data["adresa"]))
        {
            if (strtolower($data["adresa"]) == 'null')
                $data["adresa"] = NULL;
        }

        /*
        if (isset($data["termin"]))
        {
            if (count(strtolower($data["termin"])) != 10)
                return false;
        }
        else
            return false;
        */
        $non_empty_columns = array('podal', 'adresa','termin');
        $data_copy = $data;
        $orderError = $this->addRow($data, $attributes, array(), $non_empty_columns);
        if ($orderError)
        {
            $orderId = $this->getLastIdOfOrderByOrderNumber($this->db->insert_id());
            $data['order_products'] = array();
            $final_price = 0.0;
            foreach ($data_copy as $key => $value)
            {
                if ($key != "termin" && $key != "adresa" && $key != "podal")
                {
                    $data['order_products'][$key] = $value;
                    if ($value != 0)
                    {
                        var_dump($value);
                        $this->addProductToOrder($key, $orderId, $value); #TODO it returns tru/false
                    }
                    $price = $this->getProductPrice($key);
                    $final_price += $value * $price;
                }
            }
            $this->editFinalPriceOfOrder($id, $final_price);
        }
        return $data;
    }
    public function getLastIdOfOrderByOrderNumber($cislo)
    {
        $this->db->select('id');
        $this->db->from('Objednavka');
        $this->db->where('cislo', $cislo);
        $query = $this->db->get();
        $result = $query->row();
        $query->free_result();
        return $result->id;
    }
    public function getProductPrice($id)
    {
        $this->db->select('cena');
        $this->db->from('Pecivo');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row();
        $query->free_result();
        return $result->cena;
    }
    public function addProductToOrder($productId, $orderId, $value)
    {
        $data = array('objednavka'=>$orderId, 'pecivo'=>$productId, 'mnozstvo'=>$value);
        $this->db->insert('Zoznam', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }   
    public function editFinalPriceOfOrder($id, $price)
    {
        $data = array("price"=>$price);
        $this->db->where('id', $id);
        $this->db->update('Objednavka', $data);
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
