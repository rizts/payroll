<?php

class Setting extends DataMapper {

    public $table = "settings";
    public $validation = array(
        'name' => array(
            'label' => 'Config Name',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

}

?>