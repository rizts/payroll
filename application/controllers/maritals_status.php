<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maritals_Status extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Marital');
    }

    public function index($offset = 0) {
        $marital_list = new Marital();
        $total_rows = $marital_list->count();
        $data['title'] = "Maritals Status";
        $data['btn_add'] = anchor('maritals_status/add', 'Add New Marital Status');
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $marital_list->order_by('sn_name', 'ASC');
        $data['marital_list'] = $marital_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("maritals_status/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('maritals_status/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Marital Status';
        $data['form_action'] = site_url('maritals_status/save');
        $data['link_back'] = anchor('maritals_status/', 'Back', array('class' => 'back'));

        $data['id'] = '';
        $data['sn_name'] = array('name' => 'sn_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save Maritals');

        $this->load->view('maritals_status/frm_maritals_status', $data);
    }

    function edit($id) {
        $marital = new Marital();
        $rs = $marital->where('sn_id', $id)->get();
        $data['id'] = $rs->sn_id;
        $data['sn_name'] = array('name' => 'sn_name', 'value' => $rs->sn_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Status Nikah');

        $data['title'] = 'Update Status Nikah';
        $data['message'] = '';
        $data['form_action'] = site_url('maritals_status/update');
        $data['link_back'] = anchor('maritals_status/', 'Back');

        $this->load->view('maritals_status/frm_maritals_status', $data);
    }

    function save() {
        $marital = new Marital();
        $marital->sn_name = $this->input->post('sn_name');
        if ($marital->save()) {
            $this->session->set_flashdata('message', 'Maritals successfully created!');
            redirect('maritals_status/');
        } else {
            // Failed
            $marital->error_message('custom', 'field required');
            $msg = $marital->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('maritals_status/add');
        }
    }

    function update() {
        $marital = new Marital();
        $marital->where('sn_id', $this->input->post('id'))
                ->update('sn_name', $this->input->post('sn_name'));

        $this->session->set_flashdata('message', 'Maritals Update successfuly.');
        redirect('maritals_status/');
    }

    function delete($id) {
        $marital = new Marital();
        $marital->_delete($id);

        $this->session->set_flashdata('message', 'Maritals successfully deleted!');

        redirect('maritals_status/');
    }

}