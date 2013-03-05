<?php

class Salary extends DataMapper {

    public $table = "salaries";
    public $validation = array(
        'salary_periode' => array(
            'label' => 'Periode',
            'rules' => array('required')
        ),
        'salary_staffid' => array(
            'label' => 'Staff ID',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('salary_id', $id);
        $this->db->delete($this->table);
    }

}

?>