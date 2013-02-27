<?php

class Mgaji extends CI_Model {

    private $tbl_gaji = "component";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_gaji);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('comp_id', 'asc');
        return $this->db->get($this->tbl_gaji, $limit, $offset);
    }

    function find($id) {
        $this->db->where('comp_id', $id);
        return $this->db->get($this->tbl_gaji);
    }

    function save($gaji) {
        $insert = $this->db->insert($this->tbl_gaji, $gaji);
        return $insert;
    }

    function update($id, $gaji) {
        $this->db->where('comp_id', $id);
        $this->db->update($this->tbl_gaji, $gaji);
    }

    function delete($id) {
        $this->db->where('comp_id', $id);
        $this->db->delete($this->tbl_gaji);
    }

}

?>