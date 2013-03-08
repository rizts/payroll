<?php get_header(); ?>
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
    });
</script>

<div class="wrap">
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
    <br>
    <?php echo $link_back; ?>
</div>
<?php get_footer(); ?>
