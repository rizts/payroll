<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staffs extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Staff');
        $this->load->model('Branch');
        $this->load->model('Department');
        $this->load->model('Title');
        $this->load->model('Marital');
        $this->load->model('Employee_Status');
        $this->load->model('Tax_Employee');
        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $staff_list = new Staff();
        $total_rows = $staff_list->count();
        $data['title'] = "Staffs";
        $data['btn_add'] = anchor('staffs/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $staff_list->order_by('staff_name', 'ASC');
        $data['staff_list'] = $staff_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("staffs/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('staffs/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Staff';
        $data['form_action'] = site_url('staffs/save');
        $data['link_back'] = anchor('staffs/', 'Back');

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
        $tax_employee = new Tax_Employee();
        $list_tax = $tax_employee->list_drop();
        $tax_selected = '';
        $data['staff_status_pajak'] = form_dropdown('staff_status_pajak', $list_tax, $tax_selected);

// Status Nikah
        $marital = new Marital();
        $list_ms = $marital->list_drop();
        $ms_selected = '';
        $data['staff_status_nikah'] = form_dropdown('staff_status_nikah', $list_ms, $ms_selected);

// Status Karyawan
        $employee_status = new Employee_Status();
        $list_em = $employee_status->list_drop();
        $em_selected = '';
        $data['staff_status_karyawan'] = form_dropdown('staff_status_karyawan', $list_em, $em_selected);

// Branch
        $branch = new Branch();
        $list_branch = $branch->list_drop();
        $branch_selected = '';
        $data['staff_cabang'] = form_dropdown('staff_cabang', $list_branch, $branch_selected);

// Departement
        $dept = new Department();
        $list_dpt = $dept->list_drop();
        $dpt_selected = '';
        $data['staff_departement'] = form_dropdown('staff_departement', $list_dpt, $dpt_selected);

//Jabatan
        $title = new Title();
        $list_jbt = $title->list_drop();
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

        $this->load->view('staffs/frm_staff', $data);
    }

    function edit($id) {
        $staff = new Staff();
        $rs = $staff->where('staff_id', $id)->get();
        $data['id'] = $rs->staff_id;
        $data['staff_nik'] = array('name' => 'staff_nik', 'value' => $rs->staff_nik);
        $data['staff_kode_absen'] = array('name' => 'staff_kode_absen', 'value' => $rs->staff_kode_absen);
        $data['staff_name'] = array('name' => 'staff_name', 'value' => $rs->staff_name);
        $data['staff_address'] = array('name' => 'staff_address', 'rows' => '6', 'value' => $rs->staff_address);
        $data['staff_email'] = array('name' => 'staff_email', 'value' => $rs->staff_email);
        $data['staff_email_alternatif'] = array('name' => 'staff_email_alternatif', 'value' => $rs->staff_email_alternatif);
        $data['staff_phone_home'] = array('name' => 'staff_phone_home', 'value' => $rs->staff_phone_home);
        $data['staff_phone_hp'] = array('name' => 'staff_phone_hp', 'value' => $rs->staff_phone_hp);

// Status Pajak Karyawan
        $tax_employee = new Tax_Employee();
        $list_spk = $tax_employee->list_drop();
        $spk_selected = $staff->staff_status_pajak;
        $data['staff_status_pajak'] = form_dropdown('staff_status_pajak',
                        $list_spk,
                        $spk_selected);

// Status Nikah
        $marital = new Marital();
        $list_sn = $marital->list_drop();
        $sn_selected = $staff->staff_status_nikah;
        $data['staff_status_nikah'] = form_dropdown('staff_status_nikah',
                        $list_sn,
                        $sn_selected);

// Status Karyawan
        $employee_status = new Employee_Status();
        $list_sk = $employee_status->list_drop();
        $sk_selected = $staff->staff_status_karyawan;
        $data['staff_status_karyawan'] = form_dropdown('staff_status_karyawan',
                        $list_sk,
                        $sk_selected);

// Branch
        $branch = new Branch();
        $list_branch = $branch->list_drop();
        $branch_selected = $staff->staff_cabang;
        $data['staff_cabang'] = form_dropdown('staff_cabang',
                        $list_branch,
                        $branch_selected);

// Departement
        $dept = new Department();
        $list_dpt = $dept->list_drop();
        $dpt_selected = $staff->staff_departement;
        $data['staff_departement'] = form_dropdown('staff_departement',
                        $list_dpt,
                        $dpt_selected);

//Jabatan
        $title = new Title();
        $list_jbt = $title->list_drop();
        $jbt_selected = $staff->staff_jabatan;
        $data['staff_jabatan'] = form_dropdown('staff_jabatan',
                        $list_jbt,
                        $jbt_selected);


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
        $data['form_action'] = site_url('staffs/update');
        $data['link_back'] = anchor('staffs/', 'Back');

        $this->load->view('staffs/frm_staff', $data);
    }

    function save() {
        $staff = new Staff();
        $staff->staff_nik = $this->input->post('staff_nik');
        $staff->staff_kode_absen = $this->input->post('staff_kode_absen');
        $staff->staff_name = $this->input->post('staff_name');
        $staff->staff_address = $this->input->post('staff_address');
        $staff->staff_email = $this->input->post('staff_email');
        $staff->staff_email_alternatif = $this->input->post('staff_email_alternatif');
        $staff->staff_phone_home = $this->input->post('staff_phone_home');
        $staff->taff_phone_hp = $this->input->post('staff_phone_hp');
        $staff->staff_status_pajak = $this->input->post('staff_status_pajak');
        $staff->staff_status_nikah = $this->input->post('staff_status_nikah');
        $staff->staff_status_karyawan = $this->input->post('staff_status_karyawan');
        $staff->staff_cabang = $this->input->post('staff_cabang');
        $staff->staff_departement = $this->input->post('staff_departement');
        $staff->staff_jabatan = $this->input->post('staff_jabatan');
        $staff->staff_photo = $this->input->post('staff_photo');
        $staff->staff_birthdate = $this->input->post('staff_birthdate');
        $staff->staff_birthplace = $this->input->post('staff_birthplace');
        $staff->staff_sex = $this->input->post('staff_sex');

        if ($staff->save()) {
            $this->session->set_flashdata('message', 'Staff successfully created!');
            redirect('staffs/');
        } else {
            // Failed
            $staff->error_message('custom', 'Field required');
            $msg = $staff->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('staffs/add');
        }
    }

    function update() {
        $staff = new Staff();
        $staff->where('staff_id', $this->input->post('id'))
                ->update(array(
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
                        )
        );
        $this->session->set_flashdata('message', 'Staff Update successfuly.');
        redirect('staffs/');
    }

    function delete($id) {
        $this->staff_model->_delete($id);
        redirect('staffs/', 'refresh');
    }

}