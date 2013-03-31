<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employees_Status extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_Status');
        $this->sess_username = $this->session->userdata('username');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->sess_staff_id = $this->session->userdata('sess_staff_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $es_list = new Employee_Status();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "sk_name";
                break;
            case "2":
                $data['col'] = "sk_id";
                break;
            default:
                $data['col'] = "sk_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }


        $data['title'] = "Employees Status";
        $data['btn_add'] = anchor('employees_status/add', 'Add New', array("class" => "btn btn-primary"));
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        if ($this->input->get('search_by')) {
            $total_rows = $es_list->like($_GET['search_by'], $_GET['q'])->count();
            $es_list->like($_GET['search_by'], $_GET['q'])->order_by($data['col'], $data['dir']);
        } else {
            $total_rows = $es_list->count();
            $es_list->order_by($data['col'], $data['dir']);
        }

        $data['es_list'] = $es_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("employees_status/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('employees_status/index', $data);
    }

    function add() {
        $this->filter_access('Employee_Status', 'roled_add', 'employees_status/index');

        $data['title'] = 'Add New Employee Status';
        $data['form_action'] = site_url('employees_status/save');
        $data['link_back'] = anchor('employees_status/', 'Back', array("class" => "btn btn-danger"));

        $data['id'] = '';
        $data['sk_name'] = array('name' => 'sk_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');

        $this->load->view('employees_status/frm_employees_status', $data);
    }

    function edit($id) {
        $this->filter_access('Employee_Status', 'roled_edit', 'employees_status/index');

        $es = new Employee_Status();
        $rs = $es->where('sk_id', $id)->get();
        $data['id'] = $rs->sk_id;
        $data['sk_name'] = array('name' => 'sk_name', 'value' => $rs->sk_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', 'class' => 'btn btn-primary');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('employees_status/update');
        $data['link_back'] = anchor('employees_status/', 'Back', array("class" => "btn btn-danger"));

        $this->load->view('employees_status/frm_employees_status', $data);
    }

    function save() {
        $this->filter_access('Employee_Status', 'roled_add', 'employees_status/index');

        $es = new Employee_Status();
        $es->sk_name = $this->input->post('sk_name');
        if ($es->save()) {
            $this->session->set_flashdata('message', 'Employee Status successfully created!');
            redirect('employees_status/');
        } else {
            // Failed
            $es->error_message('custom', 'Employes Status Name Required!');
            $msg = $es->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('employees_status/add');
        }
    }

    function update() {
        $this->filter_access('Employee_Status', 'roled_edit', 'employees_status/index');

        $es = new Employee_Status();
        $es->where('sk_id', $this->input->post('id'))
                ->update('sk_name', $this->input->post('sk_name'));

        $this->session->set_flashdata('message', 'Employee Status Update successfuly.');
        redirect('employees_status/');
    }

    function delete($id) {
        $this->filter_access('Employee_Status', 'roled_delete', 'employees_status/index');

        $es = new Employee_Status();
        $es->_delete($id);
        $this->session->set_flashdata('message', 'Employee Status successfully deleted!');
        redirect('employees_status/');
    }

    function to_excel() {
        $this->load->view('employees_status/to_excel');
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
