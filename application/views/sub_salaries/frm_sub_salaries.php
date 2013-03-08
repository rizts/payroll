<?php get_header(); ?>
<script>
    $(document).ready(function() {
        $("#daily").hide();
        $("#salary_component_id").change(function () {
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
    <h2>Form Sub Salaries</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table>
        <tr>
            <td>Salary Component</td>
            <td><?php echo $salary_component_id; ?></td>
        </tr>
        <tr>
            <td>Salary Periode</td>
            <td><?php echo form_input($salary_periode); ?></td>
        </tr>
        <tr id="daily">
            <td>Salary Daily Value</td>
            <td><?php echo form_input($salary_daily_value); ?></td>
        </tr>
        <tr id="yearly">
            <td>Salary Amount Valur</td>
            <td><?php echo form_input($salary_amount_value); ?></td>
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