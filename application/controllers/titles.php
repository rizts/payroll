<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Titles extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Title');
//        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $title_list = new Title();
        $total_rows = $title_list->count();
        $data['title'] = "Titles";
        $data['btn_add'] = anchor('titles/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $title_list->order_by('title_id', 'DESC');
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
        $data['title'] = 'Add New Title';
        $data['form_action'] = site_url('titles/save');
        $data['link_back'] = anchor('titles/', 'Back');

        $data['id'] = '';
        $data['title_name'] = array('name' => 'title_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('titles/frm_title', $data);
    }

    function edit($id) {
        $title = new Title();
        $rs = $title->where('title_id', $id)->get();
        $data['id'] = $rs->title_id;
        $data['title_name'] = array('name' => 'title_name', 'value' => $rs->title_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update Title';
        $data['form_action'] = site_url('titles/update');
        $data['link_back'] = anchor('titles/', 'Back');

        $this->load->view('titles/frm_title', $data);
    }

    function save() {
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
        $title = new Title();
        $title->where('title_id', $this->input->post('id'))
                ->update('title_name', $this->input->post('title_name'));

        $this->session->set_flashdata('message', 'Title Update successfuly.');
        redirect('titles/');
    }

    function delete($id) {
        $title = new Title();
        $title->_delete($id);
        $this->session->set_flashdata('message', 'Title successfully deleted!');
        redirect('titles/');
    }

}