<?php

class Tax_Employee extends DataMapper {

    var $table = "taxes_employees";
    var $validation = array(
        'sp_status' => array(
            'label' => 'Status',
            'rules' => array('required')
        ),
        'sp_ptkp' => array(
            'label' => 'Value',
            'rules' => array('required')
        )
    );

    function __construct() {
        parent::__construct();
    }

    function _delete($id) {
        $this->db->where('sp_id', $id);
        $this->db->delete($this->table);
    }

    function list_drop() {
        $te = new Tax_Employee();
        $te->get();
        foreach ($te as $row) {
            $data[''] = '[ Pilih Pajak karyawan ]';
            $data[$row->sp_status] = $row->sp_status;
        }
        return $data;
    }

}

?>