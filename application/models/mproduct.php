<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProduct extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vPecivo', 'vPecivoSurovina');
    }

    public function getProducts($id)
    {
        return $this->getRows($id, $id, 0);
    }
    public function getProduct($id)
    {
        return $this->getRow($id);
    }
    public function addProduct($data)
    {   
        if ($this->auth->isAdmin())
            $attributes = array('nazov', 'cena', 'popis');
        return $this->addRow($data, $attributes);
    }
    public function editProduct($data, $id)
    {
        if ($this->auth->isAdmin())
            $attributes = array('nazov', 'cena', 'popis');
        return $this->editRow($data, $id, $attributes);
    }
    public function deleteProduct($id)
    {
        return $this->deleteRow($id);
    }

    public function getProductMaterial($id)
    {
        return $this->getRows($id, $id, 1);
    }
}
