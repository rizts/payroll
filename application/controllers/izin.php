<?php
class Izin extends CI_Controller{
  private $limit = 10;
  function __construct(){
    parent::__construct();
    $this->load->model("Izin_model", "izin");
    $this->load->helper("staff");
  }
  
  function index(){
    switch ($this->input->get('c')) {
      case "1":
          $data['col'] = "izin_staff_id";
          break;
      case "2":
          $data['col'] = "izin_date";
          break;
      case "3":
          $data['col'] = "izin_jumlah_hari";
          break;
      default:
          $data['col'] = "izin_staff_id";
    }

    if ($this->input->get('d') == "1") {
        $data['dir'] = "DESC";
    } else {
        $data['dir'] = "ASC";
    }
    $total_rows = $this->izin->get_all()->num_rows();
    $data['title'] = "Izin";
    $data['btn_add'] = anchor('izin/add', 'Add New', array('class' => 'btn btn-primary'));
    $data['btn_home'] = anchor(base_url(), 'Home', array('class' => 'btn'));

    $uri_segment = 3;
    $offset = $this->uri->segment($uri_segment);
    $data['izin'] = $this->izin->get_all();

    $config['base_url'] = site_url("izin/index");
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $this->limit;
    $config['uri_segment'] = $uri_segment;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();
    
    $this->load->view("izin/index", $data);
  }
  
  function add(){
    $data["izin_staff"] = array("id"=>"staff", "name"=>"izin_staff");
    $data["izin_date"] = array("name"=>"izin_date", "class"=>"datepicker");
    $data["izin_jumlah_hari"] = array("name"=>"izin_jumlah_hari");
    $data["izin_note"] = array("name"=>"izin_note", "id"=>"izin_note");
    $data["form_action"] = "izin/create";
    $data["id"] = null;
    $data["izin_staff_id"] = null;
    $this->load->view("izin/form", $data);
  }
  
  function edit(){
    $data["id"] = $this->uri->segment(3);
    $izin = $this->izin->get($data["id"])->row();
    $staff = get_staff_detail($izin->izin_staff_id);
    $data["izin_staff"] = array("id"=>"staff", "name"=>"izin_staff", "value"=>$staff->staff_name);
    $data["izin_date"] = array("name"=>"izin_date", "class"=>"datepicker", "value"=>$izin->izin_date);
    $data["izin_jumlah_hari"] = array("name"=>"izin_jumlah_hari", "value"=>$izin->izin_jumlah_hari);
    $data["izin_note"] = array("name"=>"izin_note", "id"=>"izin_note", "value"=>$izin->izin_note);
    $data["izin_staff_id"] = $izin->izin_staff_id;
    $data["form_action"] = "izin/update";
    $this->load->view("izin/form", $data);
  }
  
  function create(){
    $this->form_validation->set_rules(array(
      array("field"=>"izin_staff", "label"=>"Staff Name", "rules"=>"required"),
      array("field"=>"izin_date", "label"=>"Tanggal izin", "rules"=>"required"),
      array("field"=>"izin_jumlah_hari", "label"=>"Jumlah hari izin", "rules"=>"required")
    ));
    if($this->form_validation->run()===false){
      echo "false";
    }else{
      $this->izin->add();
    }
    redirect("izin/index");
  }
  
  function update(){
    $this->form_validation->set_rules(array(
      array("field"=>"izin_staff", "label"=>"Staff Name", "rules"=>"required"),
      array("field"=>"izin_date", "label"=>"Tanggal izin", "rules"=>"required"),
      array("field"=>"izin_jumlah_hari", "label"=>"Jumlah hari izin", "rules"=>"required")
    ));
    if($this->form_validation->run()===false){
      echo "false";
    }else{
      $this->izin->update();
    }
    redirect("izin/index");
  }
  
  function delete(){
    $id = $this->uri->segment(3);
    $this->db->delete("izin", array("izin_id"=>$id));
    redirect("izin/index");
  }
  
}
