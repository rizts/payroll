<?php get_header(); ?>

<script type="text/javascript">
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
<div class="body">
    <div class="content">
        <div class="page-header">
            <div class="icon">
                <span class="ico-site-map"></span>
            </div>
            <h1>Setting
                <small>Add new settings</small>
            </h1>
        </div>
        <br class="cl" />
        <?php echo $this->session->flashdata('message'); ?>        
        <?php echo form_open_multipart($form_action) . form_hidden('id', $id); ?>
            <table width="100%">
            <tr>
                <td width="20%">Logo</td>
                <td>
                <div class="one_third">                
                  <div class="form-signin">
                    <?php if($logo ==''){ ?>
                    <img src="<?php echo isset($_POST['logo']) ? assets_url('upload/' . $_POST['logo']) : '' ?>" alt="" id="preview" />
                    <?php }else{ ?>
                    <img src="<?php echo assets_url('upload/' . $logo); ?>" alt="" id="preview" />
                    <?php } ?>
                  </div>
                  <div class="input-append file">
                    <input type="file" name="logo" onchange="readURL(this)" style="display:none;" />
                    <input type="text" style="width:243px"/>
                    <a href="#" class="btn">Browse</a>
                  </div>
                </div>
                </td>
            </tr>
            <tr>
                <td width="20%">Company Name</td>
                <td>
                    <div class="span3"><?php echo form_input($company_name); ?></div>
                </td>
            </tr>            
            <tr>
                <td width="20%" valign="top">Address</td>
                <td>
                    <div class="span3"><?php echo form_textarea($address); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">Phone</td>
                <td>
                    <div class="span3"><?php echo form_input($phone); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">Fax</td>
                <td>
                    <div class="span3"><?php echo form_input($fax); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">Email</td>
                <td>
                    <div class="span3"><?php echo form_input($email); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">City</td>
                <td>
                    <div class="span3"><?php echo form_input($city); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">No NPWP</td>
                <td>
                    <div class="span3"><?php echo form_input($no_npwp); ?></div>
                </td>
            </tr>

        </table>
        <?php echo form_submit($btn_save); ?>
        <?php echo form_close() ?>
    </div>
</div>
<?php get_footer(); ?>
