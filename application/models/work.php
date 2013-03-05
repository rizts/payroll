<?php

class Work extends DataMapper {

    public $table = "work_histories";
    public $validation = array(
        'history_date' => array(
            'label' => 'Work Date',
            'rules' => array('required')
        ),
        'history_description' => array(
            'label' => 'Work Description',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('history_id', $id);
        $this->db->delete($this->table);
    }

}

?>