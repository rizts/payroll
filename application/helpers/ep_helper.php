<?php
function assets_url($file=null){
  if($file==null){
    return base_url()."assets";
  }else{
    return base_url()."assets/".$file;
  }
}

function load_css($files=null, $media="all"){
  $out = null;
  $css_url = assets_url()."/css";
  if($files!==null){
    if(is_array($files)){
      foreach($files as $file){
        $url = $css_url."/".$file;
        $out .= '<link rel="stylesheet" type="text/css" href="'.$url.'" media="'.$media.'" />'."\n";
      }
    }else{
      $url = $css_url."/".$files;
      $out = '<link rel="stylesheet" type="text/css" href="'.$url.'" media="'.$media.'" />'."\n";
    }
    
  }
  return $out;
}

function load_js($files=null){
  $out = null;
  $js_url = assets_url()."/js";
  if($files!==null){
    if(is_array($files)){
      foreach($files as $file){
        $url = $js_url."/".$file;
        $out .= '<script type="text/javascript" src="'.$url.'"></script>'."\n";
      }
    }else{
      $url = $js_url."/".$files;
      $out .= '<script type="text/javascript" src="'.$url.'"></script>'."\n";
    }
    
  }
  return $out;
}

function get_header(){
  $ci = &get_instance();
  return $ci->load->view("header");
}

function get_footer(){
  $ci = &get_instance();
  return $ci->load->view("footer");
}

function error_box($content){
  ?>
  <div class="alert alert-error alert-block">
    <i class="icon-alert icon-alert-info"></i>
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Error</strong>
    <span><?php echo $content; ?></span>
  </div>
  <?php
}

function success_box($content){
  ?>
    <div class="alert alert-success alert-block">
      <i class="icon-alert icon-alert-success"></i>
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Success</strong>
      <span><?php echo $content; ?></span>
    </div>
  <?php
  return ob_get_clean();
}

function load_partial($file){
  $html = file_get_contents(BASEPATH."../partials/".$file);
  preg_match_all("/\{(.*)\}/",$html,$matches);
  //print_r($matches);
  for($i=0; $i<count($matches[1]); $i++){
    $val = get_option($matches[1][$i]);
    $html = str_replace("{".$matches[1][$i]."}", $val, $html);
  }
  return $html;
}

function get_option($key){
  $CI = &get_instance();
  $c = $CI->load->model("options_model", "options");
  $opt = $CI->options->get_option($key);
  $opt = $opt->result();
  if(count($opt)>0){
    return (strlen($opt[0]->val) > 0 ? $opt[0]->val:null);
  }else{
    return false;
  }
}

/*
$params = array(
  "id"=>"",
  "title"=>"",
  "content"=>""
)
*/
function tabs($params=array()){
  ob_start();
  ?>
    <ul class="nav nav-tabs">
      <?php $i=0; foreach($params as $param):?>
        <li<?php echo ($i==0? ' class="active"':''); ?>><a href="#<?php echo $param['id']; ?>" data-toggle="tab"><?php echo $param['title']; ?></a></li>
      <?php $i++; endforeach; ?>
    </ul>
    <div class="tab-content">
      <?php $j=0; foreach($params as $param):?>
        <div id="<?php echo $param['id']; ?>" class="tab-pane fade<?php echo ($j==0? ' active in':''); ?>"><?php echo $param['content']; ?></div>
      <?php $j++; endforeach; ?>
    </div>
  <?php
  return ob_get_clean();
}


function dialog_btn($save="Save Changes", $cancel="Cancel"){
  ob_start();
  ?>
  <div style="text-align:right;">
    <input type="submit" name="save" class="btn btn-primary" value="Save Changes"/>
    <a href="javascript:;" class="btn" data-dismiss="modal">Ignore Changes</a>
  </div>
  <?php
  return ob_get_clean();
}


/*
@$results = $db->result();
@$name = field name
@$null_text = null text
@$selected = selected option
@$class = class of it's select tag
*/
function kategori_dropdown($results, $name, $null_text="== Select ==", $selected="", $class=""){
  $dd = a_push_dropdown(array(
    "key"=>"id",
    "value"=>"nama"
  ), $results, $null_text);
  return form_dropdown($name, $dd, $selected, $class);
}

/*
@$results = $db->result();
@$name = field name
@$null_text = null text
@$selected = selected option
@$class = class of it's select tag
*/
function currency_dropdown($results, $name, $null_text="== Select ==", $selected="", $class=""){
  $dd = a_push_dropdown(array(
    "key"=>"id",
    "value"=>"mata_uang"
  ), $results, $null_text);
  return form_dropdown($name, $dd, $selected, $class);
}

/*
array push for drop down, not a stand alone function
*/
function a_push_dropdown($field = array(), $results = array(), $null_text){
  $dd = array();
  $dd[""] = $null_text;
  foreach($results as $row){
    $dd[$row->{$field["key"]}] = $row->{$field["value"]};
  }
  return $dd;
}

function init_paginate($base_url = "#", $total_rows = 5, $per_page = 5){
  $ci = &get_instance();
  $ci->config->load("ep_config");
  $cfg = $ci->config->item("paginate_config");
  $config['base_url'] = $base_url;
  $config['total_rows'] = $total_rows;
  $config['per_page'] = $per_page;
  foreach($cfg as $k=>$v){
    $config[$k] = $v;
  }
  return $config;
}

function header_btn_group($download_url = "#", $add_url = "#"){
  ?>
  <div class="btn-group float-right">
    <a href="<?php echo base_url('dashboard/index'); ?>" class="btn btn-primary bootstrap-tooltip" data-placement="top" data-title="Back to Dashboard">
      <span class="icon-home icon-white"></span>
    </a>
    <a href="<?php echo site_url($download_url); ?>" class="btn btn-primary bootstrap-tooltip" data-placement="top" data-title="Download XLS">
      <span class="icon-download-alt icon-white"></span>
    </a>
    <a href="<?php echo site_url($add_url); ?>" class="btn btn-primary bootstrap-tooltip" data-placement="top" data-title="Add New">
      <span class="icon-plus icon-white"></span>
    </a>
  </div>
  <br class="cl" />
  <?php
}

function search_form($search_by){
  $ci = &get_instance();
  $ci->load->library("session");
  $q = $ci->input->get('q');
  $sb = $ci->input->get('search_by');
  ?>
  <div id="view" class="span2">
    <form action="" method="get" id="view_form">
      <?php echo form_dropdown("perpage", array(
        "10"=>"10",
        "50"=>"50",
        "100"=>"100",
        "250"=>"250",
        "500"=>"500"
      ),$ci->session->userdata("to_page"), 'class="select_perpage" id="select_perpage"'); ?>
      <span id="view_label">to page</span>
    </form>
  </div>
  <div id="search" class="span4">
    <?php
      if(strlen($q) > 0){
        echo anchor(uri_string(), '<span class="ico-remove"></span>', array(
          "class"=>"clear-search bootstrap-tooltip",
          "data-placement"=>"top",
          "data-title"=>"Clear search"
        ));
      }
    ?>
    <form action="" method="get" id="search_form">
      <?php echo form_dropdown("search_by", $search_by, $sb, 'id="search_by" class="search_by"'); ?>
      <input type="text" id="search_input" name="q" value="<?php echo $q; ?>" />
      <input type="submit" name="search" id="search_btn" />
      <br class="cl"/>
    </form>
  </div>
  <?php
}

function btn_action($edit_url = "#", $edit_title = "Untitled", $delete_url = "#"){
  ?>
  <div class="btn-group">
    <a href="<?php echo base_url($edit_url); ?>" class="btn btn-primary bootstrap-tooltip" data-title="Edit">
      <span class="icon-edit icon-white"></span>
    </a>
    <?php echo anchor($delete_url, '<span class="icon-remove icon-white"></span>', array(
      "class"=>"delete btn btn-danger bootstrap-tooltip",
      "data-placement"=>"top",
      "data-title"=>"Delete"
    )); ?>
  </div>
  <?php
}
function get_components($id){
  $ci = &get_instance();
  $result = $ci->db->get("components", array("comp_id"=>$id))->row();
  return $result;
}

?>







