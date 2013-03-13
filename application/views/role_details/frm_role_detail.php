<?php get_header(); ?>
<script type="text/javascript">
    function check_all(val) {        
        var checkbox = document.getElementsByName('module[]');

        if ( checkbox.length > 0 ) {
            for (i = 0; i < checkbox.length; i++) {
                if ( val.checked ) {
                    checkbox[i].checked = true;                    
                }
                else {
                    checkbox[i].checked = false;
                }
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
<div class="wrap">
    <form action="" method="get">
        <div class="row-fluid">
            <div class="span6">
                <h3>Form Roled Detail</h3>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" align="center">
                                <input type="checkbox" onclick="check_all(this)" name="all_module" id="all_module"/> Roled Module
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <td><input type="checkbox" name="module[]" value="Branches"/> Branch</td>
                        <td><input type="checkbox" name="module[]" value="Departements"/> Departement</td>
                        <td><input type="checkbox" name="module[]" value="Tax_Employees"/> Tax Employee</td>
                        <td><input type="checkbox" name="module[]" value="Employee_Status"/> Employee Status</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="module[]" value="Marital_Status"/> Marital Status</td>
                        <td><input type="checkbox" name="module[]" value="Titles"/> Title</td>
                        <td><input type="checkbox" name="module[]" value="Components"/> Component(Gaji)</td>
                        <td><input type="checkbox" name="module[]" value="Salaries"/> Salary</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="module[]" value="Staffs"/> Staff</td>
                        <td><input type="checkbox" name="module[]" value="Assets"/> Assets</td>
                        <td><input type="checkbox" name="module[]" value="Users"/> Users</td>
                        <td><input type="checkbox" name="module[]" value="Role_Details"/> Roled</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row-fluid" style="margin-top: 20px;">
            <div class="span6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4" align="center">
                                <input type="checkbox" name="all_privileges" id="all_privileges"/> All Privileges
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <td><input type="checkbox" name="privileges1"/> INSERT</td>
                        <td><input type="checkbox" name="privileges2"/> UPDATE</td>
                        <td><input type="checkbox" name="privileges3"/> DELETE</td>
                        <td><input type="checkbox" name="privileges4"/> APPROVAL</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="well-small">
            <?php echo form_submit($btn_save); ?>
        </div>
    </form>
</div>
<?php get_footer(); ?>
