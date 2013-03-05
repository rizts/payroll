<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Departments extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Department');
//        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $dept_list = new Department();
        $total_rows = $dept_list->count();

        $data['title'] = "Departments";
        $data['btn_add'] = anchor('departments/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $dept_list->order_by('dept_id', 'DESC');
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
        $data['title'] = 'Add New Departement';
        $data['form_action'] = site_url('departments/save');
        $data['link_back'] = anchor('departments/', 'Back');

        $data['id'] = '';
        $data['dept_name'] = array('name' => 'dept_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('departments/frm_dept', $data);
    }

    function edit($id) {
        $dept = new Department();

        $rs = $dept->where('dept_id', $id)->get();
        $data['id'] = $rs->dept_id;
        $data['dept_name'] = array('name' => 'dept_name', 'value' => $rs->dept_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Departement');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('departments/update');
        $data['link_back'] = anchor('departments/', 'Back');

        $this->load->view('departments/frm_dept', $data);
    }

    function save() {
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
        $dept = new Department();
        $dept->where('dept_id', $this->input->post('id'))
                ->update('dept_name', $this->input->post('dept_name'));

        $this->session->set_flashdata('message', 'Department Update successfuly.');
        redirect('departments/');
    }

    function delete($id) {
        $dept = new Department();
        $dept->_delete($id);

        $this->session->set_flashdata('message', 'Department successfully deleted!');
        redirect('departments/');
    }

}