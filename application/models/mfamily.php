<?php

class Mfamily extends CI_Model {

    private $tbl_family = "family";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_family);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('staff_fam_id', 'asc');
        return $this->db->get($this->tbl_family, $limit, $offset);
    }

    function find($id) {
        $this->db->where('staff_fam_id', $id);
        return $this->db->get($this->tbl_family);
    }

    function save($asset) {
        $insert = $this->db->insert($this->tbl_family, $asset);
        return $insert;
    }

    function update($id, $asset) {
        $this->db->where('staff_fam_id', $id);
        $this->db->update($this->tbl_family, $asset);
    }

    function delete($id) {
        $this->db->where('staff_fam_id', $id);
        $this->db->delete($this->tbl_family);
    }

}

?>