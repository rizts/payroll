<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Work_Histories extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Work');
    }

    public function index($offset = 0) {
        $work = new Work();
        $data['staff_id'] = $this->uri->segment(2);
        $work->where('staff_id', $data['staff_id'])->order_by('history_date', 'ASC');

        $total_rows = $work->count();
        $data['title'] = "Work Histories";
        $data['btn_add'] = anchor('staffs/' . $data['staff_id'] . '/work_histories/add', 'Add New');
        $data['btn_home'] = anchor('staffs', 'Home');

        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);


        $data['work_histories'] = $work
                        ->where('staff_id', $data['staff_id'])
                        ->get($this->limit, $offset)->all;
        $config['base_url'] = site_url('staffs/' . $data['staff_id'] . '/work_histories/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_work_history/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Work';
        $staff_id = $this->uri->segment(2);
        $data['form_action'] = site_url('staffs/' . $staff_id . '/work_histories/save');
        $data['link_back'] = anchor('staffs/' . $staff_id . '/work_histories/index', 'Back');

        $data['id'] = '';
        $data['history_date'] = array('name' => 'history_date', 'id' => 'history_date');
        $data['history_description'] = array('name' => 'history_description');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function edit() {
        $work = new Work();
        $work_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);
        $rs = $work->where('history_id', $work_id)->get();
        $data['id'] = $rs->history_id;
        $data['history_date'] = array('name' => 'history_date', 'id' => 'history_date', 'value' => $rs->history_date);
        $data['history_description'] = array('name' => 'history_description', 'value' => $rs->history_description);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update Work History';
        $data['message'] = '';
        $data['form_action'] = site_url('staffs/' . $staff_id . '/work_histories/update');
        $data['link_back'] = anchor('staffs/' . $staff_id . '/work_histories/index', 'Back');

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function save() {
        $work = new Work();
        $staff_id = $this->uri->segment(2);

        $work->staff_id = $staff_id;
        $work->history_date = $this->input->post('history_date');
        $work->history_description = $this->input->post('history_description');

        if ($work->save()) {
            $this->session->set_flashdata('message', 'Work successfully created!');
            redirect('staffs/' . $staff_id . '/work_histories/index');
        } else {
            // Failed
            $work->error_message('custom', 'Field required');
            $msg = $work->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staffs/' . $staff_id . '/work_histories/add');
        }
    }

    function update() {
        $work = new Work();
        $id = $this->input->post('id');
        $staff_id = $this->uri->segment(2);
        $work->where('history_id', $id)->update(array(
            'history_date' => $this->input->post('history_date'),
            'history_description' => $this->input->post('history_description')
        ));
        $this->session->set_flashdata('message', 'Work Update successfuly.');
        redirect('staffs/' . $staff_id . '/work_histories/index');
    }

    function delete() {
        $work = new Work();
        $work_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);

        $work->_delete($work_id);
        redirect('staffs/' . $staff_id . '/work_histories/index');
    }

}