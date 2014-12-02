<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProduct extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'vPecivo';
    }

    public function getProducts($id)
    {
        return $this->getRows($id, $id);
    }
    public function getProduct($id)
    {
        return $this->getRow($id);
    }
    public function addProduct($data)
    {    
        return $this->addRow($data);
    }
    public function editProduct($data, $id)
    {
        return $this->editRow($data, $id);
    }
    public function deleteProduct($id)
    {
        return $this->deleteRow($id);
    }

    public function getProductsMaterial($id)
    {
        return $this->getRows($id, $id);
    }
}
