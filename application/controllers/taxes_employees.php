<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Taxes_Employees extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Tax_Employee');
    }

    public function index($offset = 0) {
        $tax_list = new Tax_Employee();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "sp_status";
                break;
            case "2":
                $data['col'] = "sp_ptkp";
                break;
            case "3":
                $data['col'] = "sp_id";
                break;
            default:
                $data['col'] = "sp_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }

        $total_rows = $tax_list->count();
        $data['title'] = "Taxes Employees";
        $data['btn_add'] = anchor('taxes_employees/add', 'Add New', array("class" => "btn btn-primary"));
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $tax_list->order_by($data['col'], $data['dir']);
        $data['tax_list'] = $tax_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("taxes_employees/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('taxes_employees/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Tax Employee';
        $data['form_action'] = site_url('taxes_employees/save');
        $data['link_back'] = anchor('taxes_employees/', 'Back', array("class" => "btn"));

        $data['id'] = '';
        $data['sp_status'] = array('name' => 'sp_status', 'id' => 'sp_status');
        $data['sp_ptkp'] = array('name' => 'sp_ptkp', 'id' => 'sp_ptkp');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('taxes_employees/frm_taxes_employees', $data);
    }

    function edit($id) {
        $te = new Tax_Employee();
        $rs = $te->where('sp_id', $id)->get();
        $data['id'] = $rs->sp_id;
        $data['sp_status'] = array('name' => 'sp_status', 'value' => $rs->sp_status);
        $data['sp_ptkp'] = array('name' => 'sp_ptkp', 'id' => 'sp_ptkp', 'value' => $rs->sp_ptkp);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', "class" => "btn btn-primary");

        $data['title'] = 'Update Taxes Employees';
        $data['message'] = '';
        $data['form_action'] = site_url('taxes_employees/update');
        $data['link_back'] = anchor('taxes_employees/', 'Back', array("class" => "btn"));

        $this->load->view('taxes_employees/frm_taxes_employees', $data);
    }

    function replace_currency($value) {
        $current = str_replace("Rp", "", $value);
        $current_value = str_replace(",", "", $current);
        return $current_value;
    }

    function save() {
        $te = new Tax_Employee();
        $te->sp_status = $this->input->post('sp_status');
        $te->sp_ptkp = $this->replace_currency($this->input->post('sp_ptkp'));

        if ($te->save()) {
            $this->session->set_flashdata('message', 'Taxes Employee successfully created!');
            redirect('taxes_employees/');
        } else {
            // Failed
            $te->error_message('custom', 'Field required');
            $msg = $te->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('taxes_employees/add');
        }
    }

    function update() {
        $te = new Tax_Employee();
        $te->where('sp_id', $this->input->post('id'))
                ->update(array(
                    'sp_status' => $this->input->post('sp_status'),
                    'sp_ptkp' => $this->replace_currency($this->input->post('sp_ptkp'))
                        )
        );

        $this->session->set_flashdata('message', 'Taxes Employees Update successfuly.');
        redirect('taxes_employees/');
    }

    function delete($id) {
        $te = new Tax_Employee();
        $te->_delete($id);
        $this->session->set_flashdata('message', 'Taxes Employees successfully deleted!');
        redirect('taxes_employees/');
    }

}
