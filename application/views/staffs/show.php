<?php get_header(); ?>

<div class="wrap">

    <script>
        $(function () {
            $('#myTab a').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            })
        })
    </script>
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#profile">Profile</a></li>
        <li><a href="#family">Families</a></li>
        <li><a href="#work">Work Histories</a></li>
        <li><a href="#education">Educations</a></li>
        <li><a href="#salary">Salaries</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="profile">
            <table>
                <tr>
                    <td>Staff NIK</td>
                    <td>:</td>
                    <td><?php echo $staff_nik; ?></td>
                </tr>
                <tr>
                    <td>Staff Kode Absen</td>
                    <td>:</td>
                    <td><?php echo $staff_kode_absen; ?></td>
                </tr>
                <tr>
                    <td>Staff Name</td>
                    <td>:</td>
                    <td><?php echo $staff_name; ?></td>
                </tr>
                <tr>
                    <td valign="top">Staff Address</td>
                    <td>:</td>
                    <td><?php echo $staff_address; ?></td>
                </tr>
                <tr>
                    <td>Staff Email</td>
                    <td>:</td>
                    <td><?php echo $staff_email; ?></td>
                </tr>
                <tr>
                    <td>Staff Email Alternatif</td>
                    <td>:</td>
                    <td><?php echo $staff_email_alternatif; ?></td>
                </tr>
                <tr>
                    <td>Staff Phone Home</td>
                    <td>:</td>
                    <td><?php echo $staff_phone_home; ?></td>
                </tr>
                <tr>
                    <td>Staff Phone HP</td>
                    <td>:</td>
                    <td><?php echo $staff_phone_hp; ?></td>
                </tr>
                <tr>
                    <td>Status Pajak</td>
                    <td>:</td>
                    <td><?php echo $staff_status_pajak; ?></td>
                </tr>
                <tr>
                    <td>Status Nikah</td>
                    <td>:</td>
                    <td><?php echo $staff_status_nikah; ?></td>
                </tr>
                <tr>
                    <td>Status Karyawan</td>
                    <td>:</td>
                    <td><?php echo $staff_status_karyawan; ?></td>
                </tr>
                <tr>
                    <td>Status Cabang</td>
                    <td>:</td>
                    <td><?php echo $staff_cabang; ?></td>
                </tr>
                <tr>
                    <td>Status Departement</td>
                    <td>:</td>
                    <td><?php echo $staff_departement; ?></td>
                </tr>
                <tr>
                    <td>Status Jabatan</td>
                    <td>:</td>
                    <td><?php echo $staff_jabatan; ?></td>
                </tr>
                <tr>
                    <td>Staff Photo</td>
                    <td>:</td>
                    <td><?php echo $staff_photo; ?></td>
                </tr>
                <tr>
                    <td>Staff Birthdate</td>
                    <td>:</td>
                    <td><?php echo $staff_birthdate; ?></td>
                </tr>
                <tr>
                    <td>Staff Birthplace</td>
                    <td>:</td>
                    <td><?php echo $staff_birthplace; ?></td>
                </tr>
            </table>
            <?php echo $back; ?>
        </div>
        <div class="tab-pane" id="family">
            <?php
            foreach ($families->family->get() as $family) {
                echo $family->staff_fam_name;
            }
            ?>
        </div>
        <div class="tab-pane" id="work">Work Histories</div>
        <div class="tab-pane" id="education">Educations</div>
        <div class="tab-pane" id="salary">Salaries</div>
    </div>


</div>
<?php get_footer(); ?>