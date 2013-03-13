<?php

class Role extends DataMapper {

    var $table = "user_roles";
    var $validation = array(
        'role_name' => array(
            'label' => 'Role Name',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('role_id', $id);
        $this->db->delete($this->table);
    }

}

?>