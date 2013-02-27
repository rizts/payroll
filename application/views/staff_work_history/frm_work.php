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
                <td>History Date</td>
                <td><?php echo form_input($history_date); ?></td>
            </tr>
            <tr>
                <td>History Description</td>
                <td><?php echo form_input($history_description); ?></td>
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

