<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medical_Histories extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mmedical_history', 'mh_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Medical History";
        $data['btn_add'] = anchor('medical_histories/add', 'Add new medical');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['medical_histories'] = $this->mh_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('medical_histories/index/');
        $config['total_rows'] = $this->mh_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_medical_history/index', $data);
    }

    function add() {
        $data['title'] = 'Add new Medical History';
        $data['form_action'] = site_url('medical_histories/save');
        $data['link_back'] = anchor('medical_histories/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['medic_date'] = array('name' => 'medic_date');
        $data['medic_description'] = array('name' => 'medic_description');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Medical');

        $this->load->view('staff_medical_history/frm_medical', $data);
    }

    function edit($id) {
        $mh = $this->mh_model->find($id)->row();
        $data['id'] = $mh->medic_id;
        $data['medic_date'] = array('name' => 'medic_date', 'value' => $mh->medic_date);
        $data['medic_description'] = array('name' => 'medic_description', 'value' => $mh->medic_description);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Medical');

        $data['title'] = 'Update Medical History';
        $data['message'] = '';
        $data['form_action'] = site_url('medical_histories/update');
        $data['link_back'] = anchor('medical_histories/', 'Back');

        $this->load->view('staff_medical_history/frm_medical', $data);
    }

    function save() {
        $this->form_validation->set_rules('medic_date', 'Date', 'required');
        $this->form_validation->set_rules('medic_description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $mh = array(
                'medic_date' => $this->input->post('medic_date'),
                'medic_description' => $this->input->post('medic_description')
            );
            $this->mh_model->save($mh);

            // set user message
            $data['message'] = '<div class="success">add new medical success</div>';
            redirect('medical_histories/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('medical_histories/');
        } else {
            $mh = array(
                'medic_date' => $this->input->post('medic_date'),
                'medic_description' => $this->input->post('medic_description')
            );

            $this->mh_model->update($id, $mh);
            redirect('medical_histories/');
        }
    }

    function delete($id) {
        $this->mh_model->delete($id);
        redirect('medical_histories/', 'refresh');
    }

}