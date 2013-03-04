<?php

class Medical extends DataMapper {

    public $table = "medical_histories";
    public $validation = array(
        'medic_date' => array(
            'label' => 'Medical Date',
            'rules' => array('required')
        ),
        'medic_description' => array(
            'label' => 'Medical Description',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('medic_id', $id);
        $this->db->delete($this->table);
    }

}

?>