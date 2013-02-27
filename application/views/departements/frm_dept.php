<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        Departement Name
        <?php echo form_input($dept_name); ?>
        <?php echo form_submit($btn_save); ?>
        <?php echo form_close() ?>
        <br>
        <?php echo $link_back;?>
    </body>

</html>

