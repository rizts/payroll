<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salary_Components extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('msalary_component', 'sc_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Salary Component";
        $data['btn_add'] = anchor('salary_components/add', 'Add new Salary Comp');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['salary_components'] = $this->sc_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('salary_components/index/');
        $config['total_rows'] = $this->sc_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_salary_components/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Salary Component';
        $data['form_action'] = site_url('salary_components/save');
        $data['link_back'] = anchor('salary_components/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['gaji_component_id'] = array('name' => 'gaji_component_id');
        $data['gaji_daily_value'] = array('name' => 'gaji_daily_value');
        $data['gaji_amount_value'] = array('name' => 'gaji_amount_value');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Salary');

        $this->load->view('staff_salary_components/frm_salary_component', $data);
    }

    function edit($id) {
        $field = $this->sc_model->find($id)->row();
        $data['id'] = $field->gaji_id;
        $data['gaji_component_id'] = array('name' => 'gaji_component_id', 'value' => $field->gaji_component_id);
        $data['gaji_daily_value'] = array('name' => 'gaji_daily_value', 'value' => $field->gaji_daily_value);
        $data['gaji_amount_value'] = array('name' => 'gaji_amount_value', 'value' => $field->gaji_amount_value);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Salary');

        $data['title'] = 'Update Salary Component';
        $data['message'] = '';
        $data['form_action'] = site_url('salary_components/update');
        $data['link_back'] = anchor('salary_components/', 'Back');

        $this->load->view('staff_salary_components/frm_salary_component', $data);
    }

    function save() {
        $this->form_validation->set_rules('gaji_daily_value', 'Gaji Value', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $field = array(
                'gaji_component_id' => $this->input->post('gaji_component_id'),
                'gaji_daily_value' => $this->input->post('gaji_daily_value'),
                'gaji_amount_value' => $this->input->post('gaji_amount_value')
            );
            $this->sc_model->save($field);

            // set user message
            $data['message'] = '<div class="success">add new salary success</div>';
            redirect('salary_components/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('salary_components/');
        } else {
            $field = array(
                'gaji_component_id' => $this->input->post('gaji_component_id'),
                'gaji_daily_value' => $this->input->post('gaji_daily_value'),
                'gaji_amount_value' => $this->input->post('gaji_amount_value')
            );

            $this->sc_model->update($id, $field);
            redirect('salary_components/');
        }
    }

    function delete($id) {
        $this->sc_model->delete($id);
        redirect('salary_components/', 'refresh');
    }

}