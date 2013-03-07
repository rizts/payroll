<?php

class Salary_Component extends DataMapper {

    public $table = "salary_components";
    public $validation = array(
        'gaji_amount_value' => array(
            'label' => 'Value',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('gaji_id', $id);
        $this->db->delete($this->table);
    }

}

?>