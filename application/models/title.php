<?php

class Title extends DataMapper {

    var $table = "titles";
    var $validation = array(
        'title_name' => array(
            'label' => 'Title Name',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('title_id', $id);
        $this->db->delete($this->table);
    }

    function list_drop() {
        $title = new Title();
        $title->get();
        foreach ($title as $row) {
            $data[''] = '[ Title ]';
            $data[$row->title_name] = $row->title_name;
        }
        return $data;
    }

}

?>