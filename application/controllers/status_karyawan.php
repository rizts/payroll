<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status_Karyawan extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mstatus_karyawan', 'sk_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Status Karyawan";
        $data['btn_add'] = anchor('status_karyawan/add', 'Add new Status');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['status_karyawan'] = $this->sk_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('status_karyawan/index/');
        $config['total_rows'] = $this->sk_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('status_karyawan/index', $data);
    }

    function add() {
        $data['title'] = 'Add new status karyawan';
        $data['form_action'] = site_url('status_karyawan/save');
        $data['link_back'] = anchor('status_karyawan/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['sk_name'] = array('name' => 'sk_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Status Karyawan');

        $this->load->view('status_karyawan/frm_status_karyawan', $data);
    }

    function edit($id) {
        $branch = $this->sk_model->find($id)->row();
        $data['id'] = $branch->sk_id;
        $data['sk_name'] = array('name' => 'sk_name', 'value' => $branch->sk_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Status Karyawan');

        $data['title'] = 'Update Status Karyawan';
        $data['message'] = '';
        $data['form_action'] = site_url('status_karyawan/update');
        $data['link_back'] = anchor('status_karyawan/', 'Back');

        $this->load->view('status_karyawan/frm_status_karyawan', $data);
    }

    function save() {
        $this->form_validation->set_rules('sk_name', 'sk_name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $sk = array('sk_name' => $this->input->post('sk_name'));
            $this->sk_model->save($sk);

            // set user message
            $data['message'] = '<div class="success">add new SK success</div>';
            redirect('status_karyawan/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('status_karyawan/');
        } else {
            $sk = array('sk_name' => $this->input->post('sk_name'));
            $this->sk_model->update($id, $sk);
            redirect('status_karyawan/');
        }
    }

    function delete($id) {
        $this->sk_model->delete($id);
        redirect('status_karyawan/', 'refresh');
    }

}