<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Families extends CI_Controller {

    private $limit = 5;

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->model('mfamily', 'family_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Family";
        $data['staff_id'] = $this->uri->segment(2);
        $data['message'] = "";
        $data['btn_add'] = anchor('staff/'.$data['staff_id'].'/families/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['families'] = $this->family_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('staff/' . $data['staff_id'] . '/families/index/');
        $config['total_rows'] = $this->family_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff_family/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Family';
        $data['form_action'] = site_url('staff/' . $this->uri->segment(2) . '/families/save');
        $data['link_back'] = anchor('staff/' . $this->uri->segment(2) . '/families/index', 'Back');

        $data['id'] = '';
        $data['staff_id'] = $this->uri->segment(2);
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

        $this->load->view('staff_family/frm_family', $data);
    }

    function edit() {
        $fam_id = $this->uri->segment(5);
        $staff_id = $this->uri->segment(2);
        $family = $this->family_model->find($fam_id)->row();
        $data['id'] = $family->staff_fam_id;
        $data['staff_fam_id'] = array('name' => 'staff_fam_id', 'value' => $family->staff_fam_id);
        $data['staff_fam_order'] = array('name' => 'staff_fam_order', 'value' => $family->staff_fam_order);
        $data['staff_fam_name'] = array('name' => 'staff_fam_name', 'value' => $family->staff_fam_name);
        $data['staff_fam_birthdate'] = array('name' => 'staff_fam_birthdate', 'value' => $family->staff_fam_birthdate);
        $data['staff_fam_birthplace'] = array('name' => 'staff_fam_birthplace', 'value' => $family->staff_fam_birthplace);
        $options_sex = array(
            'Laki' => 'Laki',
            'Perempuan' => 'Perempuan'
        );
        $sex_selected = $family->staff_fam_sex;
        $data['staff_fam_sex'] = form_dropdown('staff_fam_sex', $options_sex, $sex_selected);

        $options_relation = array(
            'Anak 1' => 'Anak 1',
            'Anak 2' => 'Anak 2',
            'Anak 3' => 'Anak 3',
            'Anak 4' => 'Anak 4',
            'Anak 5' => 'Anak 5'
        );
        $relation_selected = $family->staff_fam_relation;
        $data['staff_fam_relation'] = form_dropdown('staff_fam_relation', $options_relation, $relation_selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update Family');

        $data['title'] = 'Update';
        $data['message'] = '';
        $data['form_action'] = site_url('staff/' . $staff_id . '/families/update');
        $data['link_back'] = anchor('staff/' . $staff_id . '/families/', 'Back');

        $this->load->view('staff_family/frm_family', $data);
    }

    function save() {
        $staff_id = $this->uri->segment(2);
        $this->form_validation->set_rules('staff_fam_name', 'Nama Family Staff', 'required');
        $this->form_validation->set_rules('staff_fam_order', 'Nama Family Staff', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $family = array(
                'staff_fam_id' => $this->input->post('staff_fam_id'),
                'staff_fam_staff_id' => $staff_id,
                'staff_fam_order' => $this->input->post('staff_fam_order'),
                'staff_fam_name' => $this->input->post('staff_fam_name'),
                'staff_fam_birthdate' => $this->input->post('staff_fam_birthdate'),
                'staff_fam_birthplace' => $this->input->post('staff_fam_birthplace'),
                'staff_fam_sex' => $this->input->post('staff_fam_sex'),
                'staff_fam_relation' => $this->input->post('staff_fam_relation')
            );
            $this->family_model->save($family);

            // set user message
            $data['message'] = '<div class="success">add new family success</div>';
            redirect('staff/' . $staff_id . '/families/index');
        }
    }

    function update() {
        $fam_id = $this->input->post('id');
        $staff_id = $this->uri->segment(2);

        $family = array(
            'staff_fam_order' => $this->input->post('staff_fam_order'),
            'staff_fam_name' => $this->input->post('staff_fam_name'),
            'staff_fam_birthdate' => $this->input->post('staff_fam_birthdate'),
            'staff_fam_birthplace' => $this->input->post('staff_fam_birthplace'),
            'staff_fam_sex' => $this->input->post('staff_fam_sex'),
            'staff_fam_relation' => $this->input->post('staff_fam_relation')
        );

        $this->family_model->update($fam_id, $family);
        redirect('staff/' . $staff_id . '/families/index');
    }

    function delete() {
        $fam_id = $this->uri->segment(5);
        $this->family_model->delete($fam_id);
        redirect('staff/' . $this->uri->segment(2) . '/families/index');
    }

}