<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MOrders extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'vObjednavka';
    }

    public function getOrders($id)
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
}
