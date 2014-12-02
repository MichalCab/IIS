<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUsers extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'vClen';
    }

    public function getUsers($id)
    {
        return $this->getRows($id, $id);
    }
    public function getUser($id)
    {
        return $this->getRow($id);
    }
    public function addUser($data)
    {    
        return $this->addRow($data);
    }
    public function editUser($data, $id)
    {
        return $this->editRow($data, $id);
    }
    public function deleteUser($id)
    {
        return $this->deleteRow($id);
    }
}
