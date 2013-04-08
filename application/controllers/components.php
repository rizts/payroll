<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Components extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Component');
        $this->sess_username = $this->session->userdata('username');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->sess_staff_id = $this->session->userdata('sess_staff_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $this->filter_access('Component', 'roled_select', base_url());

        $component = new Component();
        switch ($this->input->get('c')) {
            case "1":
                $data['col'] = "comp_name";
                break;
            case "2":
                $data['col'] = "comp_type";
                break;
            case "3":
                $data['col'] = "comp_id";
                break;
            default:
                $data['col'] = "comp_id";
        }

        if ($this->input->get('d') == "1") {
            $data['dir'] = "DESC";
        } else {
            $data['dir'] = "ASC";
        }


        $data['title'] = "Component";
        $data['btn_add'] = anchor('components/add', 'Add New', array("class" => "btn btn-primary"));
        $data['btn_home'] = anchor(base_url(), 'Home');

        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);

        if ($this->input->get('search_by')) {
            $total_rows = $component->like($_GET['search_by'], $_GET['q'])->count();
            $component->like($_GET['search_by'], $_GET['q'])->order_by($data['col'], $data['dir']);
        } else {
            $total_rows = $component->count();
            $component->order_by($data['col'], $data['dir']);
        }


        $data['components'] = $component->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("components/index");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('components/index', $data);
    }

    function add() {
        $this->filter_access('Component', 'roled_add', 'components/index');
        $data['title'] = 'Add New Gaji';
        $data['form_action'] = site_url('components/save');
        $data['link_back'] = anchor('components/', 'Back', array("class" => "btn btn-danger"));

        $options = array(
            'Daily' => 'Daily',
            'Monthly' => 'Monthly',
            'Yearly' => 'Yearly',
        );
        $data['id'] = '';
        $selected = 'Monthly';
        $data['comp_name'] = array('name' => 'comp_name');
        $data['comp_type'] = form_dropdown('comp_type', $options, $selected);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('components/frm_components', $data);
    }

    function edit($id) {
        $this->filter_access('Component', 'roled_edit', 'components/index');
        $component = new Component();
        $rs = $component->where('comp_id', $id)->get();
        $options = array(
            'Daily' => 'Daily',
            'Monthly' => 'Monthly',
            'Yearly' => 'Yearly',
        );
        $selected = $rs->comp_type;
        $data['id'] = $rs->comp_id;
        $data['comp_type'] = form_dropdown('comp_type', $options, $selected);
        $data['comp_name'] = array('name' => 'comp_name', 'value' => $rs->comp_name);
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', 'class' => 'btn btn-primary');

        $data['title'] = 'Update';
        $data['form_action'] = site_url('components/update');
        $data['link_back'] = anchor('components/', 'Back', array("class" => "btn btn-danger"));

        $this->load->view('components/frm_components', $data);
    }

    function save() {
        $this->filter_access('Component', 'roled_add', 'components/index');
        $component = new Component();
        $component->comp_name = $this->input->post('comp_name');
        $component->comp_type = $this->input->post('comp_type');
        if ($component->save()) {
            $this->session->set_flashdata('message', 'Component successfully created!');
            redirect('components/');
        } else {
            // Failed
            $component->error_message('custom', 'Component Name required');
            $msg = $component->error->custom;
            $this->session->set_flashdata('message', $msg);
            redirect('components/add');
        }
    }

    function update() {
        $this->filter_access('Component', 'roled_edit', 'components/index');
        $component = new Component();
        $component->where('comp_id', $this->input->post('id'))
                ->update(array(
                    'comp_name' => $this->input->post('comp_name'),
                    'comp_type' => $this->input->post('comp_type')
                ));

        $this->session->set_flashdata('message', 'Component Update successfuly.');
        redirect('components/');
    }

    function delete($id) {
        $this->filter_access('Component', 'roled_delete', 'components/index');
        $component = new Component();
        $component->_delete($id);

        $this->session->set_flashdata('message', 'Component successfully deleted!');
        redirect('components/');
    }

    function to_excel() {
        $this->load->view('components/to_excel');
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
    
    function get_components(){
      $component = new Component();
      $components = $component->get()->all;
      $data = array();
      $i = 0;
      foreach($components as $x){
        $data[$i]["comp_name"] = $x->comp_name;
        $data[$i]["comp_type"] = $x->comp_type;
        $i++;
      }
      echo json_encode($data);
    }
    
    function get_where_component(){
      $comp = urldecode($this->uri->segment(3));
      $component = new Component();
      $component = $component->where("comp_name", $comp)->get();
      $components = array("comp_type"=>$component->comp_type, "id"=>$component->comp_id);
      echo json_encode($components);
    }

}
