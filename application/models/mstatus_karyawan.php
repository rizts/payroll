<?php

class Mstatus_Karyawan extends CI_Model {

    private $tbl_sk = "status_karyawan";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_sk);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('sk_id', 'asc');
        return $this->db->get($this->tbl_sk, $limit, $offset);
    }

    function find($id) {
        $this->db->where('sk_id', $id);
        return $this->db->get($this->tbl_sk);
    }

    function save($sk) {
        $insert = $this->db->insert($this->tbl_sk, $sk);
        return $insert;
    }

    function update($id, $sk) {
        $this->db->where('sk_id', $id);
        $this->db->update($this->tbl_sk, $sk);
    }

    function delete($id) {
        $this->db->where('sk_id', $id);
        $this->db->delete($this->tbl_sk);
    }

    function list_drop() {
        $this->db->select('*');
        $this->db->from($this->tbl_sk);
        $this->db->order_by('sk_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $data[''] = '[ Pilih Status Karyawan ]';
            $data[$row->sk_name] = $row->sk_name;
        }
        return $data;
    }

}

?>