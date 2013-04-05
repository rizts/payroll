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
        $query = $this->db->query("SELECT DISTINCT staff_cabang
                                    FROM staffs ORDER BY staff_cabang ASC");
        foreach ($query->result() as $row) {
            $cabang[] = $row->staff_cabang;
        }

        return json_encode($cabang);
    }

    function highchart_get_name_dept() {
        $staff = new Staff();

        $cabang = array();
        $query = $this->db->query("SELECT COUNT( staffs.staff_departement ) AS JML, staffs.staff_cabang AS Cabang, staffs.staff_departement AS Dept
                            FROM staffs
                            INNER JOIN branches ON branches.branch_name = staffs.staff_cabang
                            GROUP BY Cabang, Dept");
        foreach ($query->result() as $row) {
            $rs = $staff->where('staff_cabang', $row->Cabang)
                            ->where('staff_departement', $row->Dept)->count();

            $cabang[] = array(
                'name' => $row->Dept,
                'data' => array($rs)
            );
        }

        return json_encode($cabang);
    }

    function get_count_dep($cb, $dept) {
        $staff = new Staff();
        $query = $staff->where('staff_cabang', 'Bandung')
                        ->where('staff_departement', 'Accounting')->count();

        return $query;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
