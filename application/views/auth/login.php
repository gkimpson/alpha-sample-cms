<? /*
<h1>Login</h1>
<p>Please login with your email/username and password below.</p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("admin/auth/login");?>

  <p>
    <label for="identity">Email/Username:</label>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <label for="password">Password:</label>
    <?php echo form_input($password);?>
  </p>

  <p>
    <label for="remember">Remember Me:</label>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', 'Login');?></p>

<?php echo form_close();?>

<p><a href="forgot_password">Forgot your password?</a></p>
*/ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8" />

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/bootstrap/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/fonts/ptsans/stylesheet.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/fonts/icomoon/style.css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/login.css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/mws-theme.css" media="screen" />

<title>CMS Admin - Login Page</title>

</head>

<body>

    <div id="mws-login-wrapper">
        <div id="mws-login">
            <h1>Login</h1>
            <div class="mws-login-lock"><i class="icon-lock"></i></div>
            <div id="mws-login-form">
                <!--<form class="mws-form" action="dashboard.html" method="post">-->
                <form class="mws-form" action="<?= base_url() ?>admin/auth/login" method="post">
                    <div class="mws-form-row">
                        <div class="mws-form-item large">
                            <!-- <input type="text" name="username" class="mws-login-username required" placeholder="username" /> -->
                            <input type="text" name="identity" class="mws-login-username required" placeholder="username" />
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <div class="mws-form-item large">
                            <input type="password" name="password" class="mws-login-password required" placeholder="password" />
                        </div>
                    </div>
                    <div id="mws-login-remember" class="mws-form-row mws-inset">
                        <? /*<ul class="mws-form-list inline">
                            <li>
                                <input id="remember" type="checkbox" />
                                <label for="remember">Remember me</label>
                            </li>
                        </ul> */ ?>
                    </div>
                    <div class="mws-form-row">
                        <input type="submit" value="Login" class="btn btn-success mws-login-button" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript Plugins -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/libs/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/libs/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/custom-plugins/fileinput.js"></script>

    <!-- jQuery-UI Dependent Scripts -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/jui/js/jquery-ui-effects.min.js"></script>

    <!-- Plugin Scripts -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/validate/jquery.validate-min.js"></script>

    <!-- Login Script -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/core/login.js"></script>

</body>
</html>
