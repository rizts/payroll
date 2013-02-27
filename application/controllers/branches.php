<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Branches extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mbranch', 'branch_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Branch";
        $data['btn_add'] = anchor('branches/add', 'Add new branch');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['branchs'] = $this->branch_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('branches/index/');
        $config['total_rows'] = $this->branch_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('branches/index', $data);
    }

    function add() {
        $data['title'] = 'Add new branch';
        $data['form_action'] = site_url('branches/save');
        $data['link_back'] = anchor('branches/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['branch_name'] = array('name' => 'branch_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Branch');

        $this->load->view('branches/frm_branch', $data);
    }

    function edit($id) {
        $branch = $this->branch_model->find($id)->row();
        $data['id'] = $branch->branch_id;
        $data['branch_name'] = array('name' => 'branch_name', 'value' => $branch->branch_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Branch');

        $data['title'] = 'Update branch';
        $data['message'] = '';
        $data['form_action'] = site_url('branches/update');
        $data['link_back'] = anchor('branches/', 'Back');

        $this->load->view('branches/frm_branch', $data);
    }

    function save() {
        $this->form_validation->set_rules('branch_name', 'branch_name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $branch = array('branch_name' => $this->input->post('branch_name'));
            $this->branch_model->save($branch);

            // set user message
            $data['message'] = '<div class="success">add new branch success</div>';
            redirect('branches/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('branches/');
        } else {
            $branch = array('branch_name' => $this->input->post('branch_name'));
            $this->branch_model->update($id, $branch);
            redirect('branches/');
        }
    }

    function delete($id) {
        $this->branch_model->delete($id);
        redirect('branches/', 'refresh');
    }

}