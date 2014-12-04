<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUser extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = array('vClen');
        $this->table_insert_names = array('Clen');
    }

    public function getUsers()
    {
        return $this->getRows(NULL, NULL, 0);
    }
    public function getUser($id)
    {
        return $this->getRow($id);
    }
    public function addUser(&$data)
    {    
        if (! $this->auth->isLogged())
        {
            var_dump($data);
            $attributes = array('login', 'heslo', 'heslo_znovu', 'meno', 'priezvisko');
        }
        if ($this->auth->isAdmin())
            $attributes = array('login', 'heslo', 'heslo_znovu', 'meno', 'priezvisko', 'typ');
        return $this->addRow($data, $attributes, array('heslo_znovu'));
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
