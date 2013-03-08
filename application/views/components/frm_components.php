<?php get_header(); ?>
<div class="wrap">
    <h2>Form Component(Gaji)</h2>
    <?php echo form_open($form_action) . form_hidden('id', $id); ?>
    <table width="100%">
      <tr>
        <td width="20%">Component Name</td>
        <td><?php echo form_input($comp_name); ?></td>
      </tr>
      <tr>
        <td width="20%">Component Type</td>
        <td><?php echo $comp_type; ?></td>
      </tr>
    </table>
    <?php echo form_submit($btn_save); ?> <?php echo $link_back; ?>
    <?php echo form_close() ?>
</div>
<?php get_footer(); ?>
