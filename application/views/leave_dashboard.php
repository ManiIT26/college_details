<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='assets/js/fullcalendar.js'></script>
<script>

	$(document).ready(function() {
	   /* var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();


		 
		  
	 
	
		$('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});
	
	
		 
		
		var calendar =  $('#calendar').fullCalendar({
			header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',
			
			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
			allDaySlot: false,
			selectHelper: true,
			 
			select: function(start, end, allDay) {
				//alert('->'+start+','+end+','+allDay+'<-');
				var date2 = new Date(end);
				var d2 = date2.getDate();
				var m2 = date2.getMonth() + 1;
				var y2 = date2.getFullYear();

				 
				var click_date = y2+'-'+m2+'-'+d2;	

				window.location.replace("leave_dashboard?leave_date="+click_date);

				console.log(new Date(y, m, d));
				 

				 

				
				//alert(y2+'-'+m2+'-'+d2);
				//window.location='<?php echo base_url().'leave_dashboard' ?>?d='+y+'-'+m+'-'+d;
			},			 
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

			
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				
			},
			
			events: [
				<?php 
 

				$colors2=array("default","default","default","default");
					
					 
					
					foreach ($get_datewise_rec as $key => $date_data) { if($date_data['total'] != 0){ 

						$i=0;
						if($i>4){$i=0;}
					 
						
				?>
					{
					id: <?php echo 0; //$clg_data['college_id']; ?>,
					title: 'Total - <?php echo  $date_data["total"]; ?>   A <?php echo  $date_data["approve"]; ?> / R <?php echo  $date_data["reject"]; ?> ',
					
					start: new Date(y, m, (<?php echo $key; ?>)),
					className: '<?php echo $colors2[$i] ?>'},
				<?php $i++; } }

			?> 
			],			
		});
		
		
	});*/



 
</script>
<style>
	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
		background-color: #DDDDDD;
	}		
	#wrap {
		width: 1100px;
		margin: 0 auto;
	}		
	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		text-align: left;
		}
		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}
		
	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}

	#calendar {
/* 		float: right; */
        margin: 0 auto;
		width: 100%;
		background-color: #FFFFFF;
		  border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
		}
	.panel-title, .panel-primary{
		background-color:#fff !important;
		border:none !important;
		color:#555 !important;
	}
	.panel-primary>.panel-heading+.panel-collapse>.panel-body {
		border-top-color: #ccc;
	}
	.panel-group .panel+.panel{
		margin-top:5px;
	}
	.panel-title a{
		
	}
	.static_collapse{
		border: 1px solid #ddd;
	    font-size: 14px;
	    font-weight: normal
	}
	.fc-ltr .fc-event-hori.fc-event-end, .fc-rtl .fc-event-hori.fc-event-start {
    border-right-width: 1px;
    text-align: center !important;
        font-weight: bold !important;
    color: red !important;
}
</style>

<script type="text/javascript">

$(document).ready(function(){
	$('.change_date_val').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose: true,

		    //startDate: new Date() 
		   // startDate: '-3d' 
		}); 

	$('.change_date_val').on('change', function(){

		window.location.replace("leave_dashboard?leave_date="+$(this).val());
	});
});



	/*function change_date(curr_date){

		 if(curr_date){
		 	//window.location.replace("leave_dashboard?leave_date="+curr_date);
		 }
		
	}*/
</script>

<section class="content" ng-app="Common_app" ng-controller="Approve_LeaveController">
	<div class="container-fluid">

	<div class="alert alert-warning" style="background-color: #ffffff !important;">
		<div class="row clearfix"> 
			 <p style="color:red; text-align: left; color: #e91e63 !important; font-weight: bold;  font-size: 23px;" class="col-sm-4 pull-left">
			 DASHBOARD

			 	<div class="col-sm-2 pull-right"> 
		            <div class="form-group" style="    margin: 0px;"> 
		                <div class="form-line">
		                    <input style="    font-size: 25px;    color: #00bcd4;"  type="text" class="form-control  change_date_val" value="<?php if(isset($_GET) && isset($_GET['leave_date'])){  echo $_GET['leave_date']; }else{ echo date('Y-m-d'); } ?>" placeholder="YYYY-MM-DD"  >
		                </div>
		            </div>
		             
		        </div>
			 </p>
	     	
	    </div>    
    </div>

		<?php
		
		$month_applied = $month_approved = $month_reject = $allendance_log = 0;

		foreach($total_hrs as $clg){ 
			 if(count($clg['staff_wise_details']) != 0){ $i=1; foreach($clg['staff_wise_details'] as $sd) { 

			 	$allendance_log += 1;
			 }
			}

		}

		

		foreach ($get_datewise_rec as $key => $date_data) { if($date_data['total'] != 0){ 

			$month_applied += $date_data['total'];

			$month_approved += $date_data['approve'];

			$month_reject += $date_data['reject'];

		}  }
		?>

		<div class="modal fade in" id="attendance_modal" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">APPLIED LEAVES</h4>
                        </div>
                        <div class="modal-body">

                        	<?php?>

                        	 <div class="panel-body table-responsive" >
	                            <table class="table table-bordered" style="font-size: 13px;">
	                                            	<thead>
	                                            		<tr>
	                                            			<th>Sl No</th>
	                                            			<th>College Name</th>
	                                            			<th>Name</th>
	                                            			<th>From date</th>
	                                            			<th>To date</th>
	                                            			<th>Reason</th>
	                                            			<th>Status</th>
	                                            			
	                                            		</tr>
	                                            	</thead>
                          		
                         			 <?php if(count($leave_apply) != 0){  $i=1; foreach($leave_apply as $staff){    ?>
	                               
	                                        

	                                            	<tbody>
	                                            	 

	                                            			<tr>
	                                            				<td><?php echo $i; ?></td>
	                                            				<td><?php echo $staff['college_name']; ?></td>
	                                            				<td><?php echo $staff['firstname'].' '.$staff['lastname']; ?></td>
	                                            				<td><?php echo $staff['from_date']; ?></td>
	                                            				<td><?php echo $staff['to_date']; ?></td>
	                                            				<td><?php echo $staff['reason']; ?></td>

	                                            				<?php if($staff['approve_status'] == 0){
	                                            						$status = '<span class="label label-danger">Rejected</span>';
	                                            				}elseif ($staff['approve_status'] ==3) {
	                                            					$status = '<span class="label label-success">Accepted</sapn>';
	                                            				}else{
	                                            					$status = '<span class="label label-warning">Waiting</span>';
	                                            				}  ?>

	                                            				<td><?php echo $status; ?></td>
	                                            				
	                                            			</tr>
	                                            		
	                                            	</tbody>
	                                          <?php  $i++;  } }else{ ?>
	                                            			<tr>
	                                            				<td colspan="7"><center><strong>No Result Found</strong></center></td>
	                                            			</tr>
	                                            		<?php }?>   
 											 </table>
	                                        </div>

                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

		<div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect" data-toggle="modal"   data-target="#attendance_modal">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text" >APPLIED LEAVES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $month_applied; ?>" data-speed="15" data-fresh-interval="20"><?php echo $month_applied; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect"  data-toggle="modal"   data-target="#attendance_modal">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">APPROVED LEAVES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $month_approved; ?>" data-speed="1000" data-fresh-interval="20"><?php echo $month_approved; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect"  data-toggle="modal"   data-target="#attendance_modal">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">REJECTED LEAVES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $month_reject; ?>" data-speed="1000" data-fresh-interval="20"><?php echo $month_reject; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add </i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL ATTENDANCE LOGS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $allendance_log; ?>" data-speed="1000" data-fresh-interval="20"><?php echo $allendance_log; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            
		<div class="block-header">
            <h2>Leave Details</h2>
        </div>

        <!-- <div class="container">
        	 <?php if(isset($get_staff_notification)){ if(count($get_staff_notification) != 0){ ?> 
        		<div class="alert bg-pink alert-dismissible" role="alert" style="text-align: left;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                   Leave Notification  <span class="badge badge-light"> <?php echo count($get_staff_notification); ?></span>
                    <a href="javascript:void(0);" class="alert-link" data-toggle="modal" data-target="#View_AlterStaff">Click here..!</a>
                </div>
            <?php } }?>    
        	 
        </div> -->
	</div>
	
   <!--  <div class="col-lg-6" style="position:relative">
		<div id='calendar'></div>
		<div style='clear:both'></div>
	</div> -->
	<div class="col-lg-6" style="text-align:left">
		<div class="card">
				<div class="header bg-teal"   >
					<h2  >
						 Leave Dashboard
<!-- 						<small>All college staff leave reports. Click on a college to view staff's leave and alternative staff information</small>
 -->					</h2>
					
				</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 add_acc">
	                    	<div class="panel-group full-body" id="accordion_5" role="tablist" aria-multiselectable="true" style="    margin-bottom: 0px;">
                                
	                    		<?php  $i=1; foreach($staff_details as $staff){    ?>
	                                <div class="panel panel-default">
	                                    <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>_5" >
	                                        <h4 class="panel-title" style="background-color: #f3f3f3 !important;">
	                                            <a role="button" class="static_collapse" data-toggle="collapse" data-parent="#accordion_5" href="#collapse<?php echo $i; ?>_5" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>_5">
	                                                <?php echo $staff['college_name']; ?>

	                                                <span class="badge bg-cyan pull-right">  <?php echo count($staff['staff_details']); ?>  </span>
	                                            </a>
	                                        </h4>
	                                    </div>
	                                    <div id="collapse<?php echo $i; ?>_5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>_5">
	                                        <div class="panel-body table-responsive" >
	                                            <table class="table table-bordered" style="font-size: 13px;">
	                                            	<thead>
	                                            		<tr>
	                                            			<th>Sl No</th>
	                                            			<th>Name</th>
	                                            			<th>From date</th>
	                                            			<th>To date</th>
	                                            			<th>Reason</th>
	                                            			<th>View</th>
	                                            		</tr>
	                                            	</thead>

	                                            	<tbody>
	                                            		<?php if(count($staff['staff_details']) != 0){ $j=1; foreach($staff['staff_details'] as $sd) {?>

	                                            			<tr>
	                                            				<td><?php echo $j++; ?></td>
	                                            				<td><?php echo $sd['firstname'].' '.$sd['lastname'];  ?></td>
	                                            				<td><?php echo $sd['from_date']; ?></td>
	                                            				<td><?php echo $sd['to_date']; ?></td>
	                                            				<td><?php echo $sd['reason']; ?></td>
	                                            				<td> <button style="padding: 3px 8px;" data-toggle="modal" data-target="#View_AlterStaff" type="button" class="btn btn-primary waves-effect"  ng-click="get_leave_policy_details(<?php echo $sd['emp_leave_id']; ?>)"><i style="font-size: 16px;" class="fa fa-eye" aria-hidden="true"></i></button></td>
	                                            			</tr>
	                                            		<?php } }else{?>
	                                            			<tr>
	                                            				<td colspan="6"><center><strong>No Result Found</strong></center></td>
	                                            			</tr>
	                                            		<?php }?>
	                                            	</tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                </div>
                            <?php $i++; }?>     

	                		</div>
	            	</div>    

			 
				</div>
			</div>
			<div class="body calc table-responsive"></div>
		</div>
	</div>

	<div class="container-fluid">	
		<div class="row">
			<div class="col-lg-6" style="text-align:left">
		<div class="card" >
				<div class="header bg-pink"  >
					<h2 >
						 Attendance Log Details
						<!-- <small>All college staff leave reports. Click on a college to view staff's leave and alternative staff information</small> -->
					</h2>
					 
				</div>
			<div class="body">
				<div class="row clearfix">
					<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 add_acc">
	                    	<div class="panel-group full-body" id="accordion_6" role="tablist" aria-multiselectable="true" style="    margin-bottom: 0px;">
                                
	                    		<?php  $i=1; foreach($total_hrs as $key => $clg){     ?>
	                                <div class="panel panel-default">
	                                    <div class="panel-heading" role="tab" id="heading<?php echo $i; ?>_6" >
	                                        <h4 class="panel-title" style="background-color: #f3f3f3 !important;">
	                                            <a role="button" class="static_collapse" data-toggle="collapse" data-parent="#accordion_6" href="#collapse<?php echo $i; ?>_6" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>_6">
	                                                <?php echo $clg['college_name']; ?>

	                                                <span class="badge bg-pink pull-right">  <?php echo count($clg['staff_wise_details']); ?>  </span>
	                                            </a>
	                                        </h4>
	                                    </div>
	                                    <div id="collapse<?php echo $i; ?>_6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i; ?>_6">
	                                        <div class="panel-body table-responsive" >
	                                            <table class="table table-bordered" style="font-size: 13px;">
	                                            	<thead>
	                                            		<tr>
	                                            			<th>Sl No</th>
	                                            			<th>Name</th>
	                                            			<th>In Time</th>
	                                            			<th>Out Time</th>
	                                            			<th>Total Hrs</th>
	                                            			<th>Permission</th>
	                                            			<th>Late Entry</th>
	                                            		</tr>
	                                            	</thead>

	                                            	<tbody>
	                                            		<?php  if(count($clg['staff_wise_details']) != 0){ $j=1; foreach($clg['staff_wise_details'] as $sd) {
	                                            				
	                                            			?>

	                                            			<tr  <?php $limit_time = date('H:i:s', strtotime('10:20:00'));   if(strtotime($sd['intime']) >= strtotime($limit_time)){ echo 'style="background: #fff2b5;"';  } ?> >
	                                            				<td><?php $allendance_log += 1; echo $j++; ?></td>
	                                            				<td><?php echo $sd['firstname'].' '.$sd['lastname']; if($sd['staff_attendance_type'] == 0){  echo '&nbsp;&nbsp;&nbsp;&nbsp;<i class="material-icons" style="font-size: 20px; color: #31bd04;">fingerprint</i>';}  ?></td>
	                                            				<td><?php echo $sd['intime']; ?></td>
	                                            				<td><?php echo $sd['out_time']; ?></td>
	                                            				<td><?php echo $sd['total_hrs']; ?></td>
																<td><?php echo $sd['permission']; ?></td>
	                                            				<td><?php echo $sd['late_entry']; ?></td>
	                                            			</tr>
	                                            		<?php } }else{?>
	                                            			<tr>
	                                            				<td colspan="7"><center><strong>No Result Found</strong></center></td>
	                                            			</tr>
	                                            		<?php }?>
	                                            	</tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                </div>
                            <?php $i++; }?>     

	                		</div>
	            	</div>    

			 
				</div>
			</div>
			<div class="body calc table-responsive"></div>
		</div>
	</div>
		</div>
	</div>

	<div class="modal fade in" id="View_AlterStaff" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="View_AlterStaffLabel">View Leave Details</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Staff Name</th>
                                        <th>{{StaFf_details.firstname}} {{StaFf_details.lastname}}</th>
                                    </tr>

                                    <tr>
                                        <th>Staff ID</th>
                                        <th>{{StaFf_details.staff_id}}</th>
                                    </tr>

                                    <tr>
                                        <th>Applied Date</th>
                                        <th>{{StaFf_details.apply_date}}</th>
                                    </tr>

                                    <tr>
                                        <th>From Date</th>
                                        <th>{{StaFf_details.to_date}}</th>
                                    </tr>

                                    <tr>
                                        <th>No.of Days</th>
                                        <th>{{StaFf_details.total_days}}</th>
                                    </tr>

                                    <tr>
                                        <th>Reason</th>
                                        <th>{{StaFf_details.reason}}</th>
                                    </tr>

                                    <tr style="color: red;">
                                        <th>Alter Staff 1</th>
                                        <th>{{StaFf_details.staff_name1}}</th>
                                    </tr>

                                    <tr ng-if="StaFf_details.staff_name2 != ''" style="color: red;">
                                        <th>Alter Staff 2</th>
                                        <th>{{StaFf_details.staff_name2}}</th>
                                    </tr>

                                     
                                </thead>
                            </table>
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
    </div>
	
</section>





<script type="text/javascript">
	$(document).ready(function(){

		//alert(4545);
	});
</script>