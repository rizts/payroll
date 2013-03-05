<?php

class Component extends DataMapper {

    public $table = "components";
    public $validation = array(
        'comp_name' => array(
            'label' => 'Name',
            'rules' => array('required')
        ),
        'comp_type' => array(
            'label' => 'Type',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('comp_id', $id);
        $this->db->delete($this->table);
    }

}

?>