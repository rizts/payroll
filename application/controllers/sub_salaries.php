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
        $sub_salary = new Sub_Salary();
        $salary_id = $this->uri->segment(2);
        $sub_salary->where('salary_id', $salary_id)->order_by('sub_id', 'DESC');

        $total_rows = $sub_salary->count();

        $data['title'] = "Sub Salary";
        $data['btn_add'] = anchor('salaries/' . $salary_id . '/sub_salaries/add', 'Add New');
        $data['btn_home'] = anchor('salaries/', 'Back');

        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);

        $data['sub_salaries'] = $sub_salary
                        ->where('salary_id', $salary_id)
                        ->get($this->limit, $offset)->all;

        $config['base_url'] = site_url('salaries/' . $salary_id . '/sub_salaries/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('sub_salaries/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Salary';
        $salary_id = $this->uri->segment(2);
        $data['form_action'] = site_url('salaries/' . $salary_id . '/sub_salaries/save');
        $data['link_back'] = anchor('salaries/' . $salary_id . '/sub_salaries/index', 'Back');

        $data['id'] = '';
        // Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = '';
        $data['salary_component_id'] = form_dropdown('salary_component_id', $components, $comp_selected);

        $data['salary_periode'] = array('name' => 'salary_periode');
        $data['salary_daily_value'] = array('name' => 'salary_daily_value');
        $data['salary_amount_value'] = array('name' => 'salary_amount_value');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('sub_salaries/frm_sub_salaries', $data);
    }

    function edit() {
        $sub_salary = new Sub_Salary();
        $id = $this->uri->segment(5);
        $rs = $sub_salary->where('sub_id', $id)->get();
        $data['id'] = $rs->sub_id;
        // Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = $rs->salary_component_id;
        $data['salary_component_id'] = form_dropdown('salary_component_id', $components, $comp_selected);
        $data['salary_periode'] = array('name' => 'salary_periode', 'value' => $rs->salary_periode);
        $data['salary_daily_value'] = array('name' => 'salary_daily_value', 'value' => $rs->salary_daily_value);
        $data['salary_amount_value'] = array('name' => 'salary_amount_value', 'value' => $rs->salary_amount_value);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('salaries/' . $rs->salary_id . '/sub_salaries/update');
        $data['link_back'] = anchor('salaries/' . $rs->salary_id . '/sub_salaries/index', 'Back');

        $this->load->view('sub_salaries/frm_sub_salaries', $data);
    }

    function save() {
        $sub_salary = new Sub_Salary();
        $sub_salary->salary_id = $this->uri->segment(2);
        $sub_salary->salary_component_id = $this->input->post('salary_component_id');
        $sub_salary->salary_periode = $this->input->post('salary_periode');
        $sub_salary->salary_daily_value = $this->input->post('salary_daily_value');
        $sub_salary->salary_amount_value = $this->input->post('salary_amount_value');
        if ($sub_salary->save()) {
            $this->session->set_flashdata('message', 'Sub Salary successfully created!');
            redirect('salaries/' . $this->uri->segment(2) . '/sub_salaries/index');
        } else {
            // Failed
            $sub_salary->error_message('custom', 'Field required');
            $msg = $sub_salary->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('salaries/' . $this->uri->segment(2) . '/sub_salaries/add');
        }
    }

    function update() {
        $sub_salary = new Sub_Salary();
        $sub_salary->where('sub_id', $this->input->post('id'))
                ->update(array(
                    'salary_component_id' => $this->input->post('salary_periode'),
                    'salary_periode' => $this->input->post('salary_periode'),
                    'salary_daily_value' => $this->input->post('salary_daily_value'),
                    'salary_amount_value' => $this->input->post('salary_amount_value')
                ));

        $this->session->set_flashdata('message', 'salary Update successfuly.');
        redirect('salaries/' . $this->uri->segment(2) . '/sub_salaries/index');
    }

    function delete($id) {
        $sub_salary = new Sub_Salary();
        $id = $this->uri->segment(5);
        $sub_salary->_delete($id);

        $this->session->set_flashdata('message', 'Salary successfully deleted!');
        redirect('salaries/' . $this->uri->segment(2) . '/sub_salaries/index');
    }

}