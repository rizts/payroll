<?php get_header(); ?>
<div class="wrap">
    <h3>Form Role</h3>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($action); ?>
    <?php echo form_input($role_name); ?>
    <?php echo form_submit($btn_save); ?>
    <?php echo form_close(); ?>
</div>
<?php get_footer(); ?>