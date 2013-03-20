<?php get_header(); ?>
<div class="wrap">
    <?php echo $breadcrumb; ?>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table>
        <tr>
            <td>Education Year</td>
            <td><?php echo form_input($edu_year); ?></td>
        </tr>
        <tr>
            <td>Education Gelar</td>
            <td><?php echo form_input($edu_gelar); ?></td>
        </tr>
        <tr>
            <td>Education Name</td>
            <td><?php echo form_input($edu_name); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit($btn_save).' '.$link_back; ?></td>
        </tr>
    </table>

    <?php echo form_close() ?>
</div>
<?php get_footer(); ?>

