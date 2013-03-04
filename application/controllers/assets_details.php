<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assets_Details extends CI_Controller {

    private $limit = 10;

    function __construct() {
        parent::__construct();
        $this->load->model('Asset');
        $this->load->model('Asset_Detail');
        $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0) {
        $asset_detail = new Asset_Detail();
        $asset_id = $this->uri->segment(2);
        $asset_detail->where('asset_id', $asset_id)->order_by('date', 'ASC');

        $total_rows = $asset_detail->count();
        $data['title'] = "Assets Details";
        $data['btn_add'] = anchor('assets/' . $this->uri->segment(2) . '/details/add', 'Add New');
        $data['btn_home'] = anchor('assets/', 'Home');

        $uri_segment = 5;
        $offset = $this->uri->segment($uri_segment);

        $data['assets_details'] = $asset_detail
                        ->where('asset_id', $asset_id)
                        ->get($this->limit, $offset)->all;

        $config['base_url'] = site_url('assets/' . $asset_id . '/details/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('assets_details/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Asset';
        $data['form_action'] = site_url('assets/' . $this->uri->segment(2) . '/details/save');
        $data['link_back'] = anchor('assets/' . $this->uri->segment(2) . '/details/index', 'Back');

        $data['id'] = '';
        $data['date'] = array('name' => 'date');
        $data['staff_id'] = array('name' => 'staff_id');
        $data['descriptions'] = array('name' => 'descriptions', 'rows' => '6');
        $options_status = array(
            '1' => 'Enable',
            '0' => 'Disable'
        );
        $status_selected = '1';
        $data['assetd_status'] = form_dropdown('assetd_status', $options_status, $status_selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save');

        $this->load->view('assets_details/frm_assets_detail', $data);
    }

    function edit() {
        $asset_detail = new Asset_Detail();
        $rs = $asset_detail->where('assetd_id', $id)->get();
        $data['id'] = $rs->assetd_id;
        $data['date'] = array('name' => 'date', 'value' => $rs->date);
        $options_status = array(
            '1' => 'Enable',
            '0' => 'Disable'
        );
        $status_selected = $rs->assetd_status;
        $data['assetd_status'] = form_dropdown('assetd_status', $options_status, $status_selected);
        $data['staff_id'] = array('name' => 'staff_id', 'value' => $rs->staff_id);
        $data['descriptions'] = array('name' => 'descriptions', 'value' => $rs->date);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('assets/' . $this->uri->segment(2) . '/details/update');
        $data['link_back'] = anchor('assets/', 'Back');

        $this->load->view('assets/frm_assets_detail', $data);
    }

    function save() {
        $asset_detail = new Asset_Detail();
        $asset_detail->asset_id = $this->uri->segment(2);
        $asset_detail->assetd_status = $this->input->post('assetd_status');
        $asset_detail->staff_id = $this->input->post('staff_id');
        $asset_detail->date = $this->input->post('date');
        $asset_detail->descriptions = $this->input->post('descriptions');
        if ($asset_detail->save()) {
            $this->session->set_flashdata('message', 'Asset detail successfully created!');
            redirect('assets/' . $this->uri->segment(2) . '/details/index');
        } else {
            // Failed
            $asset_detail->error_message('custom', 'Field required');
            $msg = $asset_detail->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('assets/' . $this->uri->segment(2) . '/details/add');
        }
    }

    function update() {
        $asset_detail = new Asset_Detail();
        $asset_detail->where('assetd_id', $this->input->post('id'))
                ->update(array(
                    'date' => $this->input->post('date'),
                    'staff_id' => $this->input->post('staff_id'),
                    'descriptions' => $this->input->post('descriptions'),
                    'assetd_status' => $this->input->post('assetd_status')
                        )
        );

        $this->session->set_flashdata('message', 'Asset detail Update successfuly.');
        redirect('assets/' . $this->uri->segment(2) . '/details/index');
    }

    function delete() {
        $asset_detail = new Asset_Detail();
        $id = $this->uri->segment(5);
        $asset_detail->_delete($id);

        $this->session->set_flashdata('message', 'Asset detail successfully deleted!');
        redirect('assets/' . $this->uri->segment(2) . '/details/index');
    }

}