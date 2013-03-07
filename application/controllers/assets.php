<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assets extends CI_Controller {

    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('Asset');
        $this->load->model('Asset_Detail');
//        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $asset_list = new Asset();
        $total_rows = $asset_list->count();
        $data['title'] = "Assets";
        $data['btn_add'] = anchor('assets/add', 'Add New');
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        $asset_list->order_by('asset_name', 'ASC');
        $data['asset_list'] = $asset_list->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("assets/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('assets/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Asset';
        $data['form_action'] = site_url('assets/save');
        $data['link_back'] = anchor('assets/', 'Back');

        $data['id'] = '';
        $data['asset_name'] = array('name' => 'asset_name');
        $options_status = array(
            '1' => 'Enable',
            '0' => 'Disable'
        );
        $status_selected = '1';
        $data['asset_status'] = form_dropdown('asset_status', $options_status, $status_selected);

        // Staffs
        $staff = new Staff();
        $list_staff = $staff->list_drop();
        $staff_selected = '';
        $data['staff_id'] = form_dropdown('staff_id', $list_staff, $staff_selected);

        $data['date'] = array('name' => 'date');
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('assets/frm_assets', $data);
    }

    function edit($id) {
        $asset = new Asset();
        $rs = $asset->where('asset_id', $id)->get();
        $data['id'] = $rs->asset_id;
        $data['asset_name'] = array('name' => 'asset_name', 'value' => $rs->asset_name);
        $options_status = array(
            '1' => 'Enable',
            '0' => 'Disable'
        );
        $status_selected = $rs->asset_status;
        $data['asset_status'] = form_dropdown('asset_status', $options_status, $status_selected);

                // Staffs
        $staff = new Staff();
        $list_staff = $staff->list_drop();
        $staff_selected = $rs->staff_id;
        $data['staff_id'] = form_dropdown('staff_id', $list_staff, $staff_selected);


        $data['date'] = array('name' => 'date', 'value' => $rs->date);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('assets/update');
        $data['link_back'] = anchor('assets/', 'Back');

        $this->load->view('assets/frm_assets', $data);
    }

    function save() {
        $asset = new Asset();
        $asset->asset_name = $this->input->post('asset_name');
        $asset->asset_status = $this->input->post('asset_status');
        $asset->staff_id = $this->input->post('staff_id');
        $asset->date = $this->input->post('date');
        if ($asset->save()) {
            $this->session->set_flashdata('message', 'Asset successfully created!');
            redirect('assets/');
        } else {
            // Failed
            $asset->error_message('custom', 'Field required');
            $msg = $asset->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('assets/add');
        }
    }

    function update() {
        $asset = new Asset();
        $asset->where('asset_id', $this->input->post('id'))
                ->update(array(
                    'asset_name' => $this->input->post('asset_name'),
                    'asset_status' => $this->input->post('asset_status'),
                    'staff_id' => $this->input->post('staff_id'),
                    'date' => $this->input->post('date')
                        )
        );

        $this->session->set_flashdata('message', 'Asset Update successfuly.');
        redirect('assets/');
    }

    function delete($id) {
        $asset = new Asset();
        $asset->_delete($id);

        $this->session->set_flashdata('message', 'Asset successfully deleted!');
        redirect('assets/');
    }

}