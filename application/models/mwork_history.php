<?php

class Mwork_History extends CI_Model {

    private $tbl_wh = "work_history";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_wh);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('history_id', 'ASC');
        return $this->db->get($this->tbl_wh, $limit, $offset);
    }

    function find($id) {
        $this->db->where('history_id', $id);
        return $this->db->get($this->tbl_wh);
    }

    function save($branch) {
        $insert = $this->db->insert($this->tbl_wh, $branch);
        return $insert;
    }

    function update($id, $branch) {
        $this->db->where('history_id', $id);
        $this->db->update($this->tbl_wh, $branch);
    }

    function delete($id) {
        $this->db->where('history_id', $id);
        $this->db->delete($this->tbl_wh);
    }

}

?>