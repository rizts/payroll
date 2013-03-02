<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');

        $this->load->model('mstaff', 'staff_model');
        $this->load->model('Branch', 'branch_model');
        $this->load->model('Department', 'dept_model');
        $this->load->model('Title', 'jbt_model');
        $this->load->model('Marital', 'sn_model');
        $this->load->model('employee_status', 'sk_model');
        $this->load->model('tax_employee', 'spk_model');
    }

    public function index($offset = 0) {
        $data['title'] = "Staff";
        $data['message'] = "";
        $data['btn_add'] = anchor('staff/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');
        // offset
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        // load data
        $data['staff'] = $this->staff_model->get_page_list($this->limit, $offset)->result();

        // generate paginate
        $this->load->library('pagination');
        $config['base_url'] = site_url('staff/index/');
        $config['total_rows'] = $this->staff_model->count_all();
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staff/index', $data);
    }

    function add() {
        $data['title'] = 'Add new Staff';
        $data['form_action'] = site_url('staff/save');
        $data['link_back'] = anchor('staff/', 'Back');

        $data['id'] = '';
        $data['staff_nik'] = array('name' => 'staff_nik');
        $data['staff_kode_absen'] = array('name' => 'staff_kode_absen');
        $data['staff_name'] = array('name' => 'staff_name');
        $data['staff_address'] = array('name' => 'staff_address', 'rows' => '6');
        $data['staff_email'] = array('name' => 'staff_email');
        $data['staff_email_alternatif'] = array('name' => 'staff_email_alternatif');
        $data['staff_phone_home'] = array('name' => 'staff_phone_home');
        $data['staff_phone_hp'] = array('name' => 'staff_phone_hp');

        // Status Pajak Karyawan
        $list_spk = $this->spk_model->list_drop();
        $spk_selected = '';
        $data['staff_status_pajak'] = form_dropdown('staff_status_pajak', $list_spk, $spk_selected);

        // Status Nikah
        $list_sn = $this->sn_model->list_drop();
        $sn_selected = '';
        $data['staff_status_nikah'] = form_dropdown('staff_status_nikah', $list_sn, $sn_selected);

        // Status Karyawan
        $list_sk = $this->sk_model->list_drop();
        $sk_selected = '';
        $data['staff_status_karyawan'] = form_dropdown('staff_status_karyawan', $list_sk, $sk_selected);

        // Branch
        $list_branch = $this->branch_model->list_drop();
        $branch_selected = '';
        $data['staff_cabang'] = form_dropdown('staff_cabang', $list_branch, $branch_selected);

        // Departement
        $list_dpt = $this->dept_model->list_drop();
        $dpt_selected = '';
        $data['staff_departement'] = form_dropdown('staff_departement', $list_dpt, $dpt_selected);

        //Jabatan
        $list_jbt = $this->jbt_model->list_drop();
        $jbt_selected = '';
        $data['staff_jabatan'] = form_dropdown('staff_jabatan', $list_jbt, $jbt_selected);


        $data['staff_photo'] = array('name' => 'staff_photo');
        $data['staff_birthdate'] = array('name' => 'staff_birthdate');
        $data['staff_birthplace'] = array('name' => 'staff_birthplace');

        $options_sex = array(
            'Laki' => 'Laki',
            'Perempuan' => 'Perempuan'
        );
        $sex_selected = 'Laki';
        $data['staff_sex'] = form_dropdown('staff_sex', $options_sex, $sex_selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('staff/frm_staff', $data);
    }

    function edit($id) {
        $staff = $this->staff_model->find($id)->row();
        $data['id'] = $staff->staff_id;
        $data['staff_nik'] = array('name' => 'staff_nik', 'value' => $staff->staff_nik);
        $data['staff_kode_absen'] = array('name' => 'staff_kode_absen', 'value' => $staff->staff_kode_absen);
        $data['staff_name'] = array('name' => 'staff_name', 'value' => $staff->staff_name);
        $data['staff_address'] = array('name' => 'staff_address', 'rows' => '6', 'value' => $staff->staff_address);
        $data['staff_email'] = array('name' => 'staff_email', 'value' => $staff->staff_email);
        $data['staff_email_alternatif'] = array('name' => 'staff_email_alternatif', 'value' => $staff->staff_email_alternatif);
        $data['staff_phone_home'] = array('name' => 'staff_phone_home', 'value' => $staff->staff_phone_home);
        $data['staff_phone_hp'] = array('name' => 'staff_phone_hp', 'value' => $staff->staff_phone_hp);

        // Status Pajak Karyawan
        $list_spk = $this->spk_model->list_drop();
        $spk_selected = $staff->staff_status_pajak;
        $data['staff_status_pajak'] = form_dropdown('staff_status_pajak',
                        $list_spk,
                        $spk_selected);

        // Status Nikah
        $list_sn = $this->sn_model->list_drop();
        $sn_selected = $staff->staff_status_nikah;
        $data['staff_status_nikah'] = form_dropdown('staff_status_nikah', $list_sn, $sn_selected);

        // Status Karyawan
        $list_sk = $this->sk_model->list_drop();
        $sk_selected = $staff->staff_status_karyawan;
        $data['staff_status_karyawan'] = form_dropdown('staff_status_karyawan', $list_sk, $sk_selected);

        // Branch
        $list_branch = $this->branch_model->list_drop();
        $branch_selected = $staff->staff_cabang;
        $data['staff_cabang'] = form_dropdown('staff_cabang', $list_branch, $branch_selected);

        // Departement
        $list_dpt = $this->dept_model->list_drop();
        $dpt_selected = $staff->staff_departement;
        $data['staff_departement'] = form_dropdown('staff_departement', $list_dpt, $dpt_selected);

        //Jabatan
        $list_jbt = $this->jbt_model->list_drop();
        $jbt_selected = $staff->staff_jabatan;
        $data['staff_jabatan'] = form_dropdown('staff_jabatan', $list_jbt, $jbt_selected);


        $data['staff_photo'] = array('name' => 'staff_photo', 'value' => $staff->staff_photo);
        $data['staff_birthdate'] = array('name' => 'staff_birthdate', 'value' => $staff->staff_birthdate);
        $data['staff_birthplace'] = array('name' => 'staff_birthplace', 'value' => $staff->staff_birthplace);

        $options_sex = array(
            'Laki' => 'Laki',
            'Perempuan' => 'Perempuan'
        );
        $sex_selected = $staff->staff_sex;
        $data['staff_sex'] = form_dropdown('staff_sex', $options_sex, $sex_selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update Staff';
        $data['message'] = '';
        $data['form_action'] = site_url('staff/update');
        $data['link_back'] = anchor('staff/', 'Back');

        $this->load->view('staff/frm_staff', $data);
    }

    function save() {
        $this->form_validation->set_rules('staff_name', 'staff_name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
        } else {
            $staff = array(
                'staff_nik' => $this->input->post('staff_nik'),
                'staff_kode_absen' => $this->input->post('staff_kode_absen'),
                'staff_name' => $this->input->post('staff_name'),
                'staff_address' => $this->input->post('staff_address'),
                'staff_email' => $this->input->post('staff_email'),
                'staff_email_alternatif' => $this->input->post('staff_email_alternatif'),
                'staff_phone_home' => $this->input->post('staff_phone_home'),
                'staff_phone_hp' => $this->input->post('staff_phone_hp'),
                'staff_status_pajak' => $this->input->post('staff_status_pajak'),
                'staff_status_nikah' => $this->input->post('staff_status_nikah'),
                'staff_status_karyawan' => $this->input->post('staff_status_karyawan'),
                'staff_cabang' => $this->input->post('staff_cabang'),
                'staff_departement' => $this->input->post('staff_departement'),
                'staff_jabatan' => $this->input->post('staff_jabatan'),
                'staff_photo' => $this->input->post('staff_photo'),
                'staff_birthdate' => $this->input->post('staff_birthdate'),
                'staff_birthplace' => $this->input->post('staff_birthplace'),
                'staff_sex' => $this->input->post('staff_sex')
            );
            $this->staff_model->save($staff);

            // set user message
            $data['message'] = '<div class="success">add new staff success</div>';
            redirect('staff/', 'refresh');
        }
    }

    function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('id', 'ID Record', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="error">' . validation_errors() . '</div>');
            redirect('staff/');
        } else {
            $staff = array(
                'staff_nik' => $this->input->post('staff_nik'),
                'staff_kode_absen' => $this->input->post('staff_kode_absen'),
                'staff_name' => $this->input->post('staff_name'),
                'staff_address' => $this->input->post('staff_address'),
                'staff_email' => $this->input->post('staff_email'),
                'staff_email_alternatif' => $this->input->post('staff_email_alternatif'),
                'staff_phone_home' => $this->input->post('staff_phone_home'),
                'staff_phone_hp' => $this->input->post('staff_phone_hp'),
                'staff_status_pajak' => $this->input->post('staff_status_pajak'),
                'staff_status_nikah' => $this->input->post('staff_status_nikah'),
                'staff_status_karyawan' => $this->input->post('staff_status_karyawan'),
                'staff_cabang' => $this->input->post('staff_cabang'),
                'staff_departement' => $this->input->post('staff_departement'),
                'staff_jabatan' => $this->input->post('staff_jabatan'),
                'staff_photo' => $this->input->post('staff_photo'),
                'staff_birthdate' => $this->input->post('staff_birthdate'),
                'staff_birthplace' => $this->input->post('staff_birthplace'),
                'staff_sex' => $this->input->post('staff_sex')
            );

            $this->staff_model->update($id, $staff);
            redirect('staff/');
        }
    }

    function delete($id) {
        $this->staff_model->delete($id);
        redirect('staff/', 'refresh');
    }

}