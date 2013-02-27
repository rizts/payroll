<?php

class Msalary_Component extends CI_Model {

    private $tbl_salary = "salary_component";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_salary);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('gaji_id', 'asc');
        return $this->db->get($this->tbl_salary, $limit, $offset);
    }

    function find($id) {
        $this->db->where('gaji_id', $id);
        return $this->db->get($this->tbl_salary);
    }

    function save($branch) {
        $insert = $this->db->insert($this->tbl_salary, $branch);
        return $insert;
    }

    function update($id, $branch) {
        $this->db->where('gaji_id', $id);
        $this->db->update($this->tbl_salary, $branch);
    }

    function delete($id) {
        $this->db->where('gaji_id', $id);
        $this->db->delete($this->tbl_salary);
    }

}

?>