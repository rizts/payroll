<?php

class Masset extends CI_Model {

    private $tbl_assets = "assets";

    function __construct() {
        parent::__construct();
    }

    function count_all() {
        return $this->db->count_all($this->tbl_assets);
    }

    function get_page_list($limit = 10, $offset = 0) {
        $this->db->order_by('asset_id', 'asc');
        return $this->db->get($this->tbl_assets, $limit, $offset);
    }

    function find($id) {
        $this->db->where('asset_id', $id);
        return $this->db->get($this->tbl_assets);
    }

    function save($asset) {
        $insert = $this->db->insert($this->tbl_assets, $asset);
        return $insert;
    }

    function update($id, $asset) {
        $this->db->where('asset_id', $id);
        $this->db->update($this->tbl_assets, $asset);
    }

    function delete($id) {
        $this->db->where('asset_id', $id);
        $this->db->delete($this->tbl_assets);
    }

}

?>