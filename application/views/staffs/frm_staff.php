<?php get_header(); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency.all.js" type="text/javascript"></script>
<?php echo load_js(array(
  "staff.php?url=".urlencode(site_url())
)); ?>

<?php 
  // load them all
  $component_a = get_component_a($id);
  $component_b = get_component_b($id);
  $family = get_families($id);
  // components A
  $comp_a_data = '';
  if($component_a){
    foreach($component_a->result() as $gaji){
      $component = get_components($gaji->gaji_component_id);
      $comp_a_data .= '["'.$gaji->gaji_component_id.'", "'.$component->comp_name.'", "'.$component->comp_type.'", "'.$gaji->gaji_daily_value.'", "'.number_format($gaji->gaji_amount_value, 2, ".", ",").'"],';
    }
    $comp_a_data = substr($comp_a_data, 0, (strlen($comp_a_data)-1));
  }
  
  
  // components B
  $comp_b_data = '';
  if($component_b){
    foreach($component_b->result() as $gaji){
      $component = get_components($gaji->gaji_component_id);
      $comp_b_data .= '["'.$gaji->gaji_component_id.'", "'.$component->comp_name.'", "'.$component->comp_type.'", "'.$gaji->gaji_daily_value.'", "'.number_format($gaji->gaji_amount_value, 2, ".", ",").'"],';
    }
    $comp_b_data = substr($comp_b_data, 0, (strlen($comp_b_data)-1));
  }
  
  
  // family 
  $families = '';
  if($family){
    foreach($family->result() as $f){
      $families .= '["'.$f->staff_fam_order.'", "'.$f->staff_fam_name.'", "'.$f->staff_fam_birthdate.'", "'.$f->staff_fam_birthplace.'", "'.$f->staff_fam_sex.'", "'.$f->staff_fam_relation.'"],';
    }
    $families = substr($families, 0, (strlen($families)-1));
  }
  
 ?>
<script type="text/javascript">
  var comp_a_data = [<?php echo $comp_a_data; ?>];
  var comp_b_data = [<?php echo $comp_b_data; ?>];
  var family = [<?php echo $families; ?>];
  $(document).ready(function(){
    $("#salary_component_a").handsontable("loadData", comp_a_data);
    $("#salary_component_b").handsontable("loadData", comp_b_data);
    $("#family_table").handsontable("loadData", family);
  });
</script>
<div class="body">
  <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open_multipart($form_action) . form_hidden('id', $id); ?>
    <div class="page-header">
      <div class="icon">
        <span class="ico-coins"></span>
      </div>
      <h1>Staffs
      <small>Manage staffs</small>
      </h1>
    </div>
    <br class="cl" />
    <div class="one_third">
      <h3>Photo</h3>
      <div class="form-signin">
        <img src="<?php echo isset($staff_photo['value']) ? assets_url('upload/' . $staff_photo['value']) : assets_url('images/User-icon.png'); ?>" alt="" id="preview" />
      </div>
      <div class="input-append file">
        <input type="file" name="photo" onchange="readURL(this)" style="display:none;" />
        <input type="text" style="width:243px"/>
        <a href="#" class="btn">Browse</a>
      </div>
    </div>
    <div class="one_third">
      <h3>Basic information</h3>
      <table width="100%">
        <tr>
          <td width="20%">NIK</td>
          <td><div class="span1"><?php echo form_input($staff_nik); ?></div></td>
        </tr>
        <tr>
          <td>Kode Absen</td>
          <td><div class="span1"><?php echo form_input($staff_kode_absen); ?></div></td>
        </tr>
        <tr>
          <td>Name</td>
          <td><div class="span2"><?php echo form_input($staff_name); ?></div></td>
        </tr>
        <tr>
          <td>Birthdate</td>
          <td><div class="span2"><?php echo form_input($staff_birthdate); ?></div></td>
        </tr>
        <tr>
          <td>Birthplace</td>
          <td><div class="span2"><?php echo form_input($staff_birthplace); ?></div></td>
        </tr>

        <tr>
          <td valign="top">Address</td>
          <td><?php echo form_textarea($staff_address); ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><div class="span2"><?php echo form_input($staff_email); ?></div></td>
        </tr>
        <tr>
          <td>Email Alternatif</td>
          <td><div class="span2"><?php echo form_input($staff_email_alternatif); ?></div></td>
        </tr>
        <tr>
          <td>Phone</td>
          <td><div class="span2"><?php echo form_input($staff_phone_home); ?></div></td>
        </tr>
        <tr>
          <td>Mobile</td>
          <td><div class="span2"><?php echo form_input($staff_phone_hp); ?></div></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td><div class="span2"><?php echo $staff_sex; ?></div></td>
        </tr>
      </table>
    </div>
    <div class="one_third lastcolumn">
      <h3>Status</h3>
      <table>
        <tr>
          <td width="40%">Status Pajak</td>
          <td><?php echo $staff_status_pajak; ?></td>
        </tr>
        <tr>
          <td>Status Nikah</td>
          <td><?php echo $staff_status_nikah; ?></td>
        </tr>
        <tr>
          <td>Status Karyawan</td>
          <td><?php echo $staff_status_karyawan; ?></td>
        </tr>
        <tr>
          <td>Status Cabang</td>
          <td><?php echo $staff_cabang; ?></td>
        </tr>
        <tr>
          <td>Status Departement</td>
          <td><?php echo $staff_departement; ?></td>
        </tr>
        <tr>
          <td>Status Jabatan</td>
          <td><?php echo $staff_jabatan; ?></td>
        </tr>
      </table>
    </div>
    <div class="spacer2"></div>
    <!-- tabs -->
    <h3>Histories & Families</h3>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#family" data-toggle="tab">Family</a></li>
      <li><a href="#health" data-toggle="tab">Health</a></li>
      <li><a href="#works" data-toggle="tab">Work</a></li>
    </ul>
    <div class="tab-content" style="overflow: visible">
      <div class="tab-pane active" id="family">
        <div id="family_table"></div>
      </div>
      <div class="tab-pane" id="health">
        <div id="medic_table"></div>
      </div>
      <div class="tab-pane" id="works">
        <div id="works_table"></div>
      </div>
    </div>
    <!-- tabs salary -->
    <h3>Salaries</h3>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#salary_components" data-toggle="tab">Salary Component</a></li>
      <li><a href="#salary_history" data-toggle="tab">Salary History</a></li>
    </ul>
    <div class="tab-content" style="overflow: visible">
      <div class="tab-pane active" id="salary_components">
        <div class="one_half">
          <h5>Component A</h5>
          <div id="salary_component_a"></div>
        </div>
        <div class="one_half lastcolumn">
          <h5>Component B</h5>
          <div id="salary_component_b"></div>
        </div>
      </div>
      <div class="tab-pane" id="salary_history">
        <h5>Salary histories</h5>
        <div id="salary_histories"></div>
      </div>
    </div>
    <br class="cl" />
    <div class="spacer2"></div>
    <div id="families_hidden"></div>
    <div id="medics_hidden"></div>
    <div id="works_hidden"></div>
    <div id="salary_comp_a"></div>
    <div id="salary_comp_b"></div>
    <?php echo form_submit($btn_save); ?> <?php echo $link_back; ?>
    <?php echo form_close() ?>
  </div>
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
</div>
<?php get_footer(); ?>
