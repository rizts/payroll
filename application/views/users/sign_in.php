<?php get_header(); ?>
<div class="wrap">
    <div class="container">
        <form class="form-signin" action="<?php echo site_url('users/process_login'); ?>">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input type="text" class="input-block-level" placeholder="Email address">
            <input type="password" class="input-block-level" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-large btn-primary" type="submit">Sign in</button>
        </form>

    </div> <!-- /container -->
</div>
<?php get_footer(); ?>