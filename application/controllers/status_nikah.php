<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status_Nikah extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mstatus_nikah', 'sn_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Status Nikah";
        $data['btn_add'] = anchor('status_nikah/add', 'Add new Status Nikah');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['status_nikah'] = $this->sn_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('status_nikah/index/');
        $config['total_rows'] = $this->sn_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('status_nikah/index', $data);
    }

    function add() {
        $data['title'] = 'Add new status nikah';
        $data['form_action'] = site_url('status_nikah/save');
        $data['link_back'] = anchor('status_nikah/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['sn_name'] = array('name' => 'sn_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Status Nikah');

        $this->load->view('status_nikah/frm_status_nikah', $data);
    }

    function edit($id) {
        $sn = $this->sn_model->find($id)->row();
        $data['id'] = $sn->sn_id;
        $data['sn_name'] = array('name' => 'sn_name', 'value' => $sn->sn_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Status Nikah');

        $data['title'] = 'Update Status Nikah';
        $data['message'] = '';
        $data['form_action'] = site_url('status_nikah/update');
        $data['link_back'] = anchor('status_nikah/', 'Back');

        $this->load->view('status_nikah/frm_status_nikah', $data);
    }

    function save() {
        $this->form_validation->set_rules('sn_name', 'sn_name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $sn = array('sn_name' => $this->input->post('sn_name'));
            $this->sn_model->save($sn);

            // set user message
            $data['message'] = '<div class="success">add new status nikah success</div>';
            redirect('status_nikah/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('status_nikah/');
        } else {
            $sn = array('sn_name' => $this->input->post('sn_name'));
            $this->sn_model->update($id, $sn);
            redirect('status_nikah/');
        }
    }

    function delete($id) {
        $this->sn_model->delete($id);
        redirect('status_nikah/', 'refresh');
    }

}