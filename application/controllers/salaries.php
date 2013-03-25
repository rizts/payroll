<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salaries extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Salary');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $salary = new Salary();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "salary_periode";
                break;
            case "2":
                $data['col'] = "salary_staffid";
                break;
            case "3":
                $data['col'] = "salary_id";
                break;
            default:
                $data['col'] = "salary_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }

        $total_rows = $salary->count();
        $data['title'] = "Salary";
        $data['btn_add'] = anchor('salaries/add', 'Add New', "class='btn btn-primary'");
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $salary->order_by($data['col'], $data['dir']);
        $data['salaries'] = $salary->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("salaries/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('salaries/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Salary';
        $data['form_action'] = site_url('salaries/save');
        $data['link_back'] = anchor('salaries/', 'Back', array('class' => 'btn btn-danger'));

        $data['id'] = '';
        $data['salary_periode'] = array('name' => 'salary_periode');
        $data['salary_staffid'] = array('name' => 'salary_staffid');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');

        $this->load->view('salaries/frm_salaries', $data);
    }

    function edit($id) {
        $salary = new Salary();

        $rs = $salary->where('salary_id', $id)->get();
        $data['id'] = $rs->salary_id;
        $data['salary_periode'] = array('name' => 'salary_periode', 'value' => $rs->salary_periode);
        $data['salary_staffid'] = array('name' => 'salary_staffid', 'value' => $rs->salary_staffid);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('salaries/update');
        $data['link_back'] = anchor('salaries/', 'Back', array('class'=>'btn  btn-danger'));

        $this->load->view('salaries/frm_salaries', $data);
    }

    function save() {
        $salary = new Salary();
        $salary->salary_periode = $this->input->post('salary_periode');
        $salary->salary_staffid = $this->input->post('salary_staffid');
        if ($salary->save()) {
            $this->session->set_flashdata('message', 'Salary successfully created!');
            redirect('salaries/');
        } else {
            // Failed
            $salary->error_message('custom', 'Salary Name required');
            $msg = $salary->error->custom;
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
