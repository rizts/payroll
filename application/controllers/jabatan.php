<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mjabatan', 'jbt_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Jabatan";
        $data['btn_add'] = anchor('jabatan/add', 'Add new jabatan');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['jabatan'] = $this->jbt_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('jabatan/index/');
        $config['total_rows'] = $this->jbt_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('jabatan/index', $data);
    }

    function add() {
        $data['title'] = 'Add new jabatan';
        $data['form_action'] = site_url('jabatan/save');
        $data['link_back'] = anchor('jabatan/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['title_name'] = array('name' => 'title_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Jabatan');

        $this->load->view('jabatan/frm_jabatan', $data);
    }

    function edit($id) {
        $jbt = $this->jbt_model->find($id)->row();
        $data['id'] = $jbt->title_id;
        $data['title_name'] = array('name' => 'title_name', 'value' => $jbt->title_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Jabatan');

        $data['title'] = 'Update Jabatan';
        $data['message'] = '';
        $data['form_action'] = site_url('jabatan/update');
        $data['link_back'] = anchor('jabatan/', 'Back');

        $this->load->view('jabatan/frm_jabatan', $data);
    }

    function save() {
        $this->form_validation->set_rules('title_name', 'title_name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $jbt = array('title_name' => $this->input->post('title_name'));
            $this->jbt_model->save($jbt);

            // set user message
            $data['message'] = '<div class="success">add new jabatan success</div>';
            redirect('jabatan/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('jabatan/');
        } else {
            $jbt = array('title_name' => $this->input->post('title_name'));
            $this->jbt_model->update($id, $jbt);
            redirect('jabatan/');
        }
    }

    function delete($id) {
        $this->jbt_model->delete($id);
        redirect('jabatan/', 'refresh');
    }

}