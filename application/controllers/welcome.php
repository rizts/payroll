<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Staff');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index() {
        $staff = new Staff();
        $data['staffs'] = $staff->get();
        $data['staff_count'] = $staff->count();
        $data['highchart_cabang'] = $this->highchart_cabang();
        $data['highchart_get_name_branch'] = $this->highchart_get_name_branch();
        $data['highchart_get_name_dept'] = $this->highchart_get_name_dept();


        $data['btn_new_staff'] = anchor('staffs/add', '<span class="icon-white icon-plus"></span>', array('class' => 'btn btn-primary bootstrap-tooltip', 'data-placement' => 'top', 'data-title' => 'Add new Employee'));
        $this->load->view('welcome_message', $data);
    }

    function highchart_cabang() {
        $cabang = array();
        $query = $this->db->query("SELECT staff_cabang AS Cabang,
                                    COUNT(staff_id) AS JML
                                    FROM staffs
                                    GROUP BY Cabang");
        foreach ($query->result() as $row) {
            $cabang[] = array($row->Cabang, floatval($row->JML));
        }

        return json_encode($cabang);
    }

    function highchart_get_name_branch() {
        $cabang = array();
        $query = $this->db->query("SELECT branch_name
                                    FROM branches ORDER BY branch_name ASC");
        foreach ($query->result() as $row) {
            $cabang[] = $row->branch_name;
        }

        return json_encode($cabang);
    }

    function highchart_get_name_dept() {
        $cabang = array();
        $query = $this->db->query("SELECT staff_cabang AS Cabang,
                                    COUNT(staff_id) AS JML
                                    FROM staffs
                                    GROUP BY Cabang");
        foreach ($query->result() as $row) {
            $cabang[] = array('name' => $row->Cabang, 'data' => array(floatval($row->JML)));
        }

        return json_encode($cabang);
    }

}

//SELECT d.dept_id, d.dept_name, e_cnt.how_many num_employees
//     FROM departments d INNER JOIN
//     (SELECT staff_departement, COUNT(*) how_many
//       FROM staffs
//       GROUP BY staff_departement) e_cnt
//       ON d.dept_name = e_cnt.staff_departement;
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
