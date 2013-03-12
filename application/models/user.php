<?php

Class User extends DataMapper {

    var $table = 'users';
    var $validation = array(
        'first_name' => array(
            'label' => 'First Name',
            'rules' => array('required')
        ),
        'last_name' => array(
            'label' => 'Last Name',
            'rules' => array('required')
        ),
        'password' => array(
            'label' => 'Password',
            'rules' => array('required', 'encrypt'),
            'type' => 'password'
        )
//        'confirm_password' => array(
//            'label' => 'Confirm Password',
//            'rules' => array('required', 'encrypt', 'matches' => 'password', 'min_length' => 3, 'max_length' => 40),
//            'type' => 'password'
//            )
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
