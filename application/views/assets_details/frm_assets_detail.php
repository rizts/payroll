<?php get_header(); ?>
<div class="wrap">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#date" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>

    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table>
        <tr>
            <td>Date</td>
            <td><?php echo form_input($date); ?></td>
        </tr>
        <tr>
            <td>Staff ID</td>
            <td><?php echo $staff_id; ?></td>
        </tr>
        <tr>
            <td valign="top">Description</td>
            <td><?php echo form_textarea($descriptions); ?></td>
        </tr>
        <tr>
            <td>Asset Detail Status</td>
            <td><?php echo $assetd_status; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit($btn_save); ?></td>
        </tr>
    </table>
    <?php echo form_close() ?>

    <br>
    <?php echo $link_back; ?>
</div>
<?php get_footer(); ?>
