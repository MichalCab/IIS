<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVodic extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function test( )
    {
        $query = $this->db->get('vClen');

        $result = $query->result();
        $query->free_result();

        return $result;
    }
}