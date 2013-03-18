<?php get_header(); ?>
<div class="wrap">
    <div class="container">
        <?php echo $this->session->flashdata('message'); ?>
        <form method="post" class="form-signin" action="<?php echo site_url('users/save_user'); ?>" enctype="multipart/form-data">
            <h2 class="form-signin-heading">Form Sign Up</h2>
            <?php echo $staff_id; ?>
            <?php echo $role_id; ?>
            <?php echo form_input($username); ?>
            <?php echo form_password($password); ?>
            <input type="file" name="file" size="20">
            <?php echo form_submit($btn_sign_up); ?>
        </form>
    </div> <!-- /container -->
</div>
<?php get_footer(); ?>