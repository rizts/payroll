<?php

class Asset_Detail extends DataMapper {

    var $table = "asset_details";
    var $has_one = array("asset");
    var $validation = array(
        'asset_id' => array(
            'label' => 'Asset ID',
            'rules' => array('required')
        ),
        'date' => array(
            'label' => 'Date Transaction',
            'rules' => array('required')
        ),
        'staff_id' => array(
            'label' => 'Staff ID',
            'rules' => array('required')
        ),
        'descriptions' => array(
            'label' => 'Description',
            'rules' => array('required')
        ),
        'assetd_status' => array(
            'label' => 'Status Asset Detail',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('assetd_id', $id);
        $this->db->delete($this->table);
    }

}

?>