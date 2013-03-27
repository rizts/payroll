<?php get_header(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        /* Sub Salaries */
        var $container = $("#sub_salaries");
        var $data = $container.handsontable('getData');
        var $console = $("#console_msg");
        var autosaveNotification;
        $container.handsontable({
            colHeaders: ["Salari Periode", "Salary Daily Value", "Salary Amount Value"],
            startCols: 3,
            startRows: 3,
            colWidths: [50, 100, 100],
            columns: [
                {
                    type:'date'
                },
                {
                    type: 'numeric',
                    format: '0,0.00'
                },
                {
                    type: 'numeric',
                    format: '0,0.00'
                }
            ],
            onChange: function (e, change, source) {
                console.log("id of the grid:", $(this).attr('id'));
            }
        });
    });
</script>
<div class="body">
    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        <div class="page-header">
            <div class="icon">
                <span class="ico-coins"></span>
            </div>
            <h1>Salaries
                <small>Manage salaries</small>
            </h1>
        </div>
        <br class="cl" />
        <table width="100%">
            <tr>
                <td width="20%">Salary Periode</td>
                <td><?php echo form_input($salary_periode); ?></td>
            </tr>
            <tr>
                <td>Salary Staff</td>
                <td><?php echo form_input($salary_staffid); ?></td>
            </tr>
        </table>
        <?php echo form_submit($btn_save) . ' ' . $link_back; ?>
        <?php echo form_close() ?>


        <div id="console_msg"></div>
        <div id="sub_salaries" class="dataTable"></div>
    </div>
</div>
<?php get_footer(); ?>
