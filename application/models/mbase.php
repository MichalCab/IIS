<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function getRows($id, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($id["key"], $["value"]);
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }
    public function getRow($id, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row();
        $query->free_result();
        return $result;
    }
    public function addRow($data, $id, $table)
    {
        $this->db->insert($table, $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function editRow($data, $id, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function deleteRow($id)
    {
        if ($id === FALSE)
            return FALSE;
        $data = array("deleted" => "1");
        $this->db->where('id', $id);
        $this->db->update('Stav');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
