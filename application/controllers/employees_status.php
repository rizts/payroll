<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employees_Status extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_Status');
        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $es_list = new Employee_Status();

        $total_rows = $es_list->count();
        $data['title'] = "Employees Status";
        $data['btn_add'] = anchor('employees_status/add', 'Add New Employee Status');
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $es_list->order_by('sk_name', 'ASC');
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
        $data['title'] = 'Add New Employee Status';
        $data['form_action'] = site_url('employees_status/save');
        $data['link_back'] = anchor('employees_status/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['sk_name'] = array('name' => 'sk_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Employee Status');

        $this->load->view('employees_status/frm_employees_status', $data);
    }

    function edit($id) {
        $es = new Employee_Status();

        $rs = $es->where('sk_id', $id)->get();
        $data['id'] = $rs->sk_id;
        $data['sk_name'] = array('name' => 'sk_name', 'value' => $rs->sk_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Status Karyawan');

        $data['title'] = 'Update Employee Status';
        $data['message'] = '';
        $data['form_action'] = site_url('employees_status/update');
        $data['link_back'] = anchor('employees_status/', 'Back');

        $this->load->view('employees_status/frm_employees_status', $data);
    }

    function save() {
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
        $es = new Employee_Status();
        $es->where('sk_id', $this->input->post('id'))
                ->update('sk_name', $this->input->post('sk_name'));

        $this->session->set_flashdata('message', 'Employee Status Update successfuly.');
        redirect('employees_status/');
    }

    function delete($id) {
        $es = new Employee_Status();
        $es->_delete($id);
        $this->session->set_flashdata('message', 'Employee Status successfully deleted!');
        redirect('employees_status/');
    }

}