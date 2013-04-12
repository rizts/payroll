<?php
class Cuti_model extends CI_Model{
  function get_all(){
    return $this->db->get("cuti");
  }
}
