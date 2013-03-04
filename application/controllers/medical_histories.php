<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medical_Histories extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Medical');
    }

    public function index($offset = 0) {
        $medical = new Medical();
        $data['staff_id'] = $this->uri->segment(2);
        $medical->where('staff_id', $data['staff_id'])->order_by('medic_date', 'ASC');

        $total_rows = $medical->count();
        $data['title'] = "Medical Histories";
        $data['btn_add'] = anchor('staffs/' . $data['staff_id'] . '/medical_histories/add', 'Add New');
        $data['btn_home'] = anchor('staffs', 'Home');

        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);


        $data['medical_histories'] = $medical
                        ->where('staff_id', $data['staff_id'])
                        ->get($this->limit, $offset)->all;
        $config['base_url'] = site_url('staffs/' . $data['staff_id'] . '/medical_histories/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_medical_history/index', $data);
    }

    function add() {
        $staff_id = $this->uri->segment(2);
        $data['title'] = 'Add New Medical History';
        $data['form_action'] = site_url('staffs/' . $staff_id . '/medical_histories/save');
        $data['link_back'] = anchor('staffs/' . $staff_id . '/medical_histories/index', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['medic_date'] = array('name' => 'medic_date');
        $data['medic_description'] = array('name' => 'medic_description');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('staff_medical_history/frm_medical', $data);
    }

    function edit() {
        $medical = new Medical();
        $medic_id = $this->uri->segment(5);
        $rs = $medical->where('medic_id', $medic_id)->get();
        $data['id'] = $rs->medic_id;
        $data['medic_date'] = array('name' => 'medic_date', 'value' => $rs->medic_date);
        $data['medic_description'] = array('name' => 'medic_description', 'value' => $rs->medic_description);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Medical');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('staffs/' . $rs->staff_id . '/medical_histories/update');
        $data['link_back'] = anchor('staffs/' . $rs->staff_id . '/medical_histories/index', 'Back');

        $this->load->view('staff_medical_history/frm_medical', $data);
    }

    function save() {
        $medical = new Medical();
        $staff_id = $this->uri->segment(2);
        $medical->staff_id = $staff_id;
        $medical->medic_date = $this->input->post('medic_date');
        $medical->medic_description = $this->input->post('medic_description');

        if ($medical->save()) {
            $this->session->set_flashdata('message', 'Medical successfully created!');
            redirect('staffs/' . $staff_id . '/medical_histories/index');
        } else {
            // Failed
            $medical->error_message('custom', 'Field required');
            $msg = $medical->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staffs/' . $staff_id . '/medical_histories/add');
        }
    }

    function update() {
        $medical = new Medical();
        $staff_id = $this->uri->segment(2);
        $id = $this->input->post('id');
        $medical->where('medic_id', $id)
                ->update(array(
                    'medic_date' => $this->input->post('medic_date'),
                    'medic_description' => $this->input->post('medic_description')
                ));
        $this->session->set_flashdata('message', 'Medical Update successfuly.');
        redirect('staffs/' . $staff_id . '/medical_histories/index');
    }

    function delete() {
        $medical = new Medical();
        $staff_id = $this->uri->segment(2);
        $medical->_delete($this->uri->segment(5));
        redirect('staffs/' . $staff_id . '/medical_histories/index');
    }

}