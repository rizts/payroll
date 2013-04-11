<?php
class Absensi extends CI_Controller{
  private $limit = 10;
  function __construct(){
    parent::__construct();
    $this->load->model("Absensi_model", "absensi");
    $this->load->helper("staff");
  }
  
  function index(){
    switch ($this->input->get('c')) {
      case "1":
          $data['col'] = "staff_id";
          break;
      case "2":
          $data['col'] = "date";
          break;
      case "3":
          $data['col'] = "hari_masuk";
          break;
      default:
          $data['col'] = "staff_id";
    }

    if ($this->input->get('d') == "1") {
        $data['dir'] = "DESC";
    } else {
        $data['dir'] = "ASC";
    }
    $total_rows = $this->absensi->get_all()->num_rows();
    $data['title'] = "Absensi";
    $data['btn_add'] = anchor('absensi/add', 'Add New', array('class' => 'btn btn-primary'));
    $data['btn_home'] = anchor(base_url(), 'Home', array('class' => 'btn'));

    $uri_segment = 3;
    $offset = $this->uri->segment($uri_segment);
    $data['absensi'] = $this->absensi->get_all();

    $config['base_url'] = site_url("absensi/index");
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $this->limit;
    $config['uri_segment'] = $uri_segment;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();
    
    $this->load->view("absensi/index", $data);
  }
  
  function get_staff($staff_name){
    $staff = $this->absensi->get_staff("staff_name", $staff_name);
    if($staff){
      echo json_encode($staff->result());
    }
  }
  
  function add(){
    $data["kode_absen"] = array("name"=>"kode_absen", "id"=>"kode_absen");
    $data["staff"] = array("id"=>"staff", "name"=>"staff_name");
    $data["staff_id"] = array("staff_id"=>"");
    $data["date"] = array("name"=>"date", "class"=>"datepicker");
    $data["hari_masuk"] = array("name"=>"hari_masuk");
    $data["form_action"] = "absensi/create";
    $data["id"] = null;
    $this->load->view("absensi/form", $data);
  }
  
  function edit(){
    $data["id"] = $this->uri->segment(3);
    $absensi = $this->absensi->get($data["id"])->row();
    $staff = get_staff_detail($absensi->staff_id);
    $data["kode_absen"] = array("name"=>"kode_absen", "id"=>"kode_absen", "value"=>$staff->staff_kode_absen);
    $data["staff"] = array("id"=>"staff", "name"=>"staff_name", "value"=>$staff->staff_name);
    $data["staff_id"] = array("staff_id"=>$absensi->staff_id);
    $data["date"] = array("name"=>"date", "class"=>"datepicker", "value"=>$absensi->date);
    $data["hari_masuk"] = array("name"=>"hari_masuk", "value"=>$absensi->hari_masuk);
    $data["form_action"] = "absensi/update";
    $this->load->view("absensi/form", $data);
  }
  
  function create(){
    if(!empty($_FILES["csv"]["name"])){ //if uploaded file is not empty
      $config['upload_path'] = 'assets/upload';
      $config['allowed_types'] = 'csv';
      $this->load->library("upload", $config);
      if($this->upload->do_upload("csv")){ // entry from CSV
        $data = $this->upload->data();
        if (($handle = fopen($data["full_path"], "r")) !== FALSE) {
          $fields = array("kode_absen", "staff_name", "hari_masuk");
          while (($data = fgetcsv($handle)) !== FALSE) {
            $num = count($data); // fields count
            $col = array();
            for ($c=0; $c < $num; $c++) {
              $col[$fields[$c]] = $data[$c];
            }
            $this->absensi->add_csv($col);
          }
          fclose($handle);
        }
      }else{
        //print_r($this->upload->display_errors());
      }
    }else{ // manual entry
      $this->form_validation->set_rules(array(
        array("field"=>"staff_name", "label"=>"Staff Name", "rules"=>"required"),
        array("field"=>"kode_absen", "label"=>"Kode Absen", "rules"=>"required"),
        array("field"=>"date", "label"=>"Date", "rules"=>"required"),
        array("field"=>"hari_masuk", "label"=>"Jumlah hari masuk", "rules"=>"required")
      ));
      if($this->form_validation->run()===false){
        // form validation errors
      }else{
        $this->absensi->add();
      }
    }
    redirect("absensi/index");
  }
  
  function update(){
    $this->absensi->update();
    redirect("absensi/index");
  }
  
  
}
