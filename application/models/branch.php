<?php

class Branch extends DataMapper {

    public $table = "branches";
    public $validation = array(
        'branch_name' => array(
            'label' => 'Branch Name',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('branch_id', $id);
        $this->db->delete($this->table);
    }

    function list_drop() {
        $branch = new Branch();
        $branch->get();
        foreach ($branch as $row) {
            $data[''] = '[ Pilih Cabang ]';
            $data[$row->branch_name] = $row->branch_name;
        }
        return $data;
    }

}

?>