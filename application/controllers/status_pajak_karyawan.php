<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status_Pajak_Karyawan extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mstatus_pajak_karyawan', 'spk_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Status Pajak Karyawan";
        $data['btn_add'] = anchor('status_pajak_karyawan/add', 'Add new Status Pajak');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['status_pajak_karyawan'] = $this->spk_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('status_pajak_karyawan/index/');
        $config['total_rows'] = $this->spk_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('status_pajak_karyawan/index', $data);
    }

    function add() {
        $data['title'] = 'Add new SPK';
        $data['form_action'] = site_url('status_pajak_karyawan/save');
        $data['link_back'] = anchor('status_pajak_karyawan/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['sp_status'] = array('name' => 'sp_status');
        $data['sp_ptkp'] = array('name' => 'sp_ptkp');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Status Pajak');

        $this->load->view('status_pajak_karyawan/frm_spk', $data);
    }

    function edit($id) {
        $spk = $this->spk_model->find($id)->row();
        $data['id'] = $spk->sp_id;
        $data['sp_status'] = array('name' => 'sp_status', 'value' => $spk->sp_status);
        $data['sp_ptkp'] = array('name' => 'sp_ptkp', 'value' => $spk->sp_ptkp);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update SPK');

        $data['title'] = 'Update Status Pajak Karyawan';
        $data['message'] = '';
        $data['form_action'] = site_url('status_pajak_karyawan/update');
        $data['link_back'] = anchor('status_pajak_karyawan/', 'Back');

        $this->load->view('status_pajak_karyawan/frm_spk', $data);
    }

    function save() {
        $this->form_validation->set_rules('sp_status', 'sp_status', 'required');
        $this->form_validation->set_rules('sp_ptkp', 'sp_ptkp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $spk = array(
                'sp_status' => $this->input->post('sp_status'),
                'sp_ptkp' => $this->input->post('sp_ptkp')
            );
            $this->spk_model->save($spk);

            // set user message
            $data['message'] = '<div class="success">add new SPK success</div>';
            redirect('status_pajak_karyawan/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('status_pajak_karyawan/');
        } else {
            $spk = array(
                'sp_status' => $this->input->post('sp_status'),
                'sp_ptkp' => $this->input->post('sp_ptkp')
            );

            $this->spk_model->update($id, $spk);
            redirect('status_pajak_karyawan/');
        }
    }

    function delete($id) {
        $this->spk_model->delete($id);
        redirect('status_pajak_karyawan/', 'refresh');
    }

}