<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gaji extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mgaji', 'gaji_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Gaji";
        $data['btn_add'] = anchor('gaji/add', 'Add new gaji');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['gaji'] = $this->gaji_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('gaji/index/');
        $config['total_rows'] = $this->gaji_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('gaji/index', $data);
    }

    function add() {
        $data['title'] = 'Add new Gaji';
        $data['form_action'] = site_url('gaji/save');
        $data['link_back'] = anchor('gaji/', 'Back', array('class' => 'back'));

        $options = array(
            'Daily' => 'Daily',
            'Monthly' => 'Monthly',
            'Yearly' => 'Yearly',
        );
        $data['id'] = '';
        $selected = 'Monthly';
        $data['comp_name'] = array('name' => 'comp_name');
        $data['comp_type'] = form_dropdown('comp_type', $options, $selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Gaji');

        $this->load->view('gaji/frm_gaji', $data);
    }

    function edit($id) {
        $gaji = $this->gaji_model->find($id)->row();
        $options = array(
            'Daily' => 'Daily',
            'Monthly' => 'Monthly',
            'Yearly' => 'Yearly',
        );
        $selected = $gaji->comp_type;
        $data['id'] = $gaji->comp_id;
        $data['comp_type'] = form_dropdown('comp_type', $options, $selected);
        $data['comp_name'] = array('name' => 'comp_name', 'value' => $gaji->comp_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Gaji');

        $data['title'] = 'Update Gaji';
        $data['message'] = '';
        $data['form_action'] = site_url('gaji/update');
        $data['link_back'] = anchor('gaji/', 'Back');

        $this->load->view('gaji/frm_gaji', $data);
    }

    function save() {
        $this->form_validation->set_rules('comp_name', 'comp_name', 'required');
        $this->form_validation->set_rules('comp_type', 'comp_type', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $gaji = array(
                'comp_name' => $this->input->post('comp_name'),
                'comp_type' => $this->input->post('comp_type')
            );
            $this->gaji_model->save($gaji);

            // set user message
            $data['message'] = '<div class="success">add new gaji success</div>';
            redirect('gaji/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('gaji/');
        } else {
            $gaji = array(
                'comp_name' => $this->input->post('comp_name'),
                'comp_type' => $this->input->post('comp_type')
            );

            $this->gaji_model->update($id, $gaji);
            redirect('gaji/');
        }
    }

    function delete($id) {
        $this->gaji_model->delete($id);
        redirect('gaji/', 'refresh');
    }

}