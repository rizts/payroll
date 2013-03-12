<?php get_header(); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency.all.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $("#daily").hide();
        $("#gaji_component_id").change(function () {
            var str = "";
            $("select option:selected").each(function () {
                str += $(this).text() + " ";
                var x = str.indexOf("Daily");
                if(x > -1) {
                    $("#daily").show();
                }else{
                    $("#daily").hide();
                }
            });
        });
        $('#gaji_daily_value').blur(function(){
            $('#gaji_daily_value').formatCurrency();
        });
        $('#gaji_amount_value').blur(function(){
            $('#gaji_amount_value').formatCurrency();
        });

    });
</script>

<div class="wrap">
    <?php echo $breadcrumb; ?>
    <h2>Form Salary Component</h2>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table>
        <tr>
            <td>Component ID</td>
            <td><?php echo $gaji_component_id; ?></td>
        </tr>
        <tr id="daily">
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
</div>
<?php get_footer(); ?>
