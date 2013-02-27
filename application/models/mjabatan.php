<?php

class Mjabatan extends CI_Model {

    private $tbl_jbt = "title";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_jbt);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('title_id', 'asc');
        return $this->db->get($this->tbl_jbt, $limit, $offset);
    }

    function find($id) {
        $this->db->where('title_id', $id);
        return $this->db->get($this->tbl_jbt);
    }

    function save($jabatan) {
        $insert = $this->db->insert($this->tbl_jbt, $jabatan);
        return $insert;
    }

    function update($id, $jabatan) {
        $this->db->where('title_id', $id);
        $this->db->update($this->tbl_jbt, $jabatan);
    }

    function delete($id) {
        $this->db->where('title_id', $id);
        $this->db->delete($this->tbl_jbt);
    }

    function list_drop() {
        $this->db->select('*');
        $this->db->from($this->tbl_jbt);
        $this->db->order_by('title_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $data[''] = '[ Pilih Jabatan ]';
            $data[$row->title_name] = $row->title_name;
        }
        return $data;
    }

}

?>