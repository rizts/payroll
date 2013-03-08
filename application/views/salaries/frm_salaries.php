<?php get_header(); ?>
<div class="wrap">
    <h2>Form Salaries</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    Salary Periode
    <?php echo form_input($salary_periode); ?>
    Salary Staff
    <?php echo form_input($salary_staffid); ?>
    <?php echo form_submit($btn_save).' '.$link_back; ?>
    <?php echo form_close() ?>
    
</div>
<?php get_footer(); ?>