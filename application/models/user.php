<?php

Class User extends DataMapper {

    var $table = 'users';
    var $validation = array(
        'username' => array(
            'label' => 'Username',
            'rules' => array('required')
        ),
        'staff_id' => array(
            'label' => 'Staff ID',
            'rules' => array('required')
        ),
        'role_id' => array(
            'label' => 'Role ID',
            'rules' => array('required')
        ),
        'password' => array(
            'label' => 'Password',
            'rules' => array('required', 'encrypt'),
            'type' => 'password'
        )
    );

    function __construct() {
        parent::__construct();
    }

    function login() {
        $uname = $this->username;
        $password = $this->password;

        $u = new User();
        $u->where('username', $uname)->get();
        $this->salt = $u->salt;
        $this->validate()->get();
        if ($this->exists()) {
            return TRUE;
        } else {
            $this->error_message('login', 'Username or password invalid');
            $this->username = $uname;
            return FALSE;
        }
    }

    function direct_page_access($access, $page, $status) {
        if ($access == '0') {
            switch ($status) {
                case'add': $pesan = 'Anda Tidak Punya Akses Untuk Menambah Data, Hubungi Administrator!';
                    break;
                case'edit': $pesan = 'Anda Tidak Punya Akses Untuk Koreksi Data, Hubungi Administrator!';
                    break;
                case'delete': $pesan = 'Anda Tidak Punya Akses Untuk Hapus Data, Hubungi Administrator!';
                    break;
                case'approval': $pesan = 'Anda Tidak Punya Akses Untuk Menyetujui, Hubungi Administrator!';
                    break;
                default: $pesan = 'Anda Tidak Punya Akses, Hubungi Administrator!';
            }

            $data = '<div class="error"><p>' . $pesan . '</p></div>';
            $this->session->set_flashdata('message', $data);
            redirect($page);
        } else {

            return false;
        }
    }

    function exist_module($role_id, $module) {
        $query = $this->db->get_where('user_roled', array(
                    'role_id' => $role_id,
                    'roled_module' => $module)
                )->row();
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function get_access($role_id, $module, $field) {
        $query = $this->db->get_where('user_roled', array(
                    'role_id' => $role_id,
                    'roled_module' => $module,
                    $field => true)
                )->row();
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function _delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}

?>
