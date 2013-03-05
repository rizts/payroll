<?php get_header(); ?>
<div class="wrap">
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    Departement Name
    <?php echo form_input($dept_name); ?>
    <?php echo form_submit($btn_save); ?>
    <?php echo form_close() ?>
    <br>
    <?php echo $link_back; ?>
</div>

<?php get_footer(); ?>