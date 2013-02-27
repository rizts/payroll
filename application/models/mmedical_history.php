<?php

class Mmedical_history extends CI_Model {

    private $tbl_mh = "medical";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_mh);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('medic_id', 'asc');
        return $this->db->get($this->tbl_mh, $limit, $offset);
    }

    function find($id) {
        $this->db->where('medic_id', $id);
        return $this->db->get($this->tbl_mh);
    }

    function save($branch) {
        $insert = $this->db->insert($this->tbl_mh, $branch);
        return $insert;
    }

    function update($id, $branch) {
        $this->db->where('medic_id', $id);
        $this->db->update($this->tbl_mh, $branch);
    }

    function delete($id) {
        $this->db->where('medic_id', $id);
        $this->db->delete($this->tbl_mh);
    }

}

?>