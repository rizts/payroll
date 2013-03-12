<?php get_header(); ?>
<div class="wrap">
    <div class="container">
        <?php echo $this->session->flashdata('message'); ?>
        <form method="post" class="form-signin" action="<?php echo site_url('users/process_login'); ?>">
            <h2 class="form-signin-heading">Please sign in</h2>
            <?php echo form_input($email); ?>
            <?php echo form_password($password); ?>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <?php echo form_submit($btn_sign_in); ?>
        </form>
    </div> <!-- /container -->
</div>
<?php get_footer(); ?>