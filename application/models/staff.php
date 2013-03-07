<?php

class Staff extends DataMapper {

    var $table = "staffs";
    var $has_many = array(
        'family',
        'education',
        'work'
    );
    var $auto_populate_has_many = TRUE;
    var $auto_populate_has_one = TRUE;
    var $validation = array(
        'staff_nik' => array(
            'label' => 'Staff NIK',
            'rules' => array('required')
        ),
        'staff_kode_absen' => array(
            'label' => 'Code Absen',
            'rules' => array('required')
        )
//        'staff_name' => array(
//            'label' => 'Staff Name',
//            'rules' => array('required')
//        ),
//        'staff_email' => array(
//            'label' => 'Email Address',
//            'rules' => array('required', 'trim', 'unique', 'valid_email')
//        )
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