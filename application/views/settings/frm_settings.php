<?php get_header(); ?>
<div class="body">
    <div class="content">
        <div class="page-header">
            <div class="icon">
                <span class="ico-site-map"></span>
            </div>
            <h1>Setting
                <small>Add new settings</small>
            </h1>
        </div>
        <br class="cl" />
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open($form_action) . form_hidden('id', $id); ?>
        <table width="100%">
            <tr>
                <td width="20%">Company Name</td>
                <td>
                    <div class="span3"><?php echo form_input($company_name); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%" valign="top">Address</td>
                <td>
                    <div class="span3"><?php echo form_textarea($address); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">Phone</td>
                <td>
                    <div class="span3"><?php echo form_input($phone); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">Fax</td>
                <td>
                    <div class="span3"><?php echo form_input($fax); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">Email</td>
                <td>
                    <div class="span3"><?php echo form_input($email); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">City</td>
                <td>
                    <div class="span3"><?php echo form_input($city); ?></div>
                </td>
            </tr>
            <tr>
                <td width="20%">No NPWP</td>
                <td>
                    <div class="span3"><?php echo form_input($no_npwp); ?></div>
                </td>
            </tr>

        </table>
        <?php echo form_submit($btn_save); ?>
        <?php echo form_close() ?>
    </div>
</div>
<?php get_footer(); ?>
