<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assets_Details extends CI_Controller {

    private $limit = 10;
    var $asset_id;
    var $uri_segment;
    var $detail_id;

    function __construct() {
        parent::__construct();
        $this->load->model('Asset');
        $this->load->model('Asset_Detail');
        $this->asset_id = $this->uri->segment(2);
        $this->uri_segment = $this->uri->segment(5);
        $this->detail_id = $this->uri->segment(5);
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $asset_detail = new Asset_Detail();
        $data['staff'] = new Staff();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "date";
                break;
            case "2":
                $data['col'] = "staff_id";
                break;
            case "3":
                $data['col'] = "descriptions";
                break;
            case "4":
                $data['col'] = "assetd_status";
                break;
            case "5":
                $data['col'] = "assetd_id";
                break;
            default:
                $data['col'] = "assetd_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }

        $asset_detail->where('asset_id', $this->asset_id)->order_by($data['col'], $data['dir']);

        $total_rows = $asset_detail->count();
        $data['asset_id'] = $this->asset_id;
        $data['title'] = "Assets Details";
        $data['btn_add'] = anchor('assets/' . $this->asset_id . '/details/add', 'Add New', array('class' => 'btn btn-primary'));
        $data['btn_home'] = anchor('assets/', 'Home', array('class' => 'btn'));

        $offset = $this->uri->segment($this->uri_segment);

        $data['assets_details'] = $asset_detail
                        ->where('asset_id', $this->asset_id)
                        ->order_by($data['col'], $data['dir'])
                        ->get($this->limit, $offset)->all;

        $config['base_url'] = site_url('assets/' . $this->asset_id . '/details/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('assets_details/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Asset';
        $data['form_action'] = site_url('assets/' . $this->asset_id . '/details/save');
        $data['link_back'] = anchor('assets/' . $this->asset_id . '/details/index', 'Back', array('class' => 'btn'));

        $data['id'] = '';
        $data['date'] = array('name' => 'date', 'id' => 'date');

        // Staffs
        $staff = new Staff();
        $list_staff = $staff->list_drop();
        $staff_selected = '';
        $data['staff_id'] = form_dropdown('staff_id', $list_staff, $staff_selected);


        $data['descriptions'] = array('name' => 'descriptions', 'rows' => '6');
        $options_status = array(
            '1' => 'Enable',
            '0' => 'Disable'
        );
        $status_selected = '1';
        $data['assetd_status'] = form_dropdown('assetd_status', $options_status, $status_selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', 'class' => 'btn btn-primary');

        $this->load->view('assets_details/frm_assets_detail', $data);
    }

    function edit() {
        $asset_detail = new Asset_Detail();

        $rs = $asset_detail->where('assetd_id', $this->detail_id)->get();
        $data['id'] = $rs->assetd_id;
        $data['date'] = array('name' => 'date', 'id' => 'date', 'value' => $rs->date);
        $options_status = array(
            '1' => 'Enable',
            '0' => 'Disable'
        );
        $status_selected = $rs->assetd_status;
        $data['assetd_status'] = form_dropdown('assetd_status', $options_status, $status_selected);

        // Staffs
        $staff = new Staff();
        $list_staff = $staff->list_drop();
        $staff_selected = $rs->staff_id;
        $data['staff_id'] = form_dropdown('staff_id', $list_staff, $staff_selected);

        $data['descriptions'] = array('name' => 'descriptions', 'value' => $rs->date);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', 'class' => 'btn btn-primary');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('assets/' . $this->asset_id . '/details/update');
        $data['link_back'] = anchor('assets/', 'Back', array('class' => 'btn'));

        $this->load->view('assets_details/frm_assets_detail', $data);
    }

    function save() {
        $asset_detail = new Asset_Detail();
        $asset_detail->asset_id = $this->asset_id;
        $asset_detail->assetd_status = $this->input->post('assetd_status');
        $asset_detail->staff_id = $this->input->post('staff_id');
        $asset_detail->date = $this->input->post('date');
        $asset_detail->descriptions = $this->input->post('descriptions');
        if ($asset_detail->save()) {
            $this->session->set_flashdata('message', 'Asset detail successfully created!');
            redirect('assets/' . $this->asset_id . '/details/index');
        } else {
            // Failed
            $asset_detail->error_message('custom', 'Field required');
            $msg = $asset_detail->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('assets/' . $this->asset_id . '/details/add');
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
        redirect('assets/' . $this->asset_id . '/details/index');
    }

    function delete() {
        $asset_detail = new Asset_Detail();
        $id = $this->detail_id;
        $asset_detail->_delete($id);

        $this->session->set_flashdata('message', 'Asset detail successfully deleted!');
        redirect('assets/' . $this->asset_id . '/details/index');
    }

}