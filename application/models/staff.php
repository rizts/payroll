<?php

class Staff extends DataMapper {

    public $table = "staffs";
    public $has_many = array('family');
    public $validation = array(
        'staff_nik' => array(
            'label' => 'Staff NIK',
            'rules' => array('required')
        ),
        'staff_kode_absen' => array(
            'label' => 'Code Absen',
            'rules' => array('required')
        ),
        'staff_name' => array(
            'label' => 'Staff Name',
            'rules' => array('required')
        )
    );

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function _delete($id) {
        $this->db->where('staff_id', $id);
        $this->db->delete($this->table);
    }

}

?>