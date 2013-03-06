<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salary_Components extends CI_Controller {

    private $limit = 10;
    private $staff_id;
    private $uri_segment;
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Salary_Component');
        $this->load->model('Component');
        $this->staff_id = $this->uri->segment(2);
        $this->uri_segment = $this->uri->segment(5);
        $this->id = $this->uri->segment(5);
//        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $salary_component = new Salary_Component();

        $salary_component->where('staff_id', $this->staff_id)->order_by('gaji_id', 'DESC');
        $total_rows = $salary_component->count();

        $data['title'] = "Salary Component";
        $data['btn_add'] = anchor('staffs/' . $this->staff_id . '/salary_components/add', 'Add New');
        $data['btn_home'] = anchor('staffs/', 'Home');

        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);

        $salary_component->where('staff_id', $this->staff_id)->order_by('gaji_id', 'ASC');
        $data['salary_components'] = $salary_component->get($this->limit, $offset)->all;

        $config['base_url'] = site_url('staffs/' . $this->staff_id . '/salary_components/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_salary_components/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Salary Component';

        $data['form_action'] = site_url('staffs/' . $this->staff_id . '/salary_components/save');
        $data['link_back'] = anchor('staffs/' . $this->staff_id . '/salary_components/index', 'Back', array('class' => 'back'));

        $data['id'] = '';
// Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = '';
        $data['gaji_component_id'] = form_dropdown('gaji_component_id', $components, $comp_selected);

        $data['gaji_daily_value'] = array('name' => 'gaji_daily_value');
        $data['gaji_amount_value'] = array('name' => 'gaji_amount_value');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('staff_salary_components/frm_salary_component', $data);
    }

    function edit() {
        $salary_component = new Salary_Component();

        $rs = $salary_component->where('gaji_id', $this->id)->get();
        $data['id'] = $rs->gaji_id;

// Component
        $component = new Component();
        $components = $component->list_drop();
        $comp_selected = $rs->gaji_component_id;
        $data['gaji_component_id'] = form_dropdown('gaji_component_id', $components, $comp_selected);

        $data['gaji_daily_value'] = array('name' => 'gaji_daily_value', 'value' => $rs->gaji_daily_value);
        $data['gaji_amount_value'] = array('name' => 'gaji_amount_value', 'value' => $rs->gaji_amount_value);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('staffs/' . $this->staff_id . '/salary_components/update');
        $data['link_back'] = anchor('staffs/' . $this->staff_id . '/salary_components/index', 'Back');

        $this->load->view('staff_salary_components/frm_salary_component', $data);
    }

    function save() {
        $salary_component = new Salary_Component();

        $salary_component->staff_id = $this->staff_id;
        $salary_component->gaji_component_id = $this->input->post('gaji_component_id');
        $salary_component->gaji_daily_value = $this->input->post('gaji_daily_value');
        $salary_component->gaji_amount_value = $this->input->post('gaji_amount_value');
        if ($salary_component->save()) {
            $this->session->set_flashdata('message', 'Branch successfully created!');
            redirect('staffs/'.$this->staff_id.'/salary_components/index');
        } else {
// Failed
            $salary_component->error_message('custom', 'Field required');
            $msg = $salary_component->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staffs/'.$this->staff_id.'/salary_components/add');
        }
    }

    function update() {
        $salary_component = new Salary_Component();
        $salary_component->where('gaji_id', $this->input->post('id'))
                ->update(array(
                    'staff_id' => $this->staff_id,
                    'gaji_component_id' => $this->input->post('gaji_component_id'),
                    'gaji_daily_value' => $this->input->post('gaji_daily_value'),
                    'gaji_amount_value' => $this->input->post('gaji_amount_value')
                ));
        $this->session->set_flashdata('message', 'Update successfully deleted!');
        redirect('staffs/'.$this->staff_id.'/salary_components/index');
    }

    function delete() {
        $salary_component = new Salary_Component();
        $salary_component->_delete($this->id);

        $this->session->set_flashdata('message', 'Salary successfully deleted!');
        redirect('staffs/'.$this->staff_id.'/salary_components/index');
    }

}