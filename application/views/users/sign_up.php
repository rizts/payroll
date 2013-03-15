<?php get_header(); ?>
<div class="wrap">
    <div class="container">
        <?php echo $this->session->flashdata('message'); ?>
        <form method="post" class="form-signin" action="<?php echo site_url('users/save_user'); ?>">
            <h2 class="form-signin-heading">Form Sign Up</h2>
            <?php echo $staff_id; ?>
            <?php echo $role_id; ?>
            <?php echo form_input($username); ?>
            <?php echo form_password($password); ?>
            <?php echo form_submit($btn_sign_up); ?>
        </form>
    </div> <!-- /container -->
</div>
<?php get_footer(); ?>