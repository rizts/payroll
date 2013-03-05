<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_Salaries extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Sub_Salary');
        $this->load->model('Component');
//        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $salary = new Salary();
        $total_rows = $salary->count();
        $data['title'] = "Salary";
        $data['btn_add'] = anchor('salaries/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $salary->order_by('salary_periode', 'ASC');
        $data['salaries'] = $salary->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("salaries/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('sub_salaries/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Salary';
        $data['form_action'] = site_url('salaries/save');
        $data['link_back'] = anchor('salaries/', 'Back');

        $data['id'] = '';
        // Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = '';
        $data['salary_component_id'] = form_dropdown('salary_component_id', $components, $comp_selected);

        $data['salary_period'] = array('name' => 'salary_period');
        $data['salary_daily_value'] = array('name' => 'salary_daily_value');
        $data['salary_amount_value'] = array('name' => 'salary_amount_value');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('sub_salaries/frm_sub_salaries', $data);
    }

    function edit($id) {
        $salary = new Salary();

        $rs = $salary->where('salary_id', $id)->get();
        $data['id'] = $rs->salary_id;
        // Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = $rs->salary_component_id;
        $data['salary_component_id'] = form_dropdown('salary_component_id', $components, $comp_selected);
        $data['salary_period'] = array('name' => 'salary_period', 'value'=> $rs->salary_period);
        $data['salary_daily_value'] = array('name' => 'salary_daily_value', 'value'=> $rs->salary_daily_value);
        $data['salary_amount_value'] = array('name' => 'salary_amount_value', 'value'=> $rs->salary_amount_value);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('salaries/update');
        $data['link_back'] = anchor('salaries/', 'Back');

        $this->load->view('sub_salaries/frm_sub_salaries', $data);
    }

    function save() {
        $sub_salary = new Sub_Salary();
        $sub_salary->salary_component_id = $this->input->post('salary_component_id');
        $sub_salary->salary_period = $this->input->post('salary_period');
        $sub_salary->salary_daily_value = $this->input->post('salary_daily_value');
        $sub_salary->salary_amount_value = $this->input->post('salary_amount_value');
        if ($sub_salary->save()) {
            $this->session->set_flashdata('message', 'Sub Salary successfully created!');
            redirect('salaries/');
        } else {
            // Failed
            $sub_salary->error_message('custom', 'Field required');
            $msg = $sub_salary->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('salaries/add');
        }
    }

    function update() {
        $salary = new Salary();
        $salary->where('salary_id', $this->input->post('id'))
                ->update(array(
                    'salary_periode' => $this->input->post('salary_periode'),
                    'salary_staffid' => $this->input->post('salary_staffid')
                ));

        $this->session->set_flashdata('message', 'salary Update successfuly.');
        redirect('salaries/');
    }

    function delete($id) {
        $salary = new Salary();
        $salary->_delete($id);

        $this->session->set_flashdata('message', 'Salary successfully deleted!');
        redirect('salaries/');
    }

}