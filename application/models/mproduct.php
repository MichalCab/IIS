<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProduct extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vPecivo', 'vPecivoSurovina');
        $this->table_insert_names = array('Pecivo');
    }

    public function getProducts()
    {
        return $this->getRows(NULL, NULL, 0);
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
    public function editProduct($id, $data)
    {
        if ($this->auth->isAdmin())
            $attributes = array('nazov', 'cena', 'popis');
        return $this->editRow($id, $data, $attributes);
    }
    public function deleteProduct($id)
    {
        return $this->deleteRow($id);
    }

    public function getProductMaterials($id)
    {
        return $this->getRows('id', $id, 1);
    }
}
