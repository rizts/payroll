<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        <table>
            <tr>
                <td>Education Year</td>
                <td><?php echo form_input($edu_year); ?></td>
            </tr>
            <tr>
                <td>Education Gelar</td>
                <td><?php echo form_input($edu_gelar); ?></td>
            </tr>
            <tr>
                <td>Education Name</td>
                <td><?php echo form_input($edu_name); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo form_submit($btn_save); ?></td>
            </tr>
        </table>     

        <?php echo form_close() ?>
        <br>
        <?php echo $link_back; ?>
    </body>

</html>

