<?php

class Mbranch extends CI_Model {

    private $tbl_branch = "branch";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_branch);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('branch_id', 'asc');
        return $this->db->get($this->tbl_branch, $limit, $offset);
    }

    function find($id) {
        $this->db->where('branch_id', $id);
        return $this->db->get($this->tbl_branch);
    }

    function save($branch) {
        $insert = $this->db->insert($this->tbl_branch, $branch);
        return $insert;
    }

    function update($id, $branch) {
        $this->db->where('branch_id', $id);
        $this->db->update($this->tbl_branch, $branch);
    }

    function delete($id) {
        $this->db->where('branch_id', $id);
        $this->db->delete($this->tbl_branch);
    }

    function list_drop() {
        $this->db->select('*');
        $this->db->from($this->tbl_branch);
        $this->db->order_by('branch_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $data[''] = '[ Pilih Cabang ]';
            $data[$row->branch_name] = $row->branch_name;
        }
        return $data;
    }

}

?>