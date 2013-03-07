<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Families extends CI_Controller {

    private $limit = 5;
    var $staff_id;
    var $uri_segment;
    var $work_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Family');
        $this->load->library('breadcrumb');
        $this->staff_id = $this->uri->segment(2);
        $this->uri_segment = $this->uri->segment(5);
        $this->family_id = $this->uri->segment(5);
    }

    public function index($offset = 0) {
        $this->breadcrumb->append_crumb('Staff', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Families', base_url() . '');

        $family = new Family();
        $data['staff_id'] = $this->staff_id;
        $family->where('staff_fam_staff_id', $this->staff_id)->order_by('staff_fam_name', 'ASC');

        $total_rows = $family->count();
        $data['title'] = "Family";
        $data['btn_add'] = anchor('staffs/' . $this->staff_id . '/families/add', 'Add New');
        $data['btn_home'] = anchor('staffs', 'Home');

        $offset = $this->uri->segment($this->uri_segment);


        $data['families'] = $family
                        ->where('staff_fam_staff_id', $this->staff_id)
                        ->get($this->limit, $offset)->all;
        $config['base_url'] = site_url('staffs/' . $this->staff_id . '/families/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['breadcrumb'] = $this->breadcrumb->output();
        $this->load->view('staff_family/index', $data);
    }

    function add() {
        $this->breadcrumb->append_crumb('Staff', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Listing Families', base_url() . 'index.php/staffs/' . $this->staff_id . '/families/index');
        $this->breadcrumb->append_crumb('Add New Family', base_url() . '');

        $data['title'] = 'Add New Family';
        $data['form_action'] = site_url('staffs/' . $this->uri->segment(2) . '/families/save');
        $data['link_back'] = anchor('staffs/' . $this->uri->segment(2) . '/families/index', 'Back');

        $data['id'] = '';
        $data['staff_id'] = $this->staff_id;
        $data['staff_fam_id'] = array('name' => 'staff_fam_id');
        $data['staff_fam_staff_id'] = array('name' => 'staff_fam_staff_id');
        $data['staff_fam_order'] = array('name' => 'staff_fam_order');
        $data['staff_fam_name'] = array('name' => 'staff_fam_name');
        $data['staff_fam_birthdate'] = array('name' => 'staff_fam_birthdate');
        $data['staff_fam_birthplace'] = array('name' => 'staff_fam_birthplace');
        $options_sex = array(
            'Laki' => 'Laki',
            'Perempuan' => 'Perempuan'
        );
        $sex_selected = 'Laki';
        $data['staff_fam_sex'] = form_dropdown('staff_fam_sex', $options_sex, $sex_selected);

        $options_relation = array(
            'Anak 1' => 'Anak 1',
            'Anak 2' => 'Anak 2',
            'Anak 3' => 'Anak 3',
            'Anak 4' => 'Anak 4',
            'Anak 5' => 'Anak 5'
        );
        $relation_selected = 'Anak 1';
        $data['staff_fam_relation'] = form_dropdown('staff_fam_relation', $options_relation, $relation_selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');
        $data['breadcrumb'] = $this->breadcrumb->output();
        $this->load->view('staff_family/frm_family', $data);
    }

    function edit() {
        $this->breadcrumb->append_crumb('Staff', base_url() . 'index.php/staffs/show/' . $this->staff_id);
        $this->breadcrumb->append_crumb('Listing Families', base_url() . 'index.php/staffs/' . $this->staff_id . '/families/index');
        $this->breadcrumb->append_crumb('Update Family', base_url() . '');

        $family = new Family();
        $fam_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);

        $rs = $family->where('staff_fam_id', $fam_id)->get();

        $data['id'] = $rs->staff_fam_id;
        $data['staff_fam_id'] = array('name' => 'staff_fam_id', 'value' => $rs->staff_fam_id);
        $data['staff_fam_order'] = array('name' => 'staff_fam_order', 'value' => $rs->staff_fam_order);
        $data['staff_fam_name'] = array('name' => 'staff_fam_name', 'value' => $rs->staff_fam_name);
        $data['staff_fam_birthdate'] = array('name' => 'staff_fam_birthdate', 'value' => $rs->staff_fam_birthdate);
        $data['staff_fam_birthplace'] = array('name' => 'staff_fam_birthplace', 'value' => $rs->staff_fam_birthplace);
        $options_sex = array(
            'Laki' => 'Laki',
            'Perempuan' => 'Perempuan'
        );
        $sex_selected = $rs->staff_fam_sex;
        $data['staff_fam_sex'] = form_dropdown('staff_fam_sex', $options_sex, $sex_selected);

        $options_relation = array(
            'Anak 1' => 'Anak 1',
            'Anak 2' => 'Anak 2',
            'Anak 3' => 'Anak 3',
            'Anak 4' => 'Anak 4',
            'Anak 5' => 'Anak 5'
        );
        $relation_selected = $rs->staff_fam_relation;
        $data['staff_fam_relation'] = form_dropdown('staff_fam_relation', $options_relation, $relation_selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Family');
        $data['breadcrumb'] = $this->breadcrumb->output();
        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('staffs/' . $staff_id . '/families/update');
        $data['link_back'] = anchor('staffs/' . $staff_id . '/families/index', 'Back');

        $this->load->view('staff_family/frm_family', $data);
    }

    function save() {
        $family = new Family();
        $staff_id = $this->uri->segment(2);
        $family->staff_fam_staff_id = $staff_id;
        $family->staff_fam_order = $this->input->post('staff_fam_order');
        $family->staff_fam_name = $this->input->post('staff_fam_name');
        $family->staff_fam_birthdate = $this->input->post('staff_fam_birthdate');
        $family->staff_fam_birthplace = $this->input->post('staff_fam_birthplace');
        $family->staff_fam_sex = $this->input->post('staff_fam_sex');
        $family->staff_fam_relation = $this->input->post('staff_fam_relation');

        if ($family->save()) {
            $this->session->set_flashdata('message', 'Family successfully created!');
            redirect('staffs/' . $staff_id . '/families/index');
        } else {
            // Failed
            $family->error_message('custom', 'Field required');
            $msg = $family->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staff/' . $staff_id . '/families/add');
        }
    }

    function update() {
        $family = new Family();
        $fam_id = $this->input->post('id');
        $staff_id = $this->uri->segment(2);
        $family->where('staff_fam_id', $fam_id)
                ->update(array(
                    'staff_fam_order' => $this->input->post('staff_fam_order'),
                    'staff_fam_name' => $this->input->post('staff_fam_name'),
                    'staff_fam_birthdate' => $this->input->post('staff_fam_birthdate'),
                    'staff_fam_birthplace' => $this->input->post('staff_fam_birthplace'),
                    'staff_fam_sex' => $this->input->post('staff_fam_sex'),
                    'staff_fam_relation' => $this->input->post('staff_fam_relation')
                ));

        $this->session->set_flashdata('message', 'Family Update successfuly.');
        redirect('staffs/' . $staff_id . '/families/index');
    }

    function delete() {
        $family = new Family();
        $family->_delete($this->uri->segment(5));
        redirect('staffs/' . $this->uri->segment(2) . '/families/index');
    }

}