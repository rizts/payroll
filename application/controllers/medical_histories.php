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
        $data['staff_id'] = $this->uri->segment(2);
        $data['btn_add'] = anchor('staff/' . $data['staff_id'] . '/medical_histories/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['medical_histories'] = $this->mh_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('staff/' . $data['staff_id'] . '/medical_histories/index/');
        $config['total_rows'] = $this->mh_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_medical_history/index', $data);
    }

    function add() {
        $staff_id = $this->uri->segment(2);
        $data['title'] = 'Add new Medical History';
        $data['form_action'] = site_url('staff/' . $staff_id . '/medical_histories/save');
        $data['link_back'] = anchor('staff/' . $staff_id . '/medical_histories/index', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['medic_date'] = array('name' => 'medic_date');
        $data['medic_description'] = array('name' => 'medic_description');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('staff_medical_history/frm_medical', $data);
    }

    function edit() {
        $medic_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);
        $mh = $this->mh_model->find($medic_id)->row();
        $data['id'] = $mh->medic_id;
        $data['medic_date'] = array('name' => 'medic_date', 'value' => $mh->medic_date);
        $data['medic_description'] = array('name' => 'medic_description', 'value' => $mh->medic_description);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Medical');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('staff/' . $staff_id . '/medical_histories/update');
        $data['link_back'] = anchor('staff/' . $staff_id . '/medical_histories/index', 'Back');

        $this->load->view('staff_medical_history/frm_medical', $data);
    }

    function save() {
        $staff_id = $this->uri->segment(2);
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
            redirect('staff/' . $staff_id . '/medical_histories/index');
        }
    }

    function update() {
        $staff_id = $this->uri->segment(2);
        $id = $this->input->post('id');

        $mh = array(
            'medic_date' => $this->input->post('medic_date'),
            'medic_description' => $this->input->post('medic_description')
        );

        $this->mh_model->update($id, $mh);
        redirect('staff/'.$staff_id.'/medical_histories/index');
    }

    function delete() {
        $medic_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);
        $this->mh_model->delete($medic_id);
        redirect('staff/'.$staff_id.'/medical_histories/index', 'refresh');
    }

}