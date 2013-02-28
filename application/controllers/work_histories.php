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
        $data['staff_id'] = $this->uri->segment(2);
        $data['btn_add'] = anchor('staff/' . $data['staff_id'] . '/work_histories/add', 'Add New Work');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['work_histories'] = $this->wh_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('staff/' . $data['staff_id'] . '/work_histories/index/');
        $config['total_rows'] = $this->wh_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_work_history/index', $data);
    }

    function add() {
        $data['title'] = 'Add new work history';
        $staff_id = $this->uri->segment(2);
        $data['form_action'] = site_url('staff/' . $staff_id . '/work_histories/save');
        $data['link_back'] = anchor('staff/' . $staff_id . '/work_histories/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['history_date'] = array('name' => 'history_date');
        $data['history_description'] = array('name' => 'history_description');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Work');

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function edit() {
        $work_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);
        $wh = $this->wh_model->find($work_id)->row();
        $data['id'] = $wh->history_id;
        $data['history_date'] = array('name' => 'history_date', 'value' => $wh->history_date);
        $data['history_description'] = array('name' => 'history_description', 'value' => $wh->history_description);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Work');

        $data['title'] = 'Update Work History';
        $data['message'] = '';
        $data['form_action'] = site_url('staff/' . $staff_id . '/work_histories/update');
        $data['link_back'] = anchor('staff/' . $staff_id . '/work_histories/index', 'Back');

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function save() {
        $staff_id = $this->uri->segment(2);
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
            redirect('staff/' . $staff_id . '/work_histories/index');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $staff_id = $this->uri->segment(2);

        $wh = array(
            'history_date' => $this->input->post('history_date'),
            'history_description' => $this->input->post('history_description')
        );

        $this->wh_model->update($id, $wh);
        redirect('staff/' . $staff_id . '/work_histories/index');
    }

    function delete() {
        $work_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);

        $this->wh_model->delete($work_id);
        redirect('staff/' . $staff_id . '/work_histories/index');
    }

}