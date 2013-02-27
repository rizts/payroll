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
                <td>Component ID</td>
                <td><?php echo form_input($gaji_component_id); ?></td>
            </tr>
            <tr>
                <td>Gaji Daily</td>
                <td><?php echo form_input($gaji_daily_value); ?></td>
            </tr>
            <tr>
                <td>Gaji Amount</td>
                <td><?php echo form_input($gaji_amount_value); ?></td>
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

