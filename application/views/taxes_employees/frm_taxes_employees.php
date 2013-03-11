<?php get_header(); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency.all.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('#sp_ptkp').blur(function(){
            $('#sp_ptkp').formatCurrency();
        });
    });
</script>

<div class="wrap">
    <h2>Form Tax Employee</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table width="100%">
        <tr>
            <td width="20%">SP Status</td>
            <td><?php echo form_input($sp_status); ?></td>
        </tr>
        <tr>
            <td width="20%">SP PTKP</td>
            <td><?php echo form_input($sp_ptkp); ?></td>
        </tr>
    </table>
    <?php echo form_submit($btn_save); ?> <?php echo $link_back; ?>
    <?php echo form_close() ?>
</div>
<?php get_footer(); ?>
