<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MAddress extends MY_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'vAdresa'
    }

    public function getAddresses($id)
    {
        return $this->getRows(array('key' => 'clen', 'value' => $id), $this->table_name);
    }
    public function getAddress($id)
    {
        return $this->getRow($id, $this->table_name);
    }
    public function addAddress($data, $id)
    {    
        $this->db->insert($this->table_name, $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function editAddress($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function deleteAddress($id)
    {
        return $this->deleteRow($id);
    }
}
