<?php

class Mstaff extends CI_Model {

    private $tbl_staff = "staff";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_staff);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('staff_id', 'asc');
        return $this->db->get($this->tbl_staff, $limit, $offset);
    }

    function find($id) {
        $this->db->where('staff_id', $id);
        return $this->db->get($this->tbl_staff);
    }

    function save($staff) {
        $insert = $this->db->insert($this->tbl_staff, $staff);
        return $insert;
    }

    function update($id, $staff) {
        $this->db->where('staff_id', $id);
        $this->db->update($this->tbl_staff, $staff);
    }

    function delete($id) {
        $this->db->where('staff_id', $id);
        $this->db->delete($this->tbl_staff);
    }

}

?>