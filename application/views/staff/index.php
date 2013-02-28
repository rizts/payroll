<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <div>
            <h2>Listing Staff</h2>
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
                    <td>Staff Status Pajak</td>
                    <td>Staff Status Nikah</td>
                    <td>Staff Status Karyawan</td>
                    <td>Staff Status Cabang</td>
                    <td>Staff Status Departement</td>
                    <td>Staff Status Jabatan</td>
                    <td>Action</td>
                </tr>
                <?php
                foreach ($staff as $row) {
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
                        <td><?php echo $row->staff_status_pajak; ?></td>
                        <td><?php echo $row->staff_status_nikah; ?></td>
                        <td><?php echo $row->staff_status_karyawan; ?></td>
                        <td><?php echo $row->staff_cabang; ?></td>
                        <td><?php echo $row->staff_departement; ?></td>
                        <td><?php echo $row->staff_jabatan; ?></td>
                        <td>
                        <?php echo anchor('staff/'.$row->staff_id.'/families/add', 'Family'); ?> |
                        <?php echo anchor('staff/'.$row->staff_id.'/educations/add', 'Education'); ?> |
                        <?php echo anchor('staff/'.$row->staff_id.'/work_histories/add', 'Work'); ?> |
                        <?php echo anchor('staff/'.$row->staff_id.'/medical_histories/add', 'Medical'); ?> |
                        <?php echo anchor('staff/edit/' . $row->staff_id, 'Edit'); ?> |
                        <?php echo anchor('staff/delete/' . $row->staff_id, 'Delete', array('onclick' => "return confirm('Are you sure want to delete this staff?')")); ?>

                    </td>
                </tr>
                <?php } ?>
                </table>
            </div>
            <br>
        <?php echo $pagination; ?>
                    <br>
                    <br>
        <?php echo $btn_add . " - " . $btn_home; ?>
    </body>
</html> 

