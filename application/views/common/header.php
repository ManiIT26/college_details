    

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Mahendra Educational Institutions<?php //echo "Welcome To | ".$get_college['college_name']; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="assets/css/style.css" rel="stylesheet">

    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">
    <link href="assets/css/bootstrap_datepicker.css" rel="stylesheet" type="text/css" media="all">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/themes/all-themes.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/jquery_confirm.css">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

    <script src="assets/js/angular_ui.js"></script>
</head>

<style type="text/css">
	.block-header{
		display:none;
	}
    /*.switch label .lever {
    content: "";
    display: inline-block;
    position: relative;
    width: 90px;
    height: 40px;
    background-color: #818181;
    border-radius: 10px;
    margin-right: 10px;
    transition: background 0.3s ease;
    vertical-align: middle;
    margin: 0 16px;
}*/

/*.switch label .lever:after {
    content: "";
    position: absolute;
    display: inline-block;
    width: 45px;
    height: 45px;
    background-color: #F1F1F1;
    border-radius: 22px;
    box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
    left: 50px;
    top: -3px;
    transition: left 0.3s ease, background .3s ease, box-shadow 0.1s ease;
}*/

.required label:after {
    color: #e32;
    content: ' *';
    display: inline;
}
</style>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>

  
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars">
                    
                </a>
                <a class="navbar-brand" href="index.html" style="font-size: 25px; text-transform:uppercase"> 
					<?php   
					if($get_college['college_name'] == ''){ 
						echo 'Mahendra Admin'; 
					}
					else{ 
						echo $get_college['college_name']; 
					}?>
				</a>
            </div>
			<!--
			<span style="float:right">
				<div class="switch" style="position: relative; top: 24px;"> 
					 <label style="color:#fff">
						Campus 
						<input class="attendance_add" data-toggle="modal"  data-backdrop="static" data-keyboard="false"

						<?php  
						/*
						if(isset($check_attd['attendance_type'])){ 
							if($check_attd['attendance_type'] == 1){
								 echo 'checked'; 
								 $attd_type = 0; 
							}
							else{ 
								$attd_type = 1;
							}
						}
						else{
							$attd_type = 2; 
						} 

						if($holiday != 0){
							echo 'disabled'; 
						}*/
						?>  
						type="checkbox" onClick="add_attendance(<?php echo $this->session->userdata('user_type_id').','.$this->session->userdata('college_id').','.$attd_type; ?>)" > 
						<span class="lever switch-col-amber"></span>
					</label>

					
				</div>
			</span>
			-->
            <div class="collapse collapse-nav navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->

                  
                    <li>
						<a href="javascript:void(0);"  > 
							<?php  if($this->session->userdata('user_type') != 'super_admin' && $this->session->userdata('user_type') != 'college_admin' && $user['staff_attendance_type'] == 1){ ?>
											
											<div class="switch"> 

												 <label>Campus<input class="attendance_add" data-toggle="modal"  data-backdrop="static" data-keyboard="false"

												<?php  if(isset($check_attd['attendance_type'])){ 
															if($check_attd['attendance_type'] == 1){
																 echo 'checked'; $attd_type = 0; 
															}
															else{ 
																$attd_type = 1;
															}
														 }
														else{
														  $attd_type = 2; 
														} 

														if($holiday != 0){

														 echo 'disabled'; 
														} 
												?> 

												type="checkbox" onClick="add_attendance(<?php echo $this->session->userdata('user_type_id').','.$this->session->userdata('college_id').','.$attd_type; ?>)" ><span class="lever switch-col-amber"></span></label>

												
											</div>
										<?php  } ?>

						</a>
					</li>
                     
                    <!-- #END# Call Search -->
                     
                    <!-- <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
                </ul>
            </div>
        </div>
    </nav>




    <div class="modal fade in" id="smallModal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Attendance log</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="attenndance_logout">
                                <div class="form-group">
                                    <label for="password">Log</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick attendance_log" name="attendance_log" required="">
                                            <option value="">-- Please select --</option>
                                            
                                            <?php 
                                                $start_time = date('H:i:s',strtotime('16:30:00'));

                                                $perm_start_time = date('H:i:s',strtotime('15:30:00'));

                                                $curr_time = date('H:i:s');

                                                if(strtotime($start_time) >= strtotime($curr_time)){  ?>

                                            <option value="Emergency">Emergency</option>
                                            <option value="OD">OD</option>
                                                <?php }else{?>

                                                <option value="Logout">Logout</option>
                                                 <?php } if(strtotime($curr_time) >= strtotime($perm_start_time) && strtotime($curr_time) <= strtotime($start_time)){ ?>

                                            <option value="Permission">Permission</option>
                                            <?php   }  ?>
                                        </select>
                                        
                                    </div>
                                     <label id="email-error" class="error" for="email"> </label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" onClick="add_attendance(<?php echo $this->session->userdata('user_type_id').','.$this->session->userdata('college_id').',0'; ?>)">OK</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="close_modal()">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>


    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
			<style>
			
			</style>
            <!-- User Info -->
            <div class="user-info">
                <div class="image" style="border-radius:50% !important;">
                    <?php if($user['profile_image'] != ''){?>
                    <img src="assets/images/staff_profile/<?php echo $user['profile_image']  ?>"  alt="User" />
                    <?php }else{ ?>
                    <img src="assets/images/default.jpg?>" alt="User" /> 
                    <?php } ?>
                </div>
               <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                         <?php if($this->session->userdata('user_type')== 'super_admin'){ ?>
                        <span style="font-weight: bold;font-size: 17px; font-style:normal">Admin<span>
                       <?php }else if($this->session->userdata('user_type') == 'college_admin'){ ?>
                                <span style="font-weight: bold;font-size: 17px; font-style:normal">College Admin<span>
                     <?php  }else if($this->session->userdata('user_type') == 'college_admin_bio'){  ?>
                       <span style="font-weight: bold;font-size: 17px; font-style:normal">Biometric<span>
                        <?php } ?>
						<?php 
						
						echo '<span style="font-weight: bold;font-size: 17px; font-style:normal">'.strtoupper($user['firstname']).' '.strtoupper($user['lastname']). ' - ' .$user['staff_id'].  '</span><br>';
						if(isset($user['role']) && $user['role']!=""){
							echo '( '.ucwords($user['role']).' )';
						}
                         if(isset($user['department_name']) && $user['department_name']!=""){
                            echo '<br>'.ucwords($user['department_name']);
                        }

                        ?>	
                       
					</div>
					
                   <?php /*  <div class="email"><?php echo $user['email_id']  ?></div>

					<div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo base_url().'profile'; ?>"><i class="material-icons">person</i>Profile</a></li>
                             
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo base_url().'logout'; ?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div><?php */?>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
					<!--<li class="header">
						<h5 style="text-align:centers"><?php echo strtoupper($user['firstname']).' '.strtoupper($user['lastname']).'<br>'.strtolower($user['role']); ?></h5>
					</li>-->

                    <li class="active">
                        <a href="<?php echo base_url().'index' ?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <?php if($this->session->userdata('user_type') == 'staff'){ ?>
                    <li class="">
						<a href="<?php echo base_url().'profile'; ?>" >
							<i class="material-icons">person</i>
							<span>My Profile</span>
						</a>
					</li>
                    <?php } ?>
                    <!-- <li>
                        <a href="pages/typography.html">
                            <i class="material-icons">text_fields</i>
                            <span>Typography</span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/helper-classes.html">
                            <i class="material-icons">layers</i>
                            <span>Helper Classes</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Widgets</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Cards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/cards/basic.html">Basic</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/colored.html">Colored</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/cards/no-header.html">No Header</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Infobox</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                                    </li>
                                    <li>
                                        <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->

                     <?php if($this->session->userdata('user_type') != 'staff' &&$this->session->userdata('user_type') != 'college_admin_bio'){ ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">location_city</i>
                            <span>Settings</span>
                        </a>
                        <ul class="ml-menu">

                             <?php if($this->session->userdata('user_type') == 'super_admin'){ ?>
                            <li>
                                <a href="<?php echo base_url().'college_details' ?>">Add College</a>
                            </li>
                            <?php }else if($this->session->userdata('user_type') == 'college_admin'){ ?>
                            <li>
                                <a href="<?php echo base_url().'department_role' ?>">Add Department & Role</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url().'staff_details' ?>">Add Staff Details</a>
                            </li>

                            <li>
                                <a href="<?php echo base_url().'holiday_event' ?>">Add Holidays</a>
                            </li>

                            
                            <?php }?>
                            
                        </ul>
                    </li>
                    <?php } ?>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">tab</i>
                            <span>Attendance <span class="badge" style="background: red;
    color: white;margin: 0px 0 1px 6px;"><?php if($this->common_staff_details->View_approve_req() != 0){ echo $this->common_staff_details->Leave_notification(); }?></span></span>
                        </a>
                        <ul class="ml-menu">
                             <?php if($this->session->userdata('user_type') != 'super_admin' && $this->session->userdata('user_type') != 'college_admin' &&$this->session->userdata('user_type') != 'college_admin_bio'){ ?>   
                            <li>
                                <a href="<?php echo base_url().'leave_apply' ?>">Leave Apply</a>
                            </li>
                            <?php } ?>
                            <?php  if($this->session->userdata('user_type') == 'staff' && $this->common_staff_details->View_approve_req() != 0 &&$this->session->userdata('user_type') != 'college_admin_bio'){ ?> 
                            <li>
                                <a href="<?php echo base_url().'approve_leave' ?>">Approve Leave <span class="badge" style="background: red;
    color: white;margin: 0px 0 1px 6px;"><?php echo $this->common_staff_details->Leave_notification(); ?></span></a>
                            </li>
                             <?php } ?>
                            <?php if($this->session->userdata('user_type') == 'super_admin' || $this->session->userdata('user_type') == 'college_admin' &&$this->session->userdata('user_type') != 'college_admin_bio'){ ?>   
                            <li>
                                <a href="<?php echo base_url().'attendance_log' ?>">Attendance  Log</a>
                                 <a href="<?php echo base_url().'attendance_time_duration' ?>">Time Duration</a>
                            </li>
                            <?php } ?>

                            <?php if($this->session->userdata('user_type') == 'college_admin' || $this->session->userdata('user_type') == 'college_admin_bio'){ ?>     
                            <li>
                                <a href="<?php echo base_url().'bio_metric' ?>">Bio Metrics</a>
                            </li>
                            <?php } ?>

                             <?php if($this->session->userdata('user_type') == 'college_admin'){ ?>   
                            <li>
                                <a href="<?php echo base_url().'attendance_update' ?>">Attendance Update</a>
                            </li>
                             <li>
                                <a href="<?php echo base_url().'leave_update' ?>">Leave Update</a>
                            </li>
                           <?php } ?>
                             
                            
                        </ul>
                    </li>
					 <!--
					<li class="">
                        <a href="<?php echo base_url().'leave_dashboard' ?>">
                            <i class="material-icons">dashboard</i>
                            <span>Leave Dashboard</span>
                        </a>
                    </li>
					-->
                    <li>
                        <a href="<?php echo base_url().'change_password'; ?>">
                            <i class="material-icons">lock_outline</i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo base_url().'logout'; ?>">
                            <i class="material-icons">input</i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Forms</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/forms/basic-form-elements.html">Basic Form Elements</a>
                            </li>
                            <li>
                                <a href="pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-examples.html">Form Examples</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-validation.html">Form Validation</a>
                            </li>
                            <li>
                                <a href="pages/forms/form-wizard.html">Form Wizard</a>
                            </li>
                            <li>
                                <a href="pages/forms/editors.html">Editors</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Tables</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/tables/normal-tables.html">Normal Tables</a>
                            </li>
                            <li>
                                <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                            </li>
                            <li>
                                <a href="pages/tables/editable-table.html">Editable Tables</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">perm_media</i>
                            <span>Medias</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/medias/image-gallery.html">Image Gallery</a>
                            </li>
                            <li>
                                <a href="pages/medias/carousel.html">Carousel</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pie_chart</i>
                            <span>Charts</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/charts/morris.html">Morris</a>
                            </li>
                            <li>
                                <a href="pages/charts/flot.html">Flot</a>
                            </li>
                            <li>
                                <a href="pages/charts/chartjs.html">ChartJS</a>
                            </li>
                            <li>
                                <a href="pages/charts/sparkline.html">Sparkline</a>
                            </li>
                            <li>
                                <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Example Pages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/examples/sign-in.html">Sign In</a>
                            </li>
                            <li>
                                <a href="pages/examples/sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="pages/examples/forgot-password.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="pages/examples/blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="pages/examples/404.html">404 - Not Found</a>
                            </li>
                            <li>
                                <a href="pages/examples/500.html">500 - Server Error</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">map</i>
                            <span>Maps</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/maps/google.html">Google Map</a>
                            </li>
                            <li>
                                <a href="pages/maps/yandex.html">YandexMap</a>
                            </li>
                            <li>
                                <a href="pages/maps/jvectormap.html">jVectorMap</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">trending_down</i>
                            <span>Multi Level Menu</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item - 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 2</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Menu Item</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="menu-toggle">
                                            <span>Level - 3</span>
                                        </a>
                                        <ul class="ml-menu">
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Level - 4</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Changelogs</span>
                        </a>
                    </li>
                    <li class="header">LABELS</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li> -->

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
           <!--  <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div> -->
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

   

    