<?php

class Family extends DataMapper {

    public $table = "families";
    public $has_one = array('staff');

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function _delete($id) {
        $this->db->where('staff_fam_id', $id);
        $this->db->delete($this->table);
    }

}

?>