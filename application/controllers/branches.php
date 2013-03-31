<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Branches extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->helper('bulan');
        $this->load->model('Branch');
        $this->sess_username = $this->session->userdata('username');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->sess_staff_id = $this->session->userdata('sess_staff_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $this->filter_access('Branch', 'roled_select', base_url());

        $branch_list = new Branch();

        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "branch_name";
                break;
            case "2":
                $data['col'] = "branch_id";
                break;
            default:
                $data['col'] = "branch_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }

        $data['title'] = "Branch";
        $data['btn_add'] = anchor('branches/add', 'Add New', "class='btn btn-primary'");
        $data['btn_home'] = anchor(base_url(), 'Home', "class='btn btn-home'");

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        if ($this->input->get('search_by')) {
            $total_rows = $branch_list->like($_GET['search_by'], $_GET['q'])->count();
            $branch_list->like($_GET['search_by'], $_GET['q'])->order_by($data['col'], $data['dir']);
        } else {
            $total_rows = $branch_list->count();
            $branch_list->order_by($data['col'], $data['dir']);
        }

        $data['branch_list'] = $branch_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("branches/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('branches/index', $data);
    }

    function add() {
        $this->filter_access('Branch', 'roled_add', 'branches/index');

        $data['title'] = 'Add New Branch';
        $data['form_action'] = site_url('branches/save');
        $data['link_back'] = anchor('branches/', 'Back', array('class' => 'btn btn-danger'));

        $data['id'] = '';
        $data['branch_name'] = array('name' => 'branch_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('branches/frm_branch', $data);
    }

    function edit($id) {
        $this->filter_access('Branch', 'roled_edit', 'branches/index');

        $branch = new Branch();
        $rs = $branch->where('branch_id', $id)->get();
        $data['id'] = $rs->branch_id;
        $data['branch_name'] = array('name' => 'branch_name', 'value' => $rs->branch_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', "class" => "btn btn-primary");

        $data['title'] = 'Update Branch';
        $data['form_action'] = site_url('branches/update');
        $data['link_back'] = anchor('branches/', 'Back', array("class" => "btn btn-danger"));

        $this->load->view('branches/frm_branch', $data);
    }

    function save() {
        $this->filter_access('Branch', 'roled_add', 'branches/index');

        $branch = new Branch();
        $branch->branch_name = $this->input->post('branch_name');
        if ($branch->save()) {
            $this->session->set_flashdata('message', 'Branch successfully created!');
            redirect('branches/');
        } else {
            // Failed
            $branch->error_message('custom', 'Branch Name required');
            $msg = $branch->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('branches/add');
        }
    }

    function update() {
        $this->filter_access('Branch', 'roled_edit', 'branches/index');

        $branch = new Branch();
        $branch->where('branch_id', $this->input->post('id'))
                ->update('branch_name', $this->input->post('branch_name'));

        $this->session->set_flashdata('message', 'Branch Update successfuly.');
        redirect('branches/');
    }

    function delete($id) {
        $this->filter_access('Branch', 'roled_delete', 'branches/index');

        $branch = new Branch();
        $branch->_delete($id);

        $this->session->set_flashdata('message', 'Branch successfully deleted!');
        redirect('branches/');
    }

    function get_employee_per_branch() {
        sleep(1);
        $arr = array();
        $bln = array();
        $query = $this->db->query("SELECT DISTINCT DATE_FORMAT(created_at, '%Y-%m') 
            AS Month, COUNT(staff_id)
            AS iCount FROM staffs GROUP BY Month ORDER BY Month ASC");
        foreach ($query->result() as $row) {
            $arr[] = $row->iCount;
            $bln[] = bulan($row->Month);
        }
        $b = json_encode($bln);
        $x = json_encode($arr);
        $y = str_replace('"', '', $x);
        $result = array($y, $b);
        echo json_encode($bln);
    }

    function to_excel() {
        $this->load->view('branches/to_excel');
    }

    function filter_access($module, $field, $page) {
        $user = new User();
        $status_access = $user->get_access($this->sess_role_id, $module, $field);

        if ($status_access == false) {
            $msg = '<div class="alert alert-error">You do not have access to this page, please contact administrator</div>';
            $this->session->set_flashdata('message', $msg);
            redirect($page);
        }
    }

}

