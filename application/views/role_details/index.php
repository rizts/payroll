<?php get_header(); ?>
<link href="<?php echo base_url(); ?>assets/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-editable/js/bootstrap-editable.js"></script>

<script type="text/javascript" language="javascript">
    $(function(){
        //        $.fn.editable.defaults.mode = 'inline';
        $('#username81').editable({ //data-type="text"
            url: '/post',
            type: 'text',
            pk: 1,
            name: 'username',
            title: 'Enter username'
        });
    });
    function edit_row_table(name_id, field, roled_id){
        $('#' + name_id).editable({ //data-type="select"            
            type: 'select',
            name: field,
            pk: roled_id,
            title: 'Enter Role Value',
            source: [
                {value: 1, text: '1'},
                {value: 0, text: '0'}
            ],
            url: '<?php echo site_url(); ?>/role_details/update_role_value_from_edittable/'
        });
    }

</script>

<div class="wrap">
    <h2 class="rama-title">Listing Role Detail</h2>
    <div class="float-right"><?php echo $link_back . ' ' . $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table id="user_role" class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Roled ID</th>
                <th>Roled Module</th>
                <th>Roled Add</th>
                <th>Roled Edit</th>
                <th>Roled Delete</th>
                <th>Roled Approval</th>
                <th>Roled Select</th>
                <!--th width="10%" colspan="2" class="action_cell">Action</th-->
            </tr>
        </thead>
        <?php
        foreach ($roled_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->roled_id; ?></td>
                <td><?php echo $row->roled_module; ?></td>
                <td>
                    <a style="font-size: 15px;" id="roled_add_<?php echo $row->roled_id; ?>" href="#" onclick="edit_row_table('roled_add_<?php echo $row->roled_id; ?>', 'roled_add', <?php echo $row->roled_id; ?>)" class="editable editable-click"><?php echo $row->roled_add; ?></a>
                </td>
                <td>
                    <a style="font-size: 15px;" id="roled_edit_<?php echo $row->roled_id; ?>" href="#" onclick="edit_row_table('roled_edit_<?php echo $row->roled_id; ?>', 'roled_edit', <?php echo $row->roled_id; ?>)" class="editable editable-click"><?php echo $row->roled_edit; ?></a>
                </td>
                <td>
                    <a style="font-size: 15px;" id="roled_delete_<?php echo $row->roled_id; ?>" href="#" onclick="edit_row_table('roled_delete_<?php echo $row->roled_id; ?>', 'roled_delete', <?php echo $row->roled_id; ?>)" class="editable editable-click"><?php echo $row->roled_delete; ?></a>
                </td>
                <td>
                    <a style="font-size: 15px;" id="roled_approval_<?php echo $row->roled_id; ?>" href="#" onclick="edit_row_table('roled_approval_<?php echo $row->roled_id; ?>', 'roled_approval', <?php echo $row->roled_id; ?>)" class="editable editable-click"><?php echo $row->roled_approval; ?></a>
                </td>
                <td>
                    <a style="font-size: 15px;" id="roled_select_<?php echo $row->roled_id; ?>" href="#" onclick="edit_row_table('roled_select_<?php echo $row->roled_id; ?>', 'roled_select', <?php echo $row->roled_id; ?>)" class="editable editable-click"><?php echo $row->roled_select; ?></a>
                </td>
                <!--td class="action_cell"><?php echo anchor('users/roles/' . $role_id . '/role_details/edit/' . $row->roled_id, img(array("src" => assets_url('images/photon/icons/default/edit.png')))); ?></td>
                <td class="action_cell"><?php echo anchor('users/roles/' . $role_id . '/role_details/delete/' . $row->roled_id, img(array("src" => assets_url('images/photon/icons/default/delete-item.png'))), array('onclick' => "return confirm('Are you sure want to delete?')")); ?></td-->
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>