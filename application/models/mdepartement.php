<?php

class Mdepartement extends CI_Model {

    private $tbl_dept = "departement";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_dept);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('dept_id', 'asc');
        return $this->db->get($this->tbl_dept, $limit, $offset);
    }

    function find($id) {
        $this->db->where('dept_id', $id);
        return $this->db->get($this->tbl_dept);
    }

    function save($dept) {
        $insert = $this->db->insert($this->tbl_dept, $dept);
        return $insert;
    }

    function update($id, $dept) {
        $this->db->where('dept_id', $id);
        $this->db->update($this->tbl_dept, $dept);
    }

    function delete($id) {
        $this->db->where('dept_id', $id);
        $this->db->delete($this->tbl_dept);
    }

    function list_drop() {
        $this->db->select('*');
        $this->db->from($this->tbl_dept);
        $this->db->order_by('dept_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $data[''] = '[ Pilih Departement ]';
            $data[$row->dept_name] = $row->dept_name;
        }
        return $data;
    }

}

?>