<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MMaterial extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = array('vSurovina');
        $this->table_insert_names = array('Surovina');
    }

    public function getMaterials($id)
    {
        return $this->getRows('id', $id, 0);
    }
    public function getMaterial($id)
    {
        return $this->getRow($id);
    }
    public function addMaterial($data)
    {
        
        $attributes = array('nazov', 'nakupniCena', 'naSklade');
        return $this->addRow($data, $attributes);
    }
    public function editMaterial($data, $id, $attributes, $non_empty)
    {
        $attributes = array('nazov', 'nakupniCena', 'naSklade');
        $non_empty = array('nazov', 'nakupniCena', 'naSklade');
        return $this->editRow($data, $id, $attributes, $this->unset_attributes, $non_empty);
    }
    public function deleteMaterial($id)
    {
        return $this->deleteRow($id);
    }
}
