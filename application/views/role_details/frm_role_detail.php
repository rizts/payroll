<?php get_header(); ?>
<script language="javascript">
    function check_all(val) {        
        var checkbox = document.getElementsByName('all_module');

        if ( checkbox.length > 0 ) {            
            if ( val.checked ) {
                $("#module_1").attr('checked', true);
                $("#module_2").attr('checked', true);
                $("#module_3").attr('checked', true);
                $("#module_4").attr('checked', true);
                $("#module_5").attr('checked', true);
                $("#module_6").attr('checked', true);
                $("#module_7").attr('checked', true);
                $("#module_8").attr('checked', true);
                $("#module_9").attr('checked', true);
                $("#module_10").attr('checked', true);
                $("#module_11").attr('checked', true);
                $("#module_12").attr('checked', true);
                $("#module_13").attr('checked', true);
                $("#module_14").attr('checked', true);
                $("#module_15").attr('checked', true);
                $("#module_16").attr('checked', true);
                $("#module_17").attr('checked', true);
            }
            else {
                $("#module_1").attr('checked', false);
                $("#module_2").attr('checked', false);
                $("#module_3").attr('checked', false);
                $("#module_4").attr('checked', false);
                $("#module_5").attr('checked', false);
                $("#module_6").attr('checked', false);
                $("#module_7").attr('checked', false);
                $("#module_8").attr('checked', false);
                $("#module_9").attr('checked', false);
                $("#module_10").attr('checked', false);
                $("#module_11").attr('checked', false);
                $("#module_12").attr('checked', false);
                $("#module_13").attr('checked', false);
                $("#module_14").attr('checked', false);
                $("#module_15").attr('checked', false);
                $("#module_16").attr('checked', false);
                $("#module_17").attr('checked', false);

            }
            
        }
        else {
            if ( val.checked ) {
                checkbox.checked = true;
            }
            else {
                checkbox.checked = false;
            }
        }
    }
</script>
<div style="margin-left: 100px;">
    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open($form_action); ?>
        <div class="row">
            <div class="span6">
                <h3>Form Roled Detail</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="4" align="center">
                                <input type="checkbox" onclick="check_all(this)" name="all_module" id="all_module"/> Roled Module
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <td><?php echo form_checkbox($module_1); ?> Branch</td>
                        <td><?php echo form_checkbox($module_2); ?> Departement</td>
                        <td><?php echo form_checkbox($module_3); ?> Tax Employee</td>
                        <td><?php echo form_checkbox($module_4); ?> Employee Status</td>
                    </tr>
                    <tr>
                        <td><?php echo form_checkbox($module_5); ?> Marital Status</td>
                        <td><?php echo form_checkbox($module_6); ?> Title</td>
                        <td><?php echo form_checkbox($module_7); ?> Component(Gaji)</td>
                        <td><?php echo form_checkbox($module_8); ?> Salary</td>
                    </tr>
                    <tr>
                        <td><?php echo form_checkbox($module_9); ?> Staff</td>
                        <td><?php echo form_checkbox($module_10); ?> Assets</td>
                        <td><?php echo form_checkbox($module_11); ?> Users</td>
                        <td><?php echo form_checkbox($module_12); ?> Roled</td>
                    </tr>
                    <tr>
                        <td><?php echo form_checkbox($module_13); ?> Work Histories</td>
                        <td><?php echo form_checkbox($module_14); ?> Families</td>
                        <td><?php echo form_checkbox($module_15); ?> Educations</td>
                        <td><?php echo form_checkbox($module_16); ?> Medical Histories</td>
                    </tr>
                    <tr>
                        <td><?php echo form_checkbox($module_17); ?> Salary Component</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row-fluid" style="margin-top: 20px;">
            <div class="span6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" align="center">
                                All Privileges
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <td><?php echo form_checkbox($privileges_1); ?> INSERT</td>
                        <td><?php echo form_checkbox($privileges_2); ?> UPDATE</td>
                        <td><?php echo form_checkbox($privileges_3); ?> DELETE</td>
                        <td><?php echo form_checkbox($privileges_4); ?> APPROVAL</td>
                        <td><?php echo form_checkbox($privileges_5); ?> SELECT</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="well-small">
            <?php echo form_submit($btn_save) . ' ' . $link_back; ?>
        </div>
        </form>
    </div>
</div>
<?php get_footer(); ?>
