<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maritals_Status extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Marital');
        $this->sess_username = $this->session->userdata('username');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->sess_staff_id = $this->session->userdata('sess_staff_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $marital_list = new Marital();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "sn_name";
                break;
            case "2":
                $data['col'] = "sn_id";
                break;
            default:
                $data['col'] = "sn_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }


        $data['title'] = "Maritals Status";
        $data['btn_add'] = anchor('maritals_status/add', 'Add New', array("class" => "btn btn-primary"));
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        if ($this->input->get('search_by')) {
            $total_rows = $marital_list->like($_GET['search_by'], $_GET['q'])->count();
            $marital_list->like($_GET['search_by'], $_GET['q'])->order_by($data['col'], $data['dir']);
        } else {
            $total_rows = $marital_list->count();
            $marital_list->order_by($data['col'], $data['dir']);
        }

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
        $this->filter_access('Marital_Status', 'roled_add', 'maritals_status/index');

        $data['title'] = 'Add New Marital Status';
        $data['form_action'] = site_url('maritals_status/save');
        $data['link_back'] = anchor('maritals_status/', 'Back', array('class' => 'btn btn-danger'));

        $data['id'] = '';
        $data['sn_name'] = array('name' => 'sn_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');

        $this->load->view('maritals_status/frm_maritals_status', $data);
    }

    function edit($id) {
        $this->filter_access('Marital_Status', 'roled_edit', 'maritals_status/index');

        $marital = new Marital();
        $rs = $marital->where('sn_id', $id)->get();
        $data['id'] = $rs->sn_id;
        $data['sn_name'] = array('name' => 'sn_name', 'value' => $rs->sn_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', 'class' => 'btn btn-primary');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('maritals_status/update');
        $data['link_back'] = anchor('maritals_status/', 'Back', array('class' => 'btn btn-danger'));

        $this->load->view('maritals_status/frm_maritals_status', $data);
    }

    function save() {
        $this->filter_access('Marital_Status', 'roled_add', 'maritals_status/index');

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
        $this->filter_access('Marital_Status', 'roled_edit', 'maritals_status/index');

        $marital = new Marital();
        $marital->where('sn_id', $this->input->post('id'))
                ->update('sn_name', $this->input->post('sn_name'));

        $this->session->set_flashdata('message', 'Maritals Update successfuly.');
        redirect('maritals_status/');
    }

    function delete($id) {
        $this->filter_access('Marital_Status', 'roled_delete', 'maritals_status/index');

        $marital = new Marital();
        $marital->_delete($id);
        $this->session->set_flashdata('message', 'Maritals successfully deleted!');
        redirect('maritals_status/');
    }

    function to_excel() {
        $this->load->view('maritals_status/to_excel');
    }

    function filter_access($module, $field, $page) {
        $user = new User();
        $status_access = $user->get_access($this->sess_role_id, $module, $field);

        if ($status_access == false) {
            $msg = '<div class="alert alert-error">You do not have access to this page, please contact administrator</div>';
            $this->session->set_flashdata('message', $msg);
            redirect($page);
        }
    }

}
