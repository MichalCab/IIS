<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MMaterial extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'vSurovina';
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
        return $this->addRow($data);
    }
    public function editMaterial($data, $id)
    {
        return $this->editRow($data, $id);
    }
    public function deleteMaterial($id)
    {
        return $this->deleteRow($id);
    }
}