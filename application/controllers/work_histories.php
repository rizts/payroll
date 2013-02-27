<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Work_Histories extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mwork_history', 'wh_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Work History";
        $data['btn_add'] = anchor('work_histories/add', 'Add new Work');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['work_histories'] = $this->wh_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('work_histories/index/');
        $config['total_rows'] = $this->wh_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_work_history/index', $data);
    }

    function add() {
        $data['title'] = 'Add new work history';
        $data['form_action'] = site_url('work_histories/save');
        $data['link_back'] = anchor('work_histories/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['history_date'] = array('name' => 'history_date');
        $data['history_description'] = array('name' => 'history_description');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Work');

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function edit($id) {
        $wh = $this->wh_model->find($id)->row();
        $data['id'] = $wh->history_id;
        $data['history_date'] = array('name' => 'history_date', 'value' => $wh->history_date);
        $data['history_description'] = array('name' => 'history_description', 'value' => $wh->history_description);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Work');

        $data['title'] = 'Update Work History';
        $data['message'] = '';
        $data['form_action'] = site_url('work_histories/update');
        $data['link_back'] = anchor('work_histories/', 'Back');

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function save() {
        $this->form_validation->set_rules('history_date', 'Date', 'required');
        $this->form_validation->set_rules('history_description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $wh = array(
                'history_date' => $this->input->post('history_date'),
                'history_description' => $this->input->post('history_description')
            );
            $this->wh_model->save($wh);

            // set user message
            $data['message'] = '<div class="success">add new work success</div>';
            redirect('work_histories/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('work_histories/');
        } else {
            $wh = array(
                'history_date' => $this->input->post('history_date'),
                'history_description' => $this->input->post('history_description')
            );

            $this->wh_model->update($id, $wh);
            redirect('work_histories/');
        }
    }

    function delete($id) {
        $this->wh_model->delete($id);
        redirect('work_histories/', 'refresh');
    }

}