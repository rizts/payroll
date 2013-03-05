<?php get_header(); ?>
<div class="wrap">
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    Branch Name
    <?php echo form_input($comp_name); ?>
    <?php echo $comp_type; ?>
    <?php echo form_submit($btn_save); ?>
    <?php echo form_close() ?>
    <br>
    <?php echo $link_back; ?>
</div>
<?php get_footer(); ?>