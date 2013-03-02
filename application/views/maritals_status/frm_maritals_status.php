<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        Status Nikah
        <?php echo form_input($sn_name); ?>
        <?php echo form_submit($btn_save); ?>
        <?php echo form_close() ?>
        <br>
        <?php echo $link_back;?>
    </body>

</html>

