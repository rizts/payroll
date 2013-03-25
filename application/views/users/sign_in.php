<!DOCTYPE html>
<html>
  <head>
    <?php echo load_css(array("stylesheets.css")); ?>
  </head>
  <body>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="login">
      <form method="post" class="form-signin" action="<?php echo site_url('users/process_login'); ?>">
      <div class="page-header">
        <div class="icon">
            <span class="ico-arrow-right"></span>
        </div>
        <h1>Login <small>Rama Tours</small></h1>
      </div>
      <div class="row-fluid">
        <div class="row-form">
          <div class="span12">
            <?php echo form_input($username); ?>
          </div>
        </div>
        <div class="row-form">
          <div class="span12">
            <?php echo form_password($password); ?>
          </div>            
        </div>
        <div class="row-form">
          <div class="span12">
            <input type="checkbox" value="remember-me"> Remember me
          </div>
        </div>
        <div class="row-form">
          <div class="span12">
            <button class="btn">Sign in <span class="icon-arrow-next icon-white"></span></button>
          </div>            
        </div>
      </div>
      </form>
    </div>
  </body>
</html>


