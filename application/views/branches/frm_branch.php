<?php get_header(); ?>
<div class="wrap">
    <h2>Form Branch</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    Branch Name
    <?php echo form_input($branch_name); ?>
    <?php echo form_submit($btn_save); ?>
    <?php echo form_close() ?>
    <br>
    <?php echo $link_back; ?>
</div>
<?php get_footer(); ?>