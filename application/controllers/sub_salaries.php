<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_Salaries extends CI_Controller {

    private $limit = 10;
    var $salary_id;
    var $uri_segment;
    var $sub_id;

    public function __construct() {
        parent::__construct();        
        $this->load->model('Sub_Salary');
        $this->load->model('Component');
        $this->load->helper('rupiah');
        $this->salary_id = $this->uri->segment(2);
        $this->uri_segment = $this->uri->segment(5);
        $this->sub_id = $this->uri->segment(5);
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $sub_salary = new Sub_Salary();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "salary_periode";
                break;
            case "2":
                $data['col'] = "salary_daily_value";
                break;
            case "3":
                $data['col'] = "salary_amount_value";
                break;
            case "4":
                $data['col'] = "sub_id";
                break;
            default:
                $data['col'] = "sub_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }

        $sub_salary->where('salary_id', $this->salary_id)->order_by($data['col'], $data['dir']);
        $total_rows = $sub_salary->count();

        $data['title'] = "Sub Salary";
        $data['salary_id'] = $this->salary_id;
        $data['btn_add'] = anchor('salaries/' . $this->salary_id . '/sub_salaries/add', 'Add New', array('class' => 'btn btn-primary'));
        $data['btn_home'] = anchor('salaries/', 'Back');

        $offset = $this->uri->segment($this->uri_segment);

        $data['sub_salaries'] = $sub_salary
                        ->where('salary_id', $this->salary_id)
                        ->order_by($data['col'], $data['dir'])
                        ->get($this->limit, $offset)->all;

        $config['base_url'] = site_url('salaries/' . $this->salary_id . '/sub_salaries/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('sub_salaries/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Salary';        
        $data['form_action'] = site_url('salaries/' . $this->salary_id . '/sub_salaries/save');
        $data['link_back'] = anchor('salaries/' . $this->salary_id . '/sub_salaries/index', 'Back', array('class' => 'btn'));

        $data['id'] = '';
        // Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = '';
        $data['salary_component_id'] = form_dropdown('salary_component_id', $components, $comp_selected, 'id="salary_component_id"');

        $data['salary_periode'] = array('name' => 'salary_periode');
        $data['salary_daily_value'] = array('name' => 'salary_daily_value', 'id' => 'salary_daily_value');
        $data['salary_amount_value'] = array('name' => 'salary_amount_value', 'id' => 'salary_amount_value');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');

        $this->load->view('sub_salaries/frm_sub_salaries', $data);
    }

    function edit() {
        $sub_salary = new Sub_Salary();
        $rs = $sub_salary->where('sub_id', $this->sub_id)->get();
        $data['id'] = $this->sub_id;
        // Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = $rs->salary_component_id;
        $data['salary_component_id'] = form_dropdown('salary_component_id', $components, $comp_selected, 'id="salary_component_id"');
        $data['salary_periode'] = array('name' => 'salary_periode', 'value' => $rs->salary_periode);
        $data['salary_daily_value'] = array('name' => 'salary_daily_value', 'value' => $rs->salary_daily_value, 'id' => 'salary_daily_value');
        $data['salary_amount_value'] = array('name' => 'salary_amount_value', 'value' => $rs->salary_amount_value, 'id' => 'salary_amount_value');

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', 'class' => 'btn btn-primary');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('salaries/' . $this->salary_id . '/sub_salaries/update');
        $data['link_back'] = anchor('salaries/' . $this->salary_id . '/sub_salaries/index', 'Back', array('class' => 'btn'));

        $this->load->view('sub_salaries/frm_sub_salaries', $data);
    }

    function replace_currency($value) {
        $current = str_replace("Rp", "", $value);
        $current_value = str_replace(",", "", $current);
        return $current_value;
    }

    function save() {
        $sub_salary = new Sub_Salary();
        $sub_salary->salary_id = $this->salary_id;
        $sub_salary->salary_component_id = $this->input->post('salary_component_id');
        $sub_salary->salary_periode = $this->input->post('salary_periode');
        $sub_salary->salary_daily_value = $this->replace_currency($this->input->post('salary_daily_value'));
        $sub_salary->salary_amount_value = $this->replace_currency($this->input->post('salary_amount_value'));
        if ($sub_salary->save()) {
            $this->session->set_flashdata('message', 'Sub Salary successfully created!');
            redirect('salaries/' . $this->salary_id . '/sub_salaries/index');
        } else {
            // Failed
            $sub_salary->error_message('custom', 'Field required');
            $msg = $sub_salary->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('salaries/' . $this->salary_id . '/sub_salaries/add');
        }
    }

    function update() {
        $sub_salary = new Sub_Salary();
        $sub_salary->where('sub_id', $this->input->post('id'))
                ->update(array(
                    'salary_component_id' => $this->input->post('salary_periode'),
                    'salary_periode' => $this->input->post('salary_periode'),
                    'salary_daily_value' => $this->replace_currency($this->input->post('salary_daily_value')),
                    'salary_amount_value' => $this->replace_currency($this->input->post('salary_amount_value'))
                ));

        $this->session->set_flashdata('message', 'salary Update successfuly.');
        redirect('salaries/' . $this->salary_id . '/sub_salaries/index');
    }

    function delete() {
        $sub_salary = new Sub_Salary();
        $sub_salary->_delete($this->sub_id);

        $this->session->set_flashdata('message', 'Sub Salary successfully deleted!');
        redirect('salaries/' . $this->salary_id . '/sub_salaries/index');
    }

}