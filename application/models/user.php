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

// --------------------------------------------------------------------

    /**
     * Encrypt (prep)
     *
     * Encrypts this objects password with a random salt.
     *
     * @access    private
     * @param    string
     * @return    void
     */
    function _encrypt($field) {
        if (!empty($this->{$field})) {
            if (empty($this->salt)) {
                $this->salt = md5(uniqid(rand(), true));
            }

            $this->{$field} = sha1($this->salt . $this->{$field});
        }
    }

}

?>
