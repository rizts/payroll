<?php

class Mstatus_pajak_karyawan extends CI_Model {

    private $tbl_spk = "status_pajak_karyawan";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_spk);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('sp_id', 'asc');
        return $this->db->get($this->tbl_spk, $limit, $offset);
    }

    function find($id) {
        $this->db->where('sp_id', $id);
        return $this->db->get($this->tbl_spk);
    }

    function save($spk) {
        $insert = $this->db->insert($this->tbl_spk, $spk);
        return $insert;
    }

    function update($id, $spk) {
        $this->db->where('sp_id', $id);
        $this->db->update($this->tbl_spk, $spk);
    }

    function delete($id) {
        $this->db->where('sp_id', $id);
        $this->db->delete($this->tbl_spk);
    }

    function list_drop() {
        $this->db->select('*');
        $this->db->from($this->tbl_spk);
        $this->db->order_by('sp_status', 'ASC');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $data[''] = '[ Pilih Pajak karyawan ]';
            $data[$row->sp_status] = $row->sp_status;
        }
        return $data;
    }

}

?>