<?php

class Marital extends DataMapper {

    var $table = "maritals_status";
    var $validation = array(
        'sn_name' => array(
            'label' => 'Married Status',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('sn_id', $id);
        $this->db->delete($this->table);
    }

    function list_drop() {
        $marital = new Marital();
        $marital->get();

        foreach ($marital as $row) {
            $data[''] = '[ Pilih Status Nikah ]';
            $data[$row->sn_name] = $row->sn_name;
        }
        return $data;
    }

}

?>