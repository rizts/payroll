<?php

/**
 * process_login
 * Validates that a username and password are correct.
 *
 * @param object $user The user containing the login information.
 * @return FALSE if invalid, TRUE or a redirect string if valid.
 */
class Login_Manager {

    function process_login($user) {
        // attempt the login
        $success = $user->login();
        if ($success) {
            // store the userid if the login was successful
            $this->session->set_userdata('logged_in_id', $user->id);
            // store the user for this request
            $this->logged_in_user = $user;
            // if a redirect is necessary, return it.
            $redirect = $this->session->userdata('login_redirect');
            if ($redirect !== FALSE) {
                $success = $redirect;
            }
        }
        return $success;
    }
}

?>
