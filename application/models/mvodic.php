<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVodic extends CI_Model {

    function MVodic()
    {
        parent::__construct();
    }

    public function test( )
    {
        $this->db->select('id');
        $query = $this->db->get('vClen');

        $result = $query->result();
        $query->free_result();

        return $result;
    }
}