<?php get_header(); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency.all.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#sp_ptkp').blur(function(){
            $('#sp_ptkp').formatCurrency();
        });
    });
</script>

<div class="body">
  <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <div class="page-header">
      <div class="icon">
        <span class="ico-credit"></span>
      </div>
      <h1>Add Tax Status
      <small>Add new tax status</small>
      </h1>
    </div>
    <br class="cl" />
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table width="100%">
        <tr>
          <td width="20%">Status</td>
          <td><div class="span1"><?php echo form_input($sp_status); ?></div></td>
        </tr>
        <tr>
          <td width="20%">Nilai PTKP</td>
          <td><div class="span2 input-prepend">
            <span class="btn">Rp.</span>
            <?php echo form_input($sp_ptkp); ?></div>
          </td>
        </tr>
        <tr>
          <td width="20%">Note</td>
          <td>
            <?php echo form_textarea($sp_note); ?>
          </td>
        </tr>
    </table>
    <?php echo form_submit($btn_save); ?> <?php echo $link_back; ?>
    <?php echo form_close() ?></div>
</div>
<?php get_footer(); ?>
