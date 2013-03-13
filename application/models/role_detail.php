<?php

class Role_Detail extends DataMapper {

    var $table = "user_roled";
    var $validation = array(
        'roled_module' => array(
            'label' => 'Role Module',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('roled_id', $id);
        $this->db->delete($this->table);
    }

}

?>