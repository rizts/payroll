<?php

class Department extends DataMapper {

    var $table = "departments";
    var $validation = array(
        'dept_name' => array(
            'label' => 'Department Name',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('dept_id', $id);
        $this->db->delete($this->table);
    }

    function list_drop() {
        $dept = new Department();
        $dept->get();
        foreach ($dept as $row) {
            $data[''] = '[ Pilih Departement ]';
            $data[$row->dept_name] = $row->dept_name;
        }
        return $data;
    }

}

?>