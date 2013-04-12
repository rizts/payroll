<?php
class Cuti extends CI_Controller{
  private $limit = 10;
  function __construct(){
    parent::__construct();
    $this->load->model("Cuti_model", "cuti");
    $this->load->helper("staff");
  }
  
  function index(){
    switch ($this->input->get('c')) {
      case "1":
          $data['col'] = "staff_id";
          break;
      case "2":
          $data['col'] = "date_request";
          break;
      case "3":
          $data['col'] = "date_start";
          break;
      case "4":
          $data['col'] = "date_end";
          break;
      default:
          $data['col'] = "staff_id";
    }

    if ($this->input->get('d') == "1") {
        $data['dir'] = "DESC";
    } else {
        $data['dir'] = "ASC";
    }
    $total_rows = $this->cuti->get_all()->num_rows();
    $data['title'] = "Izin";
    $data['btn_add'] = anchor('cuti/add', 'Add New', array('class' => 'btn btn-primary'));
    $data['btn_home'] = anchor(base_url(), 'Home', array('class' => 'btn'));

    $uri_segment = 3;
    $offset = $this->uri->segment($uri_segment);
    $data['cuti'] = $this->cuti->get_all();

    $config['base_url'] = site_url("cuti/index");
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $this->limit;
    $config['uri_segment'] = $uri_segment;
    $this->pagination->initialize($config);
    $data['pagination'] = $this->pagination->create_links();
    
    $this->load->view("cuti/index", $data);
  }
  
  function add(){
    $data["staff_id"] = null;
    $data["staff_name"] = array("name"=>"staff_name", "id"=>"staff");
    $data["date_request"] = array("name"=>"date_request", "class"=>"datepicker");
    $data["date_start"] = array("name"=>"date_start", "class"=>"datepicker");
    $data["date_start"] = array("name"=>"date_start", "class"=>"datepicker");
    $this->load->view("cuti/form", $data);
  }
}
