<?php get_header(); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency.all.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#staff_birthdate" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<div class="wrap">
    <h2>Form Staff</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="row">
        <?php echo form_open_multipart($form_action) . form_hidden('id', $id); ?>
        <div class="span3">
            <div class="form-signin">
                <img src="<?php echo isset($staff_photo['value']) ? assets_url('upload/' . $staff_photo['value']) : assets_url('images/User-icon.png'); ?>" alt="" id="preview" />
            </div>
            <input type="file" name="photo" onchange="readURL(this)"/>
        </div>
        <div class="span4">
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
                    <td>Staff Birthdate</td>
                    <td><?php echo form_input($staff_birthdate); ?></td>
                </tr>
                <tr>
                    <td>Staff Birthplace</td>
                    <td><?php echo form_input($staff_birthplace); ?></td>
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
            </table>
        </div>
        <div class="span4">
            <table>
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
                    <td></td>
                    <td><?php echo form_submit($btn_save); ?></td>
                </tr>
            </table>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<?php get_footer(); ?>
