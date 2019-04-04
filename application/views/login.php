<?php ini_set('max_execution_time', 0); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/themes/all-themes.css" rel="stylesheet" />


    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

<style>
body  {
  background-image: url("<?php echo base_url() ?>assets/images/college.jpg");
  background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
}
</style>

</head>


<!-- <section class="content">
	<div class="container-fluid">
            
		<div class="block-header">
             
        </div>

        <div class="conteiner">
        	<div class="col-sm-6 col-sm-offset-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               
                 <center> <img src = "<?php echo base_url() ?>assets/images/logo.png" width="200px"></center><br>
                        <div class="card">

                        <div class="header">
                            <h2>
                                User Login
                            </h2>
                            
                        </div>
                        <div class="body">

                            <form  method="post"   >  
                                <label for="email_address">Username</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" value="<?php if(isset($usr_name)){ echo $usr_name; } ?>" id="user_name" name="user_name" class="form-control" placeholder="Enter your Username" required>
                                    </div>
                                </div>
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <input type="password" value="<?php if(isset($usr_pass)){ echo $usr_pass; } ?>" id="password" name="usr_password" class="form-control" placeholder="Enter your password" required>
                                    </div>
                                </div>

                                
                                <label for="error_messsage" style="color: red;"><?php if(isset($error)){ echo $error; } ?></label>
                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section> -->


<body class="login-page ls-closed">
    <div class="login-box">
        <div class="logo">
            
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" novalidate="novalidate">
                    <div class="msg">
                    <center> <img src = "<?php echo base_url() ?>assets/images/logo.png" width="150px"></center>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" value="<?php if(isset($usr_name)){ echo $usr_name; } ?>" id="user_name" name="user_name" class="form-control" placeholder="Enter your Username" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <input type="password" value="<?php if(isset($usr_pass)){ echo $usr_pass; } ?>" id="password" name="usr_password" class="form-control" placeholder="Enter your password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                             
                            <label for="error_messsage" style="color: red;"><?php if(isset($error)){ echo $error; } ?></label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <!-- <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

 


</body>

 <script src="assets/js/admin.js"></script>

  <script src="assets/plugins/node-waves/waves.js"></script>

      