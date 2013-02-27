<?php

class Mstatus_Nikah extends CI_Model {

    private $tbl_sn = "status_nikah";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_sn);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('sn_id', 'asc');
        return $this->db->get($this->tbl_sn, $limit, $offset);
    }

    function find($id) {
        $this->db->where('sn_id', $id);
        return $this->db->get($this->tbl_sn);
    }

    function save($sn) {
        $insert = $this->db->insert($this->tbl_sn, $sn);
        return $insert;
    }

    function update($id, $sn) {
        $this->db->where('sn_id', $id);
        $this->db->update($this->tbl_sn, $sn);
    }

    function delete($id) {
        $this->db->where('sn_id', $id);
        $this->db->delete($this->tbl_sn);
    }

    function list_drop() {
        $this->db->select('*');
        $this->db->from($this->tbl_sn);
        $this->db->order_by('sn_name', 'ASC');
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $data[''] = '[ Pilih Status Nikah ]';
            $data[$row->sn_name] = $row->sn_name;
        }
        return $data;
    }

}

?>