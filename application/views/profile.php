<style type="text/css">
.edit_dl_personal > dt {
	padding: 7px;
	font-size: 15px;
	text-align: left;
}
.prof_thumbnail img{
	margin-left:0;
	margin-right:0;
}
</style>

<section class="content">
	<div class="container-fluid">
            
		<div class="block-header">
            <h2>Home</h2>
        </div>

        <div class="conteiner">
			<div class="col-sm-12">
				<div class="card">
					<div class="header">
						<h2>
						   PROFILE                                
						</h2>


						
					</div>
					<div class="body">
						<div class="row">
							<div class="col-sm-12 col-md-12" style="margin-bottom:0;">
								<div class="thumbnail prof_thumbnail" style="border:none; height:100%; max-height:250px; overflow: hidden; margin-bottom:0; margin-right: 30px; float:left">
									<?php 
									if($user['profile_image'] == '') { ?>
										<img src="assets/images/default.jpg" style="width:100%; border: 1px solid #4caf505e;">
										<?php 
									}
									else{ ?>
										<img src="assets/images/staff_profile/<?php echo $user['profile_image']?>" style="width:100%; border: 1px solid #4caf505e;">
										<?php  
									}?>									
								</div>
								<div class="" style="border:none; margin:30px 20px 0; margin-bottom:0; ">
									<h2 style="font-weight:normal; text-transform:capixtalize; color:#03a9f4">
										<?php echo ($user['firstname'].'&nbsp;'.$user['lastname']); ?><br>
										<span style="color:#29c584; font-weight:bold; font-size:17px">
											<?php echo ($user['role']); ?>
										</span> 
										<?php
										if(isset($user['department_name']) && $user['department_name']!=""){?>
											<span style="color:#999; font-weight:normal; font-size:15px">of <?php echo $user['department_name'];?></span>
											<?php
										}?>
									</h2>
									<h5 style="font-weight:normal; color:#03a9f4">
										<span style="color:#777; font-weight:bold; font-size:13px">Employee ID </span>
										<span style="color:#777; font-weight:bold; font-size:17px "><?php echo $user['staff_id'];?></span>
									</h5>									
									<h5 style="font-weight:normal; color:#03a9f4">
										<span style="color:#777; font-weight:normal; font-size:14px; text-transform:capitalize;"><?php echo strtolower($user['college_name']);?></span>
									</h5>
								</div>
							</div>
						</div>
						<br>
						<div class="row clearfix">
							<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
								<div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">
									<div class="panel panel-col-pink">
										<div class="panel-heading" role="tab" id="headingOne_17">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseOne_17" aria-expanded="true" aria-controls="collapseOne_17">
													<i class="material-icons">perm_contact_calendar</i> PERSONAL DETAILS
													
												</a>



											</h4>
										</div>
										<div id="collapseOne_17" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_17">
											<div class="panel-body">
												<div class="col-md-6">
												<dl class="dl-horizontal edit_dl_personal div1" style="display:block">  
													<dt>Name</dt>
													<dd><?php  echo ucwords(strtolower($user['firstname'])).'&nbsp;'.ucwords(strtolower($user['lastname'])); ?></dd>

													<dt>Gender</dt>
													<dd><?php echo ucwords(strtolower($user['gender']));?></dd>

													<dt>DOB</dt>
													<dd><?php echo date("d M Y", strtotime($user['dob']));?></dd>   


													<dt>Email Id</dt>
													<dd><?php echo strtolower($user['email_id']);?></dd>
													

												   
												</dl>

												<dl class="dl-horizontal edit_dl_personal div2" style="display:none">  
													<div class="form-group required">
							                          <label for="password">First Name</label>
							                          <div class="form-line">
							                                <input type="text" value="<?php echo ucwords(strtolower($user['firstname'])); ?>"  id="fname" name="fname" class="form-control"  required>
							                           </div>
							                       	 </div>

							                       	 <div class="form-group required">
							                          <label for="password">Last Name</label>
							                          <div class="form-line">
							                                <input type="text" value="<?php echo ucwords(strtolower($user['lastname'])); ?>"  id="lname" name="lname" class="form-control"  required>
							                           </div>
							                       	 </div>

							                       	 <div class="form-group required">
							                          <label for="password">Gender</label>
							                          <div class="form-line">
							                                <input type="text" value="<?php echo ucwords(strtolower($user['gender'])); ?>"  id="gender" name="gender" class="form-control"  required>
							                           </div>
							                       	 </div>

							                       	 <div class="form-group required">
							                          <label for="password">DOB</label>
							                          <div class="form-line">
							                                <input type="text" value="<?php echo date('Y-m-d', strtotime($user['dob'])) ; ?>"  id="dob" name="dob" class="form-control profile_date_picker"  required>
							                           </div>
							                       	 </div>

							                       	  <div class="form-group required">
							                          <label for="password">Email Id</label>
							                          <div class="form-line">
							                                <input type="text" value="<?php echo ucwords(strtolower($user['email_id'])); ?>"  id="email_id" name="email_id" class=" form-control"  required>
							                           </div>
							                       	 </div>

													</dl>
											</div>

											<div class="col-md-6">
												<dl class="dl-horizontal edit_dl_personal">
													
													<dl class="dl-horizontal edit_dl_personal div1" style="display:block" >
													<dt>Mobile</dt>
													<dd><?php echo $user['mobile_number'];?></dd>

													<dt>Address</dt>
													<dd><?php echo ucwords(strtolower($user['address'])); ?></dd>
													</dl>

													<dl class="dl-horizontal edit_dl_personal div2" style="display:none" >
													
													<div class="form-group required">
						                            <label for="password">Mobile Number</label>
						                            <div class="form-line">
						                                <input type="number" value="<?php echo $user['mobile_number'];?>"  id="mobile_number" name="mobile_number" class="form-control"  required>
						                             </div>
						                        	</div>
						                        	<div class="form-group required">
							                          <label for="password">Address</label>
							                          <div class="form-line">
							                                <input type="text" value="<?php echo ucwords(strtolower($user['address'])); ?>"  id="address" name="address" class="form-control"  required>
							                           </div>
							                       	 </div>

													</dl>

													<dt>College</dt>
													<dd><?php echo ucwords(strtolower($user['college_name']));?></dd>

													<dt>Department</dt>
													<dd><?php echo ucwords($user['department_name']);?></dd>   

												 </dl>
											</div>
												<dl class="dl-horizontal edit_dl_personal div1" style="display:block" >
												<button type="button" class="btn btn-warning pull-right edit" >Edit</button>
												</dl>	
												<dl class="dl-horizontal edit_dl_personal div2" style="display:none" >
												<center><button type="button" class="btn btn-success  " onclick="update_staff(<?php echo $user['staff_id'] ?>)" >Update</button>&nbsp;
												<button type="button" class="btn btn-danger  edit"  onClick="refreshPage()">close</button></center>
												
												
												</dl>	
											</div>
										</div>
									</div>
									<div class="panel panel-col-cyan">
										<div class="panel-heading" role="tab" id="headingTwo_17">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_17" href="#collapseTwo_17" aria-expanded="false" aria-controls="collapseTwo_17">
													<i class="material-icons">check_circle</i>AVILABLE LEAVES     
												</a>
											</h4>
										</div>

										<?php 
										$data1 = $data2 = 0;
										foreach ($leave_count as $key => $value) {
										
										$date = strtotime($value['created_date'] .' -6 months');
										$final=date('Y', $date);
										

										if($final == date('Y'))
										{
											$data1 += 	1;

											
										}else{
											$data2 += 1;
											
										}
											
										}

										
								 	?>

										<div id="collapseTwo_17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_17">
											<div class="panel-body">
												<p><strong>CL</strong> : <?php echo ($user['cl_total'] + $user['cl_last_total']) - $user['cl_taken'];?> <p>

												<p><strong>CCL</strong> : <?php echo ($user['ccl_total'] + $user['ccl_last_total']) - $user['ccl_taken'];?> <p> 

												<p><strong>Current Year CCL Count</strong> : <?php echo $data1 ?> <p> 

												<p><strong>Previous Year CCL Count</strong> :  <?php echo $data2 ?> <p>                                                       
									
											</div>
										</div>
									</div>
								   
								   
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>        	
        </div>
	</div>
</section>


<script type="text/javascript">
$(document).ready(function(){
$(".edit").click(function(){

  $(".div1").hide();
  $(".div2").show();
});
});

function refreshPage(){
    window.location.reload();
} 
</script>

<script type="text/javascript">
  function update_staff(staff_id){

  	

  	var mobile_number = $('input[name="mobile_number"]').val();

  	var address = $('input[name="address"]').val();

  	var fname = $('input[name="fname"]').val();

  	var lname = $('input[name="lname"]').val();
	
	var gender = $('input[name="gender"]').val();

	var dob = $('input[name="dob"]').val();

	var email_id = $('input[name="email_id"]').val();

	if(mobile_number == ''){
		alert('Mobile Number required');
	}else if(address == '')
	{
		alert('Address required');
	}else if(fname == '')
	{
		alert('First Name required');
	}else if(lname == '')
	{
		alert('Last Name required');
	}else if(gender == '')
	{
		alert('Gender required');
	}else if(dob == '')
	{
		alert('DOB required');
	}else if(email_id == '')
	{
		alert('Email Id required');
	}else{

			$.ajax({
            url: 'staff_details/update_staff',
            type: 'POST',
            data:{'staff_id':staff_id,'mobile_number':mobile_number,'address':address,'fname':fname,'lname':lname,'gender':gender,'dob':dob,'email_id':email_id},
         	success: function (data) {
         		//console.log(data);
               alert('Update Successfuly !');
               window.location.replace("profile");

            }
        });

	}

}

    



</script>

