<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MArea extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = array('vOblastRozvozu', 'vOblastRozvozuAdresa');
    }

    public function getAreas()
    {
        return $this->getRows(NULL, NULL, 0);
    }
    public function getArea($id)
    {
        return $this->getRow($id);
    }
    public function addArea($data)
    {
        $attributes = array('nazov');
        return $this->addRow($data, $attributes);
    }
    public function editArea($data, $id)
    {
        $attributes = array('nazov', 'spravuje');
        return $this->editRow($data, $id, $attributes);
    }
    public function deleteArea($id)
    {
        return $this->deleteRow($id);
    }

    public function getAreasAddresses()
    {
        return $this->getRows(NULL, NULL, 1);
    }
    public function getAreaAddresses($id)
    {
        return $this->getRows('id', $id, 1);
    }
}
