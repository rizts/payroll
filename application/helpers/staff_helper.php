<?php
function get_staff_detail($id){
  $ci = &get_instance();
  $ci->load->model("Absensi_model", "absensi");
  return $ci->absensi->get_staff_detail($id)->row();
}
