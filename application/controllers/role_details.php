<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_Details extends CI_Controller {

    private $limit = 10;
    var $role_id;
    var $uri_segment;
    var $roled_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Role_Detail');
        $this->role_id = $this->uri->segment(3);
        $this->uri_segment = $this->uri->segment(6);
        $this->roled_id = $this->uri->segment(6);
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $role_detail = new Role_Detail();
        $total_rows = $role_detail->count();

        $data['title'] = "Role Details";
        $data['role_id'] = $this->role_id;
        $data['btn_add'] = anchor('users/roles/' . $this->role_id . '/role_details/add', 'Add New', "class='btn btn-primary'");
        $data['btn_home'] = anchor(base_url(), 'Home', "class='btn btn-home'");

        $offset = $this->uri->segment($this->uri_segment);

        $role_detail->order_by('roled_id', 'DESC');

        $data['roled_list'] = $role_detail->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("users/roles/' . $this->role_id . '/role_details/add");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('role_details/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Role';
        $data['form_action'] = site_url('branches/save');
        $data['link_back'] = anchor('branches/', 'Back', array('class' => 'btn'));

        $data['id'] = '';
        $data['roled_module'] = array('name' => 'roled_module');
        $data['roled_add'] = array('name' => 'roled_add');
        $data['roled_edit'] = array('name' => 'roled_edit');
        $data['roled_delete'] = array('name' => 'roled_delete');
        $data['roled_approval'] = array('name' => 'roled_approval');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('role_details/frm_role_detail', $data);
    }

    function edit($id) {
        $branch = new Branch();

        $rs = $branch->where('branch_id', $id)->get();
        $data['id'] = $rs->branch_id;
        $data['branch_name'] = array('name' => 'branch_name', 'value' => $rs->branch_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', "class" => "btn btn-primary");

        $data['title'] = 'Update Branch';
        $data['form_action'] = site_url('branches/update');
        $data['link_back'] = anchor('branches/', 'Back', array("class" => "btn"));

        $this->load->view('branches/frm_branch', $data);
    }

    function save() {
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
        $branch = new Branch();
        $branch->where('branch_id', $this->input->post('id'))
                ->update('branch_name', $this->input->post('branch_name'));

        $this->session->set_flashdata('message', 'Branch Update successfuly.');
        redirect('branches/');
    }

    function delete($id) {
        $branch = new Branch();
        $branch->_delete($id);

        $this->session->set_flashdata('message', 'Branch successfully deleted!');
        redirect('branches/');
    }

}
