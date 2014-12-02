<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUser extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = array('vClen');
    }

    public function getUsers()
    {
        return $this->getRows(NULL, NULL, 0);
    }
    public function getUser($id)
    {
        return $this->getRow($id);
    }
    public function addUser($data)
    {    
        if (! $this->auth->isLogged())
            $attributes = array('login', 'heslo', 'heslo_znovu', 'meno', 'priezvisko');
        if ($this->auth->isAdmin())
            $attributes = array('login', 'heslo', 'heslo_znovu', 'meno', 'priezvisko', 'typ');
        return $this->addRow($data, $attributes);
    }
    public function editUser($data, $id)
    {
        if ($this->auth->isAdmin())
            $attributes = array('evidovany');
        return $this->editRow($data, $id, $attributes);
    }
    public function deleteUser($id)
    {
        return $this->deleteRow($id);
    }
}
