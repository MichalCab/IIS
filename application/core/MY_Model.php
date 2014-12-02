<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_names = NULL;
    }

    public function getRows($column, $id, $table_index)
    {
        $this->db->select('*');
        $this->db->from($this->table_name[$table_index]);
        if ($id != $id)
            $this->db->where($column, $id);
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }
    public function getRow($id)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row();
        $query->free_result();
        return $result;
    }
    public function addRow($data)
    {
        $this->Modelvalidator->valideInsert($data, $attibutes);
        $this->db->insert($this->table_names[0], $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function editRow($data, $id)
    {
        $this->Modelvalidator->valideUpdate($data, $attributes);
        $this->db->where('id', $id);
        $this->db->update($this->table_name[0], $data);
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
