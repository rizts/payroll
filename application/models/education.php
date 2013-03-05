<?php

class Education extends DataMapper {

    public $table = "educations";
    public $has_one = array('staff');

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('edu_id', $id);
        $this->db->delete($this->table);
    }

}

?>