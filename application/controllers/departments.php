<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Departments extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Department');
        $this->sess_username = $this->session->userdata('username');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->sess_staff_id = $this->session->userdata('sess_staff_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $this->filter_access('Departement', 'roled_select', base_url());
        $dept_list = new Department();

        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "dept_name";
                break;
            case "2":
                $data['col'] = "dept_id";
                break;
            default:
                $data['col'] = "dept_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }

        $data['title'] = "Departments";
        $data['btn_add'] = anchor('departments/add', 'Add New', array("class" => "btn btn-primary"));
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        if ($this->input->get('search_by')) {
            $total_rows = $dept_list->like($_GET['search_by'], $_GET['q'])->count();
            $dept_list->like($_GET['search_by'], $_GET['q'])->order_by($data['col'], $data['dir']);
        } else {
            $total_rows = $dept_list->count();
            $dept_list->order_by($data['col'], $data['dir']);
        }


        $data['dept_list'] = $dept_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("departments/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('departments/index', $data);
    }

    function add() {
        $this->filter_access('Departement', 'roled_add', 'departments/index');

        $data['title'] = 'Add New Departement';
        $data['form_action'] = site_url('departments/save');
        $data['link_back'] = anchor('departments/', 'Back', array("class" => "btn btn-danger"));

        $data['id'] = '';
        $data['dept_name'] = array('name' => 'dept_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('departments/frm_dept', $data);
    }

    function edit($id) {
        $this->filter_access('Departement', 'roled_edit', 'departments/index');

        $dept = new Department();
        $rs = $dept->where('dept_id', $id)->get();
        $data['id'] = $rs->dept_id;
        $data['dept_name'] = array('name' => 'dept_name', 'value' => $rs->dept_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', "class" => "btn btn-primary");

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('departments/update');
        $data['link_back'] = anchor('departments/', 'Back', array("class" => "btn btn-danger"));

        $this->load->view('departments/frm_dept', $data);
    }

    function save() {
        $this->filter_access('Departement', 'roled_add', 'departments/index');

        $dept = new Department();
        $dept->dept_name = $this->input->post('dept_name');
        if ($dept->save()) {
            $this->session->set_flashdata('message', 'Departments successfully created!');
            redirect('departments/');
        } else {
            // Failed
            $dept->error_message('custom', 'Department Name required');
            $msg = $dept->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('departments/add');
        }
    }

    function update() {
        $this->filter_access('Departement', 'roled_edit', 'departments/index');

        $dept = new Department();
        $dept->where('dept_id', $this->input->post('id'))
                ->update('dept_name', $this->input->post('dept_name'));

        $this->session->set_flashdata('message', 'Department Update successfuly.');
        redirect('departments/');
    }

    function delete($id) {
        $this->filter_access('Departement', 'roled_delete', 'departments/index');

        $dept = new Department();
        $dept->_delete($id);

        $this->session->set_flashdata('message', 'Department successfully deleted!');
        redirect('departments/');
    }

    function to_excel() {
        $this->load->view('departments/to_excel');
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
