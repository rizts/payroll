<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    private $limit = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('Setting');
        $this->sess_username = $this->session->userdata('username');
        $this->sess_role_id = $this->session->userdata('sess_role_id');
        $this->sess_staff_id = $this->session->userdata('sess_staff_id');
        $this->session->userdata('logged_in') == true ? '' : redirect('users/sign_in');
    }

    public function index() {
        $setting = new Setting();       
       
        $data['form_action'] = site_url('settings/save');  
        
        $data['logo'] = $setting->get_val('logo');
        $data['company_name'] = array('name' => 'company_name', 'value'=>$setting->get_val('company_name'));
        $data['address'] = array('name' => 'address', 'value'=>$setting->get_val('address'));
        $data['phone'] = array('name' => 'phone', 'value'=>$setting->get_val('phone'));
        $data['fax'] = array('name' => 'fax', 'value'=>$setting->get_val('fax'));
        $data['email'] = array('name' => 'email', 'value'=>$setting->get_val('email'));
        $data['city'] = array('name' => 'city', 'value'=>$setting->get_val('city'));
        $data['no_npwp'] = array('name' => 'no_npwp', 'value'=>$setting->get_val('no_npwp'));
        $data['btn_save'] = array('name' => 'btn_save', 'value' => 'Update', 'class' => 'btn -btn-primary');

        $this->load->view('settings/frm_settings', $data);
    }
    
    public function save(){
        $setting = new Setting();
    if(isset($_POST["btn_save"])){
      $keys = array(
        "company_name","address","phone","fax","email", "city","no_npwp","logo"
      );
      foreach($keys as $k){
        $v = $this->input->post($k);
        $setting->update($k, $v);
      }
      // upload logo routine
      $config['upload_path'] = 'assets/upload';
      $config['allowed_types'] = 'gif|jpg|png|bmp';
      $this->load->library("upload", $config);
      if($this->upload->do_upload("logo")){
        $data = $this->upload->data();
        $setting->update("logo", $data['file_name']);
      }else{
        echo $this->upload->display_errors();
      }
      
      redirect("settings/index");
    }
  }

    function update() {
        $setting = new Setting();

        // upload photo
        $config['upload_path'] = 'assets/upload';
        $config['allowed_types'] = 'gif|jpg|png|bmp';
        $this->load->library("upload", $config);
        if ($this->upload->do_upload("logo")) {
            $data = $this->upload->data();
            //print_r($data["file_name"]);
            //$setting->logo = $data["file_name"];
        } else {
            //print_r($this->upload->display_errors());
        }
        
        $setting->where('id', $this->input->post('id'))
                ->update(array(
                    'logo' => $data["file_name"],
                    'company_name' => $this->input->post('company_name'),
                    'address' => $this->input->post('address'),
                    'phone' => $this->input->post('phone'),
                    'fax' => $this->input->post('fax'),
                    'email' => $this->input->post('email'),
                    'city' => $this->input->post('city'),
                    'no_npwp' => $this->input->post('no_npwp')
                        )
        );

        $this->session->set_flashdata('message', 'Config Update successfuly.');
        redirect('settings/edit/1');
    }

    function delete($id) {
        redirect('settings/edit/1');
        $this->filter_access('Config', 'roled_delete', 'settings/index');

        $setting = new Setting();
        $setting->_delete($id);

        $this->session->set_flashdata('message', 'Config successfully deleted!');
        redirect('settings/');
    }

    function to_excel() {
        $this->load->view('settings/to_excel');
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

}

