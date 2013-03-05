<?php

class Employee_Status extends DataMapper {

    var $table = "employees_status";
    var $validation = array(
        'sk_name' => array(
            'label' => 'Employee Status Name',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('sk_id', $id);
        $this->db->delete($this->table);
    }

    function list_drop() {
        $es = new Employee_Status();
        $es->get();
        foreach ($es as $row) {
            $data[''] = '[ Pilih Status Karyawan ]';
            $data[$row->sk_name] = $row->sk_name;
        }
        return $data;
    }

}

?>