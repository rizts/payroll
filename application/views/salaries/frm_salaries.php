<?php get_header(); ?>
<div class="body">
  <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <div class="page-header">
      <div class="icon">
        <span class="ico-coins"></span>
      </div>
      <h1>Salaries
      <small>Manage salaries</small>
      </h1>
    </div>
    <br class="cl" />
    <table width="100%"> 
      <tr>
        <td width="20%">Salary Periode</td>
        <td><?php echo form_input($salary_periode); ?></td>
      </tr>
      <tr>
        <td>Salary Staff</td>
        <td><?php echo form_input($salary_staffid); ?></td>
      </tr>
    </table>
    <?php echo form_submit($btn_save).' '.$link_back; ?>
    <?php echo form_close() ?>
  </div>
</div>
<?php get_footer(); ?>
