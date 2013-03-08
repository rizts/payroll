<?php get_header(); ?>
<div class="wrap">
    <h2>Form Title</h2>
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table width="100%">
      <tr>
        <td width="20%">Jabatan</td>
        <td><?php echo form_input($title_name); ?></td>
      </tr>
    </table>
    <?php echo form_submit($btn_save); ?> <?php echo $link_back; ?>
    <?php echo form_close() ?>
</div>
<?php get_footer(); ?>
