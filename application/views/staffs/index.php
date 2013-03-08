<?php get_header(); ?>
<div class="wrap">
    <h2 class="rama-title">Listing Staff</h2>
    <div class="float-right"><?php echo $btn_add ?></div>
    <?php echo $this->session->flashdata('message'); ?>
    <table class="table boo-table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Staff NIK</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone Home</th>
                <th>Phone HP</th>
                <th>Cabang</th>
                <th>Departement</th>
                <th>Jabatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        foreach ($staff_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->staff_nik; ?></td>
                <td><?php echo $row->staff_name; ?></td>
                <td><?php echo $row->staff_address; ?></td>
                <td><?php echo $row->staff_email; ?></td>
                <td><?php echo $row->staff_phone_home; ?></td>
                <td><?php echo $row->staff_phone_hp; ?></td>
                <td><?php echo $row->staff_cabang; ?></td>
                <td><?php echo $row->staff_departement; ?></td>
                <td><?php echo $row->staff_jabatan; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="#" data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                            <i class="icon-cog"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><?php echo anchor('staffs/' . $row->staff_id . '/families/index', '<i class="icon-user"></i> Family'); ?></li>
                            <li><?php echo anchor('staffs/' . $row->staff_id . '/educations/index', '<i class="icon-book"></i> Education'); ?></li>
                            <li><?php echo anchor('staffs/' . $row->staff_id . '/work_histories/index', '<i class="icon-briefcase"></i> Work'); ?></li>
                            <li><?php echo anchor('staffs/' . $row->staff_id . '/medical_histories/index', '<i class="icon-plus"></i> Medical'); ?></li>
                            <li class="divider"></li>
                            <li><?php echo anchor('staffs/' . $row->staff_id . '/salary_components/index', '<i class="icon-list-alt"></i> Salary Components'); ?></li>
                            <li class="divider"></li>
                            <li><?php echo anchor('staffs/show/' . $row->staff_id, '<i class="icon-zoom-in"></i> Show'); ?></li>
                            <li><?php echo anchor('staffs/edit/' . $row->staff_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                            <li><?php echo anchor('staffs/delete/' . $row->staff_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="clearfix"></div>
    <br>
    <div class="well">
        <div class="row-fluid">
            <div class="span2">
                <?php echo $btn_add . ' ' . $btn_home; ?>
            </div>
            <div class="span10" style="margin-top: -23px;">
                <div class="pagination pagination-right">
                    <ul>
                        <?php echo $pagination; ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>