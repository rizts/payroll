<?php get_header(); ?>
<div class="body">
  <div class="content">
    <div class="page-header">
      <div class="icon">
        <span class="ico-globe-2"></span>
      </div>
      <h1>Add Department
      <small>Add new department</small>
      </h1>
    </div>   
    <br class="cl" />
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table width="100%">
      <tr>
        <td width="20%">Departement Name</td>
        <td><div class="span3"><?php echo form_input($dept_name); ?></div></td>
      </tr>
    </table>
    <?php echo form_submit($btn_save); ?> <?php echo $link_back; ?>
    <?php echo form_close() ?></div>
</div>

<?php get_footer(); ?>
