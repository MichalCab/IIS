<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MAddress extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'vAdresa';
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
    public function addAddress($data)
    {    
        return $this->addRow($data);
    }
    public function editAddress($data, $id)
    {
        return $this->editRow($data, $id);
    }
    public function deleteAddress($id)
    {
        return $this->deleteRow($id);
    }
}
