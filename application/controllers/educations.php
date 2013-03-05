<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Educations extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Education');
    }

    public function index($offset = 0) {
        $education = new Education();
        $data['staff_id'] = $this->uri->segment(2);
        $education->where('staff_id', $data['staff_id'])->order_by('edu_year', 'ASC');

        $total_rows = $education->count();
        $data['title'] = "Family";
        $data['btn_add'] = anchor('staffs/' . $data['staff_id'] . '/educations/add', 'Add New');
        $data['btn_home'] = anchor('staffs', 'Home');

        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);


        $data['educations'] = $education
                        ->where('staff_id', $data['staff_id'])
                        ->get($this->limit, $offset)->all;
        $config['base_url'] = site_url('staffs/' . $data['staff_id'] . '/educations/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_education/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Education';
        $staff_id = $this->uri->segment(2);
        $data['form_action'] = site_url('staffs/' . $staff_id . '/educations/save');
        $data['link_back'] = anchor('staffs/' . $staff_id . '/educations/index', 'Back');

        $data['id'] = '';
        $data['edu_year'] = array('name' => 'edu_year');
        $data['edu_gelar'] = array('name' => 'edu_gelar');
        $data['edu_name'] = array('name' => 'edu_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('staff_education/frm_education', $data);
    }

    function edit() {
        $education = new Education();
        $edu_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);
        $rs = $education->where('edu_id', $edu_id)->get();
        $data['id'] = $rs->edu_id;
        $data['edu_year'] = array('name' => 'edu_year', 'value' => $rs->edu_year);
        $data['edu_gelar'] = array('name' => 'edu_gelar', 'value' => $rs->edu_gelar);
        $data['edu_name'] = array('name' => 'edu_name', 'value' => $rs->edu_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Education');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('staffs/' . $staff_id . '/educations/update');
        $data['link_back'] = anchor('staffs/' . $staff_id . '/educations/index', 'Back');

        $this->load->view('staff_education/frm_education', $data);
    }

    function save() {
        $education = new Education();
        $staff_id = $this->uri->segment(2);
        $education->staff_id = $staff_id;
        $education->edu_year = $this->input->post('edu_year');
        $education->edu_gelar = $this->input->post('edu_gelar');
        $education->edu_name = $this->input->post('edu_name');

        if ($education->save()) {
            $this->session->set_flashdata('message', 'Education successfully created!');
            redirect('staffs/' . $staff_id . '/educations/index');
        } else {
            // Failed
            $education->error_message('custom', 'Field required');
            $msg = $education->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staffs/' . $staff_id . '/educations/add');
        }
    }

    function update() {
        $education = new Education();
        $staff_id = $this->uri->segment(2);
        $id = $this->input->post('id');
        $education->where('edu_id', $id)
                ->update(array(
                    'edu_year' => $this->input->post('edu_year'),
                    'edu_gelar' => $this->input->post('edu_gelar'),
                    'edu_name' => $this->input->post('edu_name')
                ));
        $this->session->set_flashdata('message', 'Education Update successfuly.');
        redirect('staffs/' . $staff_id . '/educations/index');
    }

    function delete() {
        $education = new Education();
        $education->_delete($this->uri->segment(5));
        $this->session->set_flashdata('message', 'Education deleted.');
        redirect('staffs/' . $staff_id . '/educations/index');
    }

}