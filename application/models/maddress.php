<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MAddress extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vAdresa');
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
            $attributes = array('adresa, clen');

        return $this->addRow($data, $attributes);
    }
    public function editAddress(&$data, $id)
    {
        if ($this->auth->isCustomer())
            $attributes = array('adresa, clen');
        elseif ($this->auth->isAdmin())
            $attributes = array('oblast');

        return $this->editRow($data, $id, $attributes);
    }
    public function deleteAddress($id)
    {
        return $this->deleteRow($id);
    }
}
