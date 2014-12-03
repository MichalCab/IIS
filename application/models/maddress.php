<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MAddress extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vAdresa');
        $this->table_insert_names = array('vAdresa');
    }

    public function getCustomerAddresses($id)
    {
        return $this->getRows('clen', $id, 0);
    }
    public function getManagementAddresses()
    {
        return $this->getRows(NULL, NULL, 0);
    }
    public function getAddress($id)
    {
        return $this->getRow($id);
    }
    public function addAddress(&$data)
    {    
        if ($this->auth->isCustomer())
            $attributes = array('adresa');

        return $this->addRow($data, $attributes);
    }
    public function editAddress($id, &$data)
    {
        if ($this->auth->isCustomer())
            $attributes = array('adresa');
        elseif ($this->auth->isAdmin())
            $attributes = array('oblast');

        return $this->editRow($id, $data, $attributes);
    }
    public function deleteAddress($id)
    {
        return $this->deleteRow($id);
    }
}
