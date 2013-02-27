<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/application.css"/>
    </head>

    <body>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        <table>
            <tr>
                <td>Staff NIK</td>
                <td><?php echo form_input($staff_nik); ?></td>
            </tr>
            <tr>
                <td>Staff Kode Absen</td>
                <td><?php echo form_input($staff_kode_absen); ?></td>
            </tr>
            <tr>
                <td>Staff Name</td>
                <td><?php echo form_input($staff_name); ?></td>
            </tr>
            <tr>
                <td valign="top">Staff Address</td>
                <td><?php echo form_textarea($staff_address); ?></td>
            </tr>
            <tr>
                <td>Staff Email</td>
                <td><?php echo form_input($staff_email); ?></td>
            </tr>
            <tr>
                <td>Staff Email Alternatif</td>
                <td><?php echo form_input($staff_email_alternatif); ?></td>
            </tr>
            <tr>
                <td>Staff Phone Home</td>
                <td><?php echo form_input($staff_phone_home); ?></td>
            </tr>
            <tr>
                <td>Staff Phone HP</td>
                <td><?php echo form_input($staff_phone_hp); ?></td>
            </tr>
            <tr>
                <td>Status Pajak</td>
                <td><?php echo $staff_status_pajak; ?></td>
            </tr>
            <tr>
                <td>Status Nikah</td>
                <td><?php echo $staff_status_nikah; ?></td>
            </tr>
            <tr>
                <td>Status Karyawan</td>
                <td><?php echo $staff_status_karyawan; ?></td>
            </tr>
            <tr>
                <td>Status Cabang</td>
                <td><?php echo $staff_cabang; ?></td>
            </tr>
            <tr>
                <td>Status Departement</td>
                <td><?php echo $staff_departement; ?></td>
            </tr>
            <tr>
                <td>Status Jabatan</td>
                <td><?php echo $staff_jabatan; ?></td>
            </tr>
            <tr>
                <td>Staff Photo</td>
                <td><?php echo form_input($staff_photo); ?></td>
            </tr>
            <tr>
                <td>Staff Birthdate</td>
                <td><?php echo form_input($staff_birthdate); ?></td>
            </tr>
            <tr>
                <td>Staff Birthplace</td>
                <td><?php echo form_input($staff_birthplace); ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?php echo form_submit($btn_save); ?></td>
            </tr>
        </table>
        <?php echo form_close() ?>
        <br>
        <?php echo $link_back;?>
    </body>

</html>

