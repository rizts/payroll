<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Educations extends CI_Controller {

    private $limit = 10;
    var $staff_id;
    var $uri_segment;
    var $edu_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Education');
        $this->load->library('breadcrumb');
        $this->staff_id = $this->uri->segment(2);
        $this->uri_segment = $this->uri->segment(5);
        $this->edu_id = $this->uri->segment(5);
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $this->breadcrumb->append_crumb('Home', base_url());
        $this->breadcrumb->append_crumb('Staff Detail', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Educations', base_url() . '');

        $education = new Education();
        $data['staff_id'] = $this->staff_id;
        $education->where('staff_id', $this->staff_id)->order_by('edu_year', 'ASC');

        $total_rows = $education->count();
        $data['title'] = "Family";
        $data['btn_add'] = anchor('staffs/' . $this->staff_id . '/educations/add', 'Add New', array('class' => 'btn btn-primary'));
        $data['btn_home'] = anchor('staffs', 'Home');

        $offset = $this->uri->segment($this->uri_segment);

        $data['educations'] = $education
                        ->where('staff_id', $this->staff_id)
                        ->get($this->limit, $offset)->all;
        $config['base_url'] = site_url('staffs/' . $this->staff_id . '/educations/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['breadcrumb'] = $this->breadcrumb->output();

        $this->load->view('staff_education/index', $data);
    }

    function add() {
        $this->breadcrumb->append_crumb('Home', base_url());
        $this->breadcrumb->append_crumb('Staff Detail', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Listing Education', base_url() . 'index.php/staffs/' . $this->staff_id . '/educations/index');
        $this->breadcrumb->append_crumb('Add New Education', base_url() . '');

        $data['title'] = 'Add New Education';

        $data['form_action'] = site_url('staffs/' . $this->staff_id . '/educations/save');
        $data['link_back'] = anchor('staffs/' . $this->staff_id . '/educations/index', 'Back', array('class'=>'btn'));

        $data['id'] = '';
        $data['edu_year'] = array('name' => 'edu_year', 'placeholder' => 'Year');
        $data['edu_gelar'] = array('name' => 'edu_gelar');
        $data['edu_name'] = array('name' => 'edu_name');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');
        $data['breadcrumb'] = $this->breadcrumb->output();

        $this->load->view('staff_education/frm_education', $data);
    }

    function edit() {
        $this->breadcrumb->append_crumb('Home', base_url());
        $this->breadcrumb->append_crumb('Staff Detail', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Listing Education', base_url() . 'index.php/staffs/' . $this->staff_id . '/educations/index');
        $this->breadcrumb->append_crumb('Update Education', base_url() . '');

        $education = new Education();
        $edu_id = $this->uri->segment(5);

        $rs = $education->where('edu_id', $edu_id)->get();
        $data['id'] = $rs->edu_id;
        $data['edu_year'] = array('name' => 'edu_year', 'placeholder' => 'Year', 'value' => $rs->edu_year);
        $data['edu_gelar'] = array('name' => 'edu_gelar', 'value' => $rs->edu_gelar);
        $data['edu_name'] = array('name' => 'edu_name', 'value' => $rs->edu_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('staffs/' . $this->staff_id . '/educations/update');
        $data['link_back'] = anchor('staffs/' . $this->staff_id . '/educations/index', 'Back');
        $data['breadcrumb'] = $this->breadcrumb->output();
        $this->load->view('staff_education/frm_education', $data);
    }

    function save() {
        $education = new Education();

        $education->staff_id = $this->staff_id;
        $education->edu_year = $this->input->post('edu_year');
        $education->edu_gelar = $this->input->post('edu_gelar');
        $education->edu_name = $this->input->post('edu_name');

        if ($education->save()) {
            $this->session->set_flashdata('message', 'Education successfully created!');
            redirect('staffs/' . $this->staff_id . '/educations/index');
        } else {
            // Failed
            $education->error_message('custom', 'Field required');
            $msg = $education->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staffs/' . $this->staff_id . '/educations/add');
        }
    }

    function update() {
        $education = new Education();

        $id = $this->input->post('id');
        $education->where('edu_id', $id)
                ->update(array(
                    'edu_year' => $this->input->post('edu_year'),
                    'edu_gelar' => $this->input->post('edu_gelar'),
                    'edu_name' => $this->input->post('edu_name')
                ));
        $this->session->set_flashdata('message', 'Education Update successfuly.');
        redirect('staffs/' . $this->staff_id . '/educations/index');
    }

    function delete() {
        $education = new Education();
        $education->_delete($this->edu_id);
        $this->session->set_flashdata('message', 'Education deleted.');
        redirect('staffs/' . $this->staff_id . '/educations/index');
    }

}