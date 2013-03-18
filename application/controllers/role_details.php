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
        $total_rows = $role_detail->count();

        $data['title'] = "Role Details";
        $data['role_id'] = $this->role_id;
        $data['btn_add'] = anchor('users/roles/' . $this->role_id . '/role_details/add', 'Add New', "class='btn btn-primary'");
        $data['btn_edit'] = anchor('users/roles/' . $this->role_id . '/role_details/edit', 'Edit', "class='btn btn-primary'");
        $data['link_back'] = anchor('users/roles/', 'Back', array('class' => 'btn'));

        $offset = $this->uri->segment($this->uri_segment);

        $role_detail->where('role_id', $this->role_id)->order_by('roled_id', 'DESC');

        $data['roled_list'] = $role_detail->get($this->limit, $offset)->all;

        $config['base_url'] = site_url("users/roles/' . $this->role_id . '/role_details/add");
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

        $data['module_1'] = array('name' => 'module_1', 'id' => 'module_1', 'value' => 'Branch'); /* Branch */
        $data['module_2'] = array('name' => 'module_2', 'id' => 'module_2', 'value' => 'Departement'); /* Departement */
        $data['module_3'] = array('name' => 'module_3', 'id' => 'module_3', 'value' => 'Tax_Employee'); /* Tax Employee */
        $data['module_4'] = array('name' => 'module_4', 'id' => 'module_4', 'value' => 'Employee_Status'); /* Employee Status */
        $data['module_5'] = array('name' => 'module_5', 'id' => 'module_5', 'value' => 'Marital_Status'); /* Marital Status */
        $data['module_6'] = array('name' => 'module_6', 'id' => 'module_6', 'value' => 'Title'); /* Title */
        $data['module_7'] = array('name' => 'module_7', 'id' => 'module_7', 'value' => 'Component'); /* Component */
        $data['module_8'] = array('name' => 'module_8', 'id' => 'module_8', 'value' => 'Salary'); /* Salary */
        $data['module_9'] = array('name' => 'module_9', 'id' => 'module_9', 'value' => 'Staff'); /* Staff */
        $data['module_10'] = array('name' => 'module_10', 'id' => 'module_10', 'value' => 'Assets'); /* Assets */
        $data['module_11'] = array('name' => 'module_11', 'id' => 'module_11', 'value' => 'Users'); /* User */
        $data['module_12'] = array('name' => 'module_12', 'id' => 'module_12', 'value' => 'Role_Details'); /* Roled */


        $data['privileges_1'] = array('name' => 'privileges_1', 'id' => 'privileges_1', 'value' => '1'); /* INSERT */
        $data['privileges_2'] = array('name' => 'privileges_2', 'id' => 'privileges_2', 'value' => '1'); /* UPDATE */
        $data['privileges_3'] = array('name' => 'privileges_3', 'id' => 'privileges_3', 'value' => '1'); /* DELETE */
        $data['privileges_4'] = array('name' => 'privileges_4', 'id' => 'privileges_4', 'value' => '1'); /* APPROVAL */
        $data['privileges_5'] = array('name' => 'privileges_5', 'id' => 'privileges_5', 'value' => '1'); /* SELECT */

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Save', "class" => "btn btn-primary");

        $this->load->view('role_details/frm_role_detail', $data);
    }

    function edit() {
        $roled = new Role_Detail();

        $rs = $roled->where('roled_id', $this->roled_id)->get();

        $data['module_1'] = array('name' => 'module_1', 'id' => 'module_1', 'value' => 'Branch',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Branch') == true ? 'checked' : ''); /* Branch */
        $data['module_2'] = array('name' => 'module_2', 'id' => 'module_2', 'value' => 'Departement',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Departement') == true ? 'checked' : ''); /* Departement */
        $data['module_3'] = array('name' => 'module_3', 'id' => 'module_3', 'value' => 'Tax_Employee',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Tax_Employee') == true ? 'checked' : ''); /* Tax Employee */
        $data['module_4'] = array('name' => 'module_4', 'id' => 'module_4', 'value' => 'Employee_Status',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Employee_Status') == true ? 'checked' : ''); /* Employee Status */
        $data['module_5'] = array('name' => 'module_5', 'id' => 'module_5', 'value' => 'Marital_Status',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Marital_Status') == true ? 'checked' : ''); /* Marital Status */
        $data['module_6'] = array('name' => 'module_6', 'id' => 'module_6', 'value' => 'Title',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Title') == true ? 'checked' : ''); /* Title */
        $data['module_7'] = array('name' => 'module_7', 'id' => 'module_7', 'value' => 'Component',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Component') == true ? 'checked' : ''); /* Component */
        $data['module_8'] = array('name' => 'module_8', 'id' => 'module_8', 'value' => 'Salary',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Salary') == true ? 'checked' : ''); /* Salary */
        $data['module_9'] = array('name' => 'module_9', 'id' => 'module_9', 'value' => 'Staff',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Staff') == true ? 'checked' : ''); /* Staff */
        $data['module_10'] = array('name' => 'module_10', 'id' => 'module_10', 'value' => 'Assets',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Assets') == true ? 'checked' : ''); /* Assets */
        $data['module_11'] = array('name' => 'module_11', 'id' => 'module_11', 'value' => 'Users',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Users') == true ? 'checked' : ''); /* User */
        $data['module_12'] = array('name' => 'module_12', 'id' => 'module_12', 'value' => 'Role_Details',
            'checked' => $roled->get_privileges($this->role_id, 'roled_module', 'Role_Details') == true ? 'checked' : ''); /* Roled */


        $data['privileges_1'] = array('name' => 'privileges_1', 'id' => 'privileges_1', 'value' => '1',
            'checked' => $roled->get_privileges($this->role_id, 'roled_add', true) == true ? 'checked' : ''); /* INSERT */
        $data['privileges_2'] = array('name' => 'privileges_2', 'id' => 'privileges_2', 'value' => '1',
            'checked' => $roled->get_privileges($this->role_id, 'roled_edit', true) == true ? 'checked' : ''); /* UPDATE */
        $data['privileges_3'] = array('name' => 'privileges_3', 'id' => 'privileges_3', 'value' => '1',
            'checked' => $roled->get_privileges($this->role_id, 'roled_delete', true) == true ? 'checked' : ''); /* DELETE */
        $data['privileges_4'] = array('name' => 'privileges_4', 'id' => 'privileges_4', 'value' => '1',
            'checked' => $roled->get_privileges($this->role_id, 'roled_approval', true) == true ? 'checked' : ''); /* APPROVAL */
        $data['privileges_5'] = array('name' => 'privileges_5', 'id' => 'privileges_5', 'value' => '1',
            'checked' => $roled->get_privileges($this->role_id, 'roled_select', true) == true ? 'checked' : ''); /* APPROVAL */

        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', "class" => "btn btn-primary");

        $data['title'] = 'Update Roled';
        $data['form_action'] = site_url('users/roles/' . $this->role_id . '/role_details/update');
        $data['link_back'] = anchor('users/roles/' . $this->role_id . '/role_details/index', 'Back', array("class" => "btn"));

        $this->load->view('role_details/frm_role_detail', $data);
    }

    function save() {
        $roled = new Role_Detail();
        for ($x = 1; $x <= 12; $x++) {
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

        redirect('users/roles/' . $this->role_id . '/role_details/index');
    }

    function update() {
        $roled = new Role_Detail();
        $roled->delete_by_role_id($this->role_id);
        for ($x = 1; $x <= 12; $x++) {
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

}
