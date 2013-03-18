<?php get_header(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#history_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });   
</script>
<div class="wrap">
    <?php echo $breadcrumb; ?>
    <h2>Form Work History</h2>    
    <?php echo $this->session->flashdata('message'); ?>
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
            <td><?php echo form_submit($btn_save).' '.$link_back; ?></td>
        </tr>
    </table>
    <?php echo form_close() ?>    
</div>
<?php get_footer(); ?>