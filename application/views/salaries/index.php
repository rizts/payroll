<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Listing Salaries</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Salary ID</th>
                <th>Salary Periode</th>
                <th>Salary Staff</th>
                <th width="10"></th>
            </tr>
        </thead>
        <?php
        foreach ($salaries as $row) {
        ?>
            <tr>
                <td><?php echo $row->salary_id; ?></td>
                <td><?php echo $row->salary_periode; ?></td>
                <td><?php echo $row->salary_staffid; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                            Action
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><?php echo anchor('salaries/' . $row->salary_id . '/sub_salaries/add', '<i class="icon-list"></i> Add Sub Salaries'); ?></li>
                            <li><?php echo anchor('salaries/edit/' . $row->salary_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                            <li><?php echo anchor('salaries/delete/' . $row->salary_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
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