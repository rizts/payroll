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
<div class="body">
    <div class="content">
      	<div class="page-header">
      		<div class="icon">
        		<span class="ico-site-map"></span>
      		</div>
	      	<h1>Add Role Detail
	      		<small>Add new role detail</small>
	      	</h1>
    	</div>
    	<br class="cl" />
      	<?php echo $this->session->flashdata('message'); ?>
      	<div class="head blue">
      		<div class="btn-group float-right">
			    <a href="<?php echo base_url('dashboard/index'); ?>" class="btn btn-primary bootstrap-tooltip" data-placement="top" data-title="Back to Dashboard">
			      <span class="icon-home icon-white"></span>
			    </a>
			    <a id="btnAdd" class="btn btn-primary bootstrap-tooltip" data-placement="top" data-title="Add New">
		      	<span class="icon-plus icon-white"></span>
		    	</a>
		  	</div>
		  	<br class="cl" />
        </div>
        <?php echo form_open($form_action); ?>
        <h3>Form Roled Detail</h3>

        <table id="tblRoled" class="table">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Module</th>
                    <th colspan="5">Privilidge</th>
                </tr>
                <tr>
                    <th>Add</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Approval</th>
                    <th>Select</th>
                </tr>
            </thead>
            <?php
            $i=0;
            foreach($roled_list as $row) {
            	$i++;
            ?>
            <tbody id="roleds">
	            <tr>
	            	<td><?=$i;?></td>
	                <td><?php echo form_hidden('roled_module'.$i,$row['module']);form_hidden('input_type'.$i,$input_type);echo $row['module']; ?></td>
	                <td><?php echo form_checkbox('roled_add'.$i,$row['roled_add'],false,'id="roled_add'.$i.'"'); ?></td>
	                <td><?php echo form_checkbox('roled_edit'.$i,$row['roled_edit'],false,'id="roled_edit'.$i.'"'); ?></td>
	                <td><?php echo form_checkbox('roled_delete'.$i,$row['roled_delete'],false,'id="roled_delete'.$i.'"'); ?></td>
	                <td><?php echo form_checkbox('roled_approval'.$i,$row['roled_approval'],false,'id="roled_approval'.$i.'"'); ?></td>
	                <td><?php echo form_checkbox('roled_select'.$i,$row['roled_select'],false,'id="roled_select'.$i.'"'); ?></td>
	            </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <div class="well-small">
        	<input type="hidden" id="count" name="count" value="<?=count($roled_list);?>" />
        	<input type="hidden" id="role_id" name="role_id" value="<?=$role_id;?>" />
            <?php echo form_submit($btn_save) . ' ' . $link_back; ?>
        </div>
        </form>
    </div>
</div>
<?php get_footer(); ?>
