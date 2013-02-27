<?php

class Meducation extends CI_Model {

    private $tbl_edu = "education";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_edu);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('edu_id', 'asc');
        return $this->db->get($this->tbl_edu, $limit, $offset);
    }

    function find($id) {
        $this->db->where('edu_id', $id);
        return $this->db->get($this->tbl_edu);
    }

    function save($branch) {
        $insert = $this->db->insert($this->tbl_edu, $branch);
        return $insert;
    }

    function update($id, $branch) {
        $this->db->where('edu_id', $id);
        $this->db->update($this->tbl_edu, $branch);
    }

    function delete($id) {
        $this->db->where('edu_id', $id);
        $this->db->delete($this->tbl_edu);
    }

}

?>