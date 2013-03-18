<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Work_Histories extends CI_Controller {

    private $limit = 10;
    var $staff_id;
    var $uri_segment;
    var $work_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Work');
        $this->load->library('breadcrumb');
        $this->staff_id = $this->uri->segment(2);
        $this->uri_segment = $this->uri->segment(5);
        $this->work_id = $this->uri->segment(5);
        $this->sess_username = $this->session->userdata('username');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->sess_staff_id = $this->session->userdata('sess_staff_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $this->breadcrumb->append_crumb('Home', base_url());
        $this->breadcrumb->append_crumb('Staff Detail', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Work Histories', base_url() . '');

        $work = new Work();
        $data['staff_id'] = $this->staff_id;
        $work->where('staff_id', $this->staff_id)->order_by('history_date', 'ASC');

        $total_rows = $work->count();
        $data['title'] = "Work Histories";
        $data['btn_add'] = anchor('staffs/' . $this->staff_id . '/work_histories/add', 'Add New');
        $data['btn_home'] = anchor('staffs', 'Home');

        $offset = $this->uri->segment($this->uri_segment);


        $data['work_histories'] = $work
                        ->where('staff_id', $this->staff_id)
                        ->get($this->limit, $offset)->all;
        $config['base_url'] = site_url('staffs/' . $this->staff_id . '/work_histories/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['breadcrumb'] = $this->breadcrumb->output();
        $this->load->view('staff_work_history/index', $data);
    }

    function add() {
        $this->breadcrumb->append_crumb('Home', base_url());
        $this->breadcrumb->append_crumb('Staff Detail', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Listing Works History', base_url() . 'index.php/staffs/' . $this->staff_id . '/work_histories/index');
        $this->breadcrumb->append_crumb('Add New Work', base_url() . '');

        $data['title'] = 'Add New Work';

        $data['form_action'] = site_url('staffs/' . $this->staff_id . '/work_histories/save');
        $data['link_back'] = anchor('staffs/' . $this->staff_id . '/work_histories/index', 'Back');

        $data['id'] = '';
        $data['history_date'] = array('name' => 'history_date', 'id' => 'history_date');
        $data['history_description'] = array('name' => 'history_description');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');
        $data['breadcrumb'] = $this->breadcrumb->output();

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function edit() {
        $this->breadcrumb->append_crumb('Home', base_url());
        $this->breadcrumb->append_crumb('Staff Detail', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Listing Works History', base_url() . 'index.php/staffs/' . $this->staff_id . '/work_histories/index');
        $this->breadcrumb->append_crumb('Update Work History', base_url() . '');

        $work = new Work();

        $rs = $work->where('history_id', $this->work_id)->get();
        $data['id'] = $rs->history_id;
        $data['history_date'] = array('name' => 'history_date', 'id' => 'history_date', 'value' => $rs->history_date);
        $data['history_description'] = array('name' => 'history_description', 'value' => $rs->history_description);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');
        $data['breadcrumb'] = $this->breadcrumb->output();
        $data['title'] = 'Update Work History';
        $data['message'] = '';
        $data['form_action'] = site_url('staffs/' . $this->staff_id . '/work_histories/update');
        $data['link_back'] = anchor('staffs/' . $this->staff_id . '/work_histories/index', 'Back');

        $this->load->view('staff_work_history/frm_work', $data);
    }

    function save() {
        $work = new Work();

        $work->staff_id = $this->staff_id;
        $work->history_date = $this->input->post('history_date');
        $work->history_description = $this->input->post('history_description');

        if ($work->save()) {
            $this->session->set_flashdata('message', 'Work successfully created!');
            redirect('staffs/' . $this->staff_id . '/work_histories/index');
        } else {
            // Failed
            $work->error_message('custom', 'Field required');
            $msg = $work->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staffs/' . $this->staff_id . '/work_histories/add');
        }
    }

    function update() {
        $work = new Work();
        $id = $this->input->post('id');

        $work->where('history_id', $id)->update(array(
            'history_date' => $this->input->post('history_date'),
            'history_description' => $this->input->post('history_description')
        ));
        $this->session->set_flashdata('message', 'Work Update successfuly.');
        redirect('staffs/' . $this->staff_id . '/work_histories/index');
    }

    function delete() {
        $this->filter_access('Branch', 'roled_delete', 'branches/index');
        $work = new Work();

        $work->_delete($this->work_id);
        redirect('staffs/' . $this->staff_id . '/work_histories/index');
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