<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MMaterial extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vSurovina');
        $this->table_insert_names = array('Surovina');
    }

    public function getMaterials()
    {
        return $this->getRows(NULL, NULL, 0);
    }
    public function getMaterial($id)
    {
        return $this->getRow($id);
    }
    public function addMaterial(&$data)
    {
        return $this->addRow($data, array('nazov', 'nakupnaCena', 'naSklade'), NULL, array('nazov', 'nakupnaCena', 'naSklade'));
    }
    public function editMaterial($id, &$data)
    {
        return $this->editRow($id, $data, array('nazov', 'nakupnaCena', 'naSklade'), NULL, array('nazov', 'nakupnaCena', 'naSklade'));
    }
    public function deleteMaterial($id)
    {
        return $this->deleteRow($id);
    }
}
