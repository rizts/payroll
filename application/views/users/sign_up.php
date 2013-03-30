<?php get_header(); ?>
<div class="body">
    <div class="content">
        <?php echo $this->session->flashdata('message'); ?>
        <div class="container">            
            <form method="post" class="form-horizontal" action="<?php echo site_url('users/save_user'); ?>" enctype="multipart/form-data">
                <h2 class="form-signin-heading">Form Sign Up</h2>
                <?php echo $staff_id; ?>
                <?php echo $role_id; ?>
                <?php echo form_input($username); ?>
                <?php echo form_password($password); ?>
                <input type="file" name="file" size="20">
                <div class="well">
                    <?php echo form_submit($btn_sign_up); ?>
                </div>
            </form>
        </div> <!-- /container -->
    </div>
</div>
<?php get_footer(); ?>