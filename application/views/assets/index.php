<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Listing Asset</h2>
    <div class="float-right"><?php echo $btn_add ?></div>

    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Asset ID</th>
                <th>Asset Name</th>
                <th>Asset Status</th>
                <th>Staff ID</th>
                <th>Date</th>
                <th width="10"></th>
            </tr>
        </thead>
        <?php
        foreach ($asset_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->asset_id; ?></td>
                <td><?php echo $row->asset_name; ?></td>
                <td><?php echo $row->asset_status; ?></td>
                <td><?php echo $row->staff_id; ?></td>
                <td><?php echo $row->date; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                            Action
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><?php echo anchor('assets/' . $row->asset_id . '/details/add', '<i class="icon-list"></i> Add Detail'); ?></li>
                            <li><?php echo anchor('assets/edit/' . $row->asset_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                            <li><?php echo anchor('assets/delete/' . $row->asset_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
    </div>
<?php get_footer(); ?>
