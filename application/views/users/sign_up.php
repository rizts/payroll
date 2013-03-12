<?php get_header(); ?>
<div class="wrap">
    <div class="container">
        <?php echo $this->session->flashdata('message'); ?>
        <form method="post" class="form-signin" action="<?php echo site_url('users/save'); ?>">
            <h2 class="form-signin-heading">Form Sign Up</h2>
            <?php echo form_input($first_name); ?>
            <?php echo form_input($last_name); ?>
            <?php echo form_input($email); ?>
            <?php echo form_input($username); ?>
            <?php echo form_password($password); ?>
            <?php echo form_password($confirm_password); ?>
            <?php echo form_submit($btn_sign_up) . ' ' . $btn_add; ?>
        </form>
    </div> <!-- /container -->
</div>
<?php get_footer(); ?>