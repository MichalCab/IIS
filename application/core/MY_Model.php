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
        $this->db->from($this->table_names[$table_index]);
        if ($id != $id)
            $this->db->where($column, $id);
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        return $result;
    }
    public function getRow($id, $table_index = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table_names[$table_index]);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row();
        $query->free_result();
        return $result;
    }
    public function addRow(&$data, $attibutes, $unset_attributes = array())
    {
        $messages = $this->modelvalidator->valideInsert($data, $attibutes, $unset_attributes);
        if (!$messages["res"])
        {
            $data = array_merge($data, $messages);
            return false;
        }
        $this->db->insert($this->table_insert_names[0], $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function editRow($id, &$data, $attributes = array())
    {
        $messages = $this->modelvalidator->valideUpdate($data, $attributes);
        if (!$messages["res"])
        {
            $data = array_merge($data, $messages);
            return false;
        }
        $this->db->where('id', $id);
        $this->db->update($this->table_names[0], $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function deleteRow($id)
    {
        if ($id === FALSE)
            return FALSE;
        $data = array("deleted" => "1");
        $this->db->where('id', $id);
        $this->db->update('Stav', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
