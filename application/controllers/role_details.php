<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_Details extends CI_Controller {

    private $limit = 25;
    var $role_id;
    var $uri_segment;
    var $roled_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('Role_Detail');
        $this->role_id = $this->uri->segment(3);
        $this->uri_segment = $this->uri->segment(6);
        $this->roled_id = $this->uri->segment(6);
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index($offset = 0) {
        $role_detail = new Role_Detail();
        $total_rows = $role_detail->where('role_id', $this->role_id)->count();

        $data['title'] = "Role Details";
        $data['role_id'] = $this->role_id;
        $data['btn_add'] = anchor('users/roles/' . $this->role_id . '/role_details/add', 'Add New', "class='btn btn-primary'");
        $data['btn_edit'] = anchor('users/roles/' . $this->role_id . '/role_details/edit', 'Edit', "class='btn btn-primary'");
        $data['link_back'] = anchor('users/roles/', 'Back', array('class' => 'btn'));

        $offset = $this->uri->segment($this->uri_segment);
        $role_detail->where('role_id', $this->role_id)->order_by('roled_id', 'DESC');
        $data['roled_list'] = $role_detail->get($this->limit, $offset)->all;
        $config['base_url'] = site_url('users/roles/' . $this->role_id . '/role_details/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $this->uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('role_details/index', $data);
    }

    function add() {
        $data['title'] = 'Add New Role';
        $data['form_action'] = site_url('users/roles/' . $this->role_id . '/role_details/save');
        $data['link_back'] = anchor('users/roles/' . $this->role_id . '/role_details/index', 'Back', array('class' => 'btn'));

        $data['id'] = '';

        $data['roled_module'] = array('name' => 'roled_module');
    	$roled_list = array();
		$dir_path = APPPATH.'controllers/';
		$exclude_list = array(".", "..", "index.html");
		$directories = array_diff(scandir($dir_path), $exclude_list);
	  	foreach($directories as $entry) {
			if((is_file($dir_path.$entry)) && (substr($entry, -1) != '~')) {
				$module = str_replace('.php','',$entry);								
				$roled_list[$module] = array('module'=>$module,'roled_add'=>1,'roled_edit'=>1,'roled_delete'=>1,'roled_approval'=>1,'roled_select'=>1);
		    }
	  	}
	  	$data['input_type'] = 'insert';
	  	$data['role_id'] = $this->role_id;
		$data['roled_list'] = $roled_list;
        $module_selected = '';
        $data['roled_module'] = form_dropdown('roled', $roled_list, $module_selected);

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('role_details/frm_role_detail', $data);
    }

    function edit() {
        $roled = new Role_Detail();

        $rs = $roled->where('roled_id', $this->roled_id)->get();

		$roled_list = array();
		$dir_path = APPPATH.'controllers/';
		$exclude_list = array(".", "..", "index.html");
		$directories = array_diff(scandir($dir_path), $exclude_list);
	  	foreach($directories as $entry) {
			if((is_file($dir_path.$entry)) && (substr($entry, -1) != '~')) {
				$module = str_replace('.php','',$entry);								
				$roled_list[$module] = array('module'=>$module,'roled_add'=>$roled->get_privileges($this->role_id, 'roled_add', true) == true ? '1' : '0','roled_edit'=>$roled->get_privileges($this->role_id, 'roled_edit', true) == true ? '1' : '0','roled_delete'=>$roled->get_privileges($this->role_id, 'roled_delete', true) == true ? '1' : '0','roled_approval'=>$roled->get_privileges($this->role_id, 'roled_approval', true) == true ? '1' : '0','roled_select'=>$roled->get_privileges($this->role_id, 'roled_select', true) == true ? '1' : '0');
		    }
	  	}
	  	$data['input_type'] = 'update';
	  	$data['role_id'] = $this->role_id;
		$data['roled_list'] = $roled_list;

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', "class" => "btn btn-primary");

        $data['title'] = 'Update Roled';
        $data['form_action'] = site_url('users/roles/' . $this->role_id . '/role_details/update');
        $data['link_back'] = anchor('users/roles/' . $this->role_id . '/role_details/index', 'Back', array("class" => "btn"));

        $this->load->view('role_details/frm_role_detail', $data);
    }

    function save() {
        $roled = new Role_Detail();
        for ($x = 0; $x <= $this->input->post('count'); $x++) {
        	if (!$roled->get_privileges($this->role_id, 'roled_module', $this->input->post('roled_module' . $x))) {
	        	if (isset($_POST['roled_add' . $x]) || isset($_POST['roled_edit' . $x]) || isset($_POST['roled_delete' . $x]) || isset($_POST['roled_approval' . $x]) || isset($_POST['roled_select' . $x])) {
	                $roled->role_id = $this->role_id;
	                $roled->roled_module = $this->input->post('roled_module' . $x);
	                $roled->roled_add = $this->input->post('roled_add' . $x);
	                $roled->roled_edit = $this->input->post('roled_edit' . $x);
	                $roled->roled_delete = $this->input->post('roled_delete' . $x);
	                $roled->roled_approval = $this->input->post('roled_approval' . $x);
	                $roled->roled_select = $this->input->post('roled_select' . $x);
	                $roled->save();
		        }
	        }
        }

        redirect('users/roles/' . $this->role_id . '/role_details/index');
    }

    function update() {
        $roled = new Role_Detail();
        $roled->delete_by_role_id($this->role_id);
        for ($x = 1; $x <= 17; $x++) {
            if (isset($_POST['module_' . $x])) {
                $roled->role_id = $this->role_id;
                $roled->roled_module = $this->input->post('module_' . $x);
                $roled->roled_add = $this->input->post('privileges_1');
                $roled->roled_edit = $this->input->post('privileges_2');
                $roled->roled_delete = $this->input->post('privileges_3');
                $roled->roled_approval = $this->input->post('privileges_4');
                $roled->roled_select = $this->input->post('privileges_5');
                $roled->save();
            }
        }

        $this->session->set_flashdata('message', 'Roled Update successfuly.');
        redirect('users/roles/' . $this->role_id . '/role_details/index');
    }

    function delete($id) {
        $roled = new Role_Detail();
        $roled->_delete($this->roled_id);

        $this->session->set_flashdata('message', 'Roled successfully deleted!');
        redirect('users/roles/' . $this->role_id . '/role_details/index');
    }

    function update_role_value_from_edittable() {
        sleep(1);
        $roled = new Role_Detail();
        $id = $this->input->post('pk');
        $field = $this->input->post('name');
        $value = $this->input->post('value');

        if (!empty($id)) {
            $roled->where('roled_id', $id)->update($field, $value);
        } else {
            header('HTTP 400 Bad Request', true, 400);
            echo "This field is required!";
        }
    }

}
