<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Searches extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index() {
        $staff = new Staff();
        $data['q'] = $this->input->get('q');
        $data['title'] = 'Payroll';
        $data['results'] = $data['q'] == '' ? '' : 'Search result for "' . $this->input->get('q') . '"';

        if ($data['q'] != '') {
            $rs = $staff->or_like('staff_name', '%' . $data['q'] . '%')
                            ->or_like('staff_cabang', '%' . $data['q'] . '%')
                            ->or_like('staff_departement', '%' . $data['q'] . '%')
                            ->or_like('staff_jabatan', '%' . $data['q'] . '%');
        }
        $data['search_list'] = $staff->get();

        $this->load->view('searches', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
