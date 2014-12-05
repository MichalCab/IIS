<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Universal abstact model class for low level data manipulation
*/
class MY_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();

        //contains names of tables from whitch we want select (views)
        $this->table_names = array();

        //contains names of tables from whitch we want insert/update (real tables)
        $this->table_insert_names = array();

        //attributes whitch we want to insert into database (contains table columns)
        $this->attributes = array();

        //attributes from http post whitch we want to unset (repeated password)
        $this->unset_attributes = array();

        //attributes whitch cant be empty (this can be solved by catching DB exception)
        $this->non_empty_columns = array();
    }

    /*
    Set up optional params to instance variables
    */
    public function setUpOptionalParams($attributes=NULL, $unsetAttributes=NULL, $nonEmptyColumns=NULL)
    {
        if ($attributes !== NULL)
            $this->attributes = $attributes;
        if ($unsetAttributes !== NULL)
            $this->unset_attributes = $unsetAttributes;
        if ($nonEmptyColumns !== NULL)
            $this->non_empty_columns = $nonEmptyColumns;
    } 

    /*
    Universal function for get rows from entered table.
    For all entries set column to NULL
    */
    public function getRows($column, $id, $table_index)
    {
        #if ((count($this->table_names) - 1) < $table_index)
        #    $table_index = 0;
        $this->db->select('*');
        $this->db->from($this->table_names[$table_index]);
        #echo $table_index;
        #echo $this->table_names[$table_index];
        if ($column != NULL)
            $this->db->where($column, $id);
        $query = $this->db->get();
        #print_r($query);
        #var_dump($this->db->queries);
        $result = $query->result();
        $query->free_result();
        return $result;
    }
    
    /*
    Universal function for get row from database by id
    from entered table
    */
    public function getRow($id, $table_index = 0)
    {
        #echo $table_index;
        #echo $this->table_names[$table_index];
        #if ((count($this->table_names) - 1) < $table_index)
        #    $table_index = 0;
        $this->db->select('*');
        $this->db->from($this->table_names[$table_index]);
        $this->db->where('id', $id);
        $query = $this->db->get();
        #print_r($query);
        #var_dump($this->db->queries);
        $result = $query->row();
        $query->free_result();
        #var_dump($result);
        return $result;
    }

    /*
    Universal function for add row, inputs are validaded.
    Return error message in data value, return false if failed
    */
    public function addRow(&$data, $attributes=NULL, $unsetAttributes=NULL, $nonEmptyColumns=NULL)
    {
        $this->setUpOptionalParams($attributes, $unsetAttributes, $nonEmptyColumns);
        var_dump($data);
        var_dump($this->attributes);
        var_dump($this->unset_attributes);
        var_dump($this->non_empty_columns);
        $messages = $this->modelvalidator->valideInsert($data, $this->attributes, 
                                                        $this->unset_attributes,
                                                        $this->non_empty_columns);
        if (!$messages["res"])
        {
            $data = array_merge($data, $messages);
            return false;
        }
        $this->db->insert($this->table_insert_names[0], $data); #IDEA catch db error and transform to user
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
    Universal function for edit row, inputs are validated.
    Return error message in data value, return false if failed

    Get old values because if we are updating row with same data, 
    then affected_row() returns zero
    */
    public function editRow($id, &$data, $attributes=NULL, $unsetAttributes=NULL, $nonEmptyColumns=NULL)
    {
        $this->setUpOptionalParams($attributes, $unsetAttributes, $nonEmptyColumns);
        $oldValues = $this->getRow($id);
        $messages = $this->modelvalidator->valideUpdate($data, $this->attributes,
                                                        $this->unset_attributes,
                                                        $this->non_empty_columns,
                                                        $oldValues);
        if ($messages["res"] === FALSE)
        {
            $data = array_merge($data, $messages);
            return false;
        }
        $this->db->where('id', $id);
        $this->db->update($this->table_names[0], $data); #IDEA catch db error
        if (isset($data['changed']) && $data['changed'] === FALSE)
            return TRUE;
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
    Set deleted to "1" just in table "Stav". 
    Because we want stored all values in db.
    */
    public function deleteRow($id)
    {
        if ($id === FALSE)
            return FALSE;
        $data = array("deleted" => "1");
        $this->db->where('id', $id);
        $this->db->update('Stav', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    /*
    Set deleted to "0" (that mean active) just in table "Stav". 
    Because we want stored all values in db.
    */
    public function unDeleteRow($id)
    {
        if ($id === FALSE)
            return FALSE;
        $data = array("deleted" => "0");
        $this->db->where('id', $id);
        $this->db->update('Stav', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}
