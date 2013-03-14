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

    function get_privileges($role_id, $field, $privilege) {
        $query = $this->db->get_where($this->table, array('role_id' => $role_id, $field => $privilege))->row();
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    function get_module($role_id, $module) {
        $query = $this->db->get_where($this->table, array('role_id' => $role_id, 'roled_module' => $module))->row();
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    function _delete($id) {
        $this->db->where('roled_id', $id);
        $this->db->delete($this->table);
    }

    function delete_by_role_id($id) {
        $this->db->where('role_id', $id);
        $this->db->delete($this->table);
    }

}

?>