<?php

class Branch extends DataMapper {

    var $table = "branches";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        $branch = new Branch();
        return $branch->count();
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('branch_id', 'asc');
        return $this->db->get($this->table, $limit, $offset)->all;
    }

    function find($id) {
        $branch = new Branch();
        return $branch->find($id);
//        $this->db->where('branch_id', $id);
//        return $this->db->get($this->table);
    }

    function saved($branch) {
        $insert = $this->db->insert($this->table, $branch);
        return $insert;
    }

    function update($id, $branch) {
        $this->db->where('branch_id', $id);
        $this->db->update($this->table, $branch);
    }

    function deleted($id) {
        $this->db->where('branch_id', $id);
        $this->db->delete($this->table);
    }

    function list_drop() {
        $this->db->select('*');
        $this->db->from($this->table);
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