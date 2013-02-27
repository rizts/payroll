<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Departements extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mdepartement', 'dept_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Departements";
        $data['btn_add'] = anchor('departements/add', 'Add Departement');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['departements'] = $this->dept_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('departements/index/');
        $config['total_rows'] = $this->dept_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('departements/index', $data);
    }

    function add() {
        $data['title'] = 'Add new Departement';
        $data['form_action'] = site_url('departements/save');
        $data['link_back'] = anchor('departements/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['dept_name'] = array('name' => 'dept_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Departement');

        $this->load->view('departements/frm_dept', $data);
    }

    function edit($id) {
        $dept = $this->dept_model->find($id)->row();
        $data['id'] = $dept->dept_id;
        $data['dept_name'] = array('name' => 'dept_name', 'value' => $dept->dept_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Departement');

        $data['title'] = 'Update Departement';
        $data['message'] = '';
        $data['form_action'] = site_url('departements/update');
        $data['link_back'] = anchor('departements/', 'Back');

        $this->load->view('departements/frm_dept', $data);
    }

    function save() {
        $this->form_validation->set_rules('dept_name', 'dept_name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $dept = array('dept_name' => $this->input->post('dept_name'));
            $this->dept_model->save($dept);

            // set user message
            $data['message'] = '<div class="success">add new departement success</div>';
            redirect('departements/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('departements/');
        } else {
            $dept = array('dept_name' => $this->input->post('dept_name'));
            $this->dept_model->update($id, $dept);
            redirect('departements/');
        }
    }

    function delete($id) {
        $this->dept_model->delete($id);
        redirect('departements/', 'refresh');
    }

}