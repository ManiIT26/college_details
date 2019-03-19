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


</head>
<section class="content">
	<div class="container-fluid">
            
		<div class="block-header">
            <!-- <h2>Login</h2> -->
        </div>

        <div class="conteiner">
        	<div class="col-sm-6 col-sm-offset-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                User Login
                            </h2>
                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
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

                                <!-- <input type="checkbox" id="remember_me" name="remember_me" class="filled-in" >
                                <label for="remember_me">Remember Me</label> -->
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
</section>


 <script src="assets/js/admin.js"></script>

  <script src="assets/plugins/node-waves/waves.js"></script>

      