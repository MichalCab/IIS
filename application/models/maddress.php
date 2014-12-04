<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MAddress extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vAdresa');
        $this->table_insert_names = array('Adresa');
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
            $attributes = array('adresa', 'clen');

        $non_empty_columns = array('adresa', 'clen');
        return $this->addRow($data, $attributes, array(), $non_empty_columns);
    }
    public function editAddress($id, &$data)
    {
        if ($this->auth->isCustomer())
        {
            $attributes = array('adresa');
            $non_empty_columns = array('adresa');
        }
        elseif ($this->auth->isAdmin())
        {
            $attributes = array('oblast');
            $non_empty_columns = array('oblast');
        }

        
        return $this->editRow($id, $data, $attributes, array(), $non_empty_columns);
    }
    public function deleteAddress($id)
    {
        return $this->deleteRow($id);
    }
}
