<?php get_header(); ?>
<div class="wrap">
    <h2>Listing Staff</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <table border="1">
        <tr>
            <td>Staff ID</td>
            <td>Staff NIK</td>
            <td>Staff Kode Absen</td>
            <td>Staff Name</td>
            <td>Staff Address</td>
            <td>Staff Email</td>
            <td>Staff Phone Home</td>
            <td>Staff Phone HP</td>
            <td>Staff Status Karyawan</td>
            <td>Staff Status Cabang</td>
            <td>Staff Status Departement</td>
            <td>Staff Status Jabatan</td>
            <td>Action</td>
        </tr>
        <?php
        foreach ($staff_list as $row) {
        ?>
            <tr>
                <td><?php echo $row->staff_id; ?></td>
                <td><?php echo $row->staff_nik; ?></td>
                <td><?php echo $row->staff_kode_absen; ?></td>
                <td><?php echo $row->staff_name; ?></td>
                <td><?php echo $row->staff_address; ?></td>
                <td><?php echo $row->staff_email; ?></td>
                <td><?php echo $row->staff_phone_home; ?></td>
                <td><?php echo $row->staff_phone_hp; ?></td>
                <td><?php echo $row->staff_status_karyawan; ?></td>
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
                            <li><?php echo anchor('staffs/edit/' . $row->staff_id, '<i class="icon-pencil"></i> Edit'); ?></li>
                            <li><?php echo anchor('staffs/delete/' . $row->staff_id, '<i class="icon-trash"></i> Delete', array('onclick' => "return confirm('Are you sure want to delete?')")); ?></li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <?php echo $pagination; ?>
        <br>
        <br>
    <?php echo $btn_add . " - " . $btn_home; ?>
    <?php get_footer(); ?>