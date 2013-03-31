<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Titles extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Title');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $title_list = new Title();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "title_name";
                break;
            case "2":
                $data['col'] = "title_id";
                break;
            default:
                $data['col'] = "title_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }


        $data['title'] = "Titles";
        $data['btn_add'] = anchor('titles/add', 'Add New', array("class" => "btn btn-primary"));
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        if ($this->input->get('search_by')) {
            $total_rows = $title_list->like($_GET['search_by'], $_GET['q'])->count();
            $title_list->like($_GET['search_by'], $_GET['q'])->order_by($data['col'], $data['dir']);
        } else {
            $total_rows = $title_list->count();
            $title_list->order_by($data['col'], $data['dir']);
        }

        $data['title_list'] = $title_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("titles/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('titles/index', $data);
    }

    function add() {
        $this->filter_access('Title', 'roled_add', 'titles/index');
        $data['title'] = 'Add New Title';
        $data['form_action'] = site_url('titles/save');
        $data['link_back'] = anchor('titles/', 'Back', array("class" => "btn btn-danger"));

        $data['id'] = '';
        $data['title_name'] = array('name' => 'title_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('titles/frm_title', $data);
    }

    function edit($id) {
        $this->filter_access('Title', 'roled_edit', 'titles/index');
        $title = new Title();
        $rs = $title->where('title_id', $id)->get();
        $data['id'] = $rs->title_id;
        $data['title_name'] = array('name' => 'title_name', 'value' => $rs->title_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', "class" => "btn btn-primary");

        $data['title'] = 'Update Title';
        $data['form_action'] = site_url('titles/update');
        $data['link_back'] = anchor('titles/', 'Back', array("class" => "btn btn-danger"));

        $this->load->view('titles/frm_title', $data);
    }

    function save() {
        $this->filter_access('Title', 'roled_add', 'titles/index');
        $title = new Title();
        $title->title_name = $this->input->post('title_name');
        if ($title->save()) {
            $this->session->set_flashdata('message', 'Title successfully created!');
            redirect('titles/');
        } else {
            // Failed
            $title->error_message('custom', 'Title Name required');
            $msg = $title->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('titles/add');
        }
    }

    function update() {
        $this->filter_access('Title', 'roled_edit', 'titles/index');
        $title = new Title();
        $title->where('title_id', $this->input->post('id'))
                ->update('title_name', $this->input->post('title_name'));

        $this->session->set_flashdata('message', 'Title Update successfuly.');
        redirect('titles/');
    }

    function delete($id) {
        $this->filter_access('Title', 'roled_delete', 'titles/index');
        $title = new Title();
        $title->_delete($id);
        $this->session->set_flashdata('message', 'Title successfully deleted!');
        redirect('titles/');
    }

    function to_excel() {
        $this->load->view('titles/to_excel');
    }

    function filter_access($module, $field, $page) {
        $user = new User();
        $status_access = $user->get_access($this->sess_role_id, $module, $field);

        if ($status_access == true) {
            $msg = '<div class="alert alert-error">You do not have access to this page, please contact administrator</div>';
            $this->session->set_flashdata('message', $msg);
            redirect($page);
        }
    }

}
