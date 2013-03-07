<?php get_header(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#medic_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>

<div class="wrap">
    <h2>Form Medical History</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table>
        <tr>
            <td>Medical Date</td>
            <td><?php echo form_input($medic_date); ?></td>
        </tr>
        <tr>
            <td>Medical Description</td>
            <td><?php echo form_input($medic_description); ?></td>
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