<script type="text/javascript">
	

</script>

<?php
	date_default_timezone_set("Asia/Calcutta");

	$day = (isset($_GET["day"])) ? $_GET['day'] : "";
	$month = (isset($_GET["month"])) ? $_GET['month'] : "";
	$year = (isset($_GET["year"])) ? $_GET['year'] : "";

	if($year == ''){
		$yr = date('Y');	}
	else{
		$yr = $year;
	}

	if($month == ''){
		$mon = date('m');	}
	else{
		$mon = $month;
	}





	if(empty($day)){ $day = date("j"); }
	if(empty($month)){ $month = date("n"); }
	if(empty($year)){ $year = date("Y"); }
	//set up vars for calendar etc
	$currentTimeStamp = strtotime("$year-$month-$day");
	//$monthName = date("F", $currentTimeStamp);
	$monthName = date("F", mktime(0, 0, 0, $month, 10));
	$numDays = date("t", $currentTimeStamp);
	$counter = 0;
?>

								<table width="300" cellspacing="2" class="table table-bordered">
									<tr class="calander_head">
										<td width="50" height="29" class="calheader" align="center">
											<button type="button" class="btn btn-default btn_design_class" onClick="goLastMonth(<?php echo $month . ", " . $year; ?>);"><i class="fa fa-angle-left" aria-hidden="true"></i></button></td>
										<td width="250" colspan="5" align="center" class="calheader">
										<span class="title"><?php echo $monthName . " " . $year; ?></span><br></td>
										<td width="50" align="center" class="calheader">
											<button type="button" class="btn btn-default btn_design_class"  onClick="goNextMonth(<?php echo $month . ", " . $year; ?>);"><i class="fa fa-angle-right" aria-hidden="true"></i></button></td>
									</tr> 
									<tr>
									    <th height="30" class="weekcell">S</th>
									    <th class="weekcell">M</th>
									    <th class="weekcell">T</th>
									    <th class="weekcell">W</th>
									    <th class="weekcell">T</th>
									    <th class="weekcell">F</th>
									    <th class="weekcell">S</th>
									</tr>
									<tr>
									<?php
										for($i = 1; $i < $numDays+1; $i++, $counter++)
										{
											$dateToCompare = $month . '/' . $i . '/' . $year;
											$timeStamp = strtotime("$year-$month-$i");
											//echo $timeStamp . '<br/>';
											if($i == 1)
											{
												// Workout when the first day of the month is
												$firstDay = date("w", $timeStamp);
												for($j = 0; $j < $firstDay; $j++, $counter++)
												{
													echo "<td class='daycell'>&nbsp;</td>";
												} 
											}
											if($counter % 7 == 0)
											{
											?>
												</tr><tr>
									        <?php
											}
											
										   $today=date("j");
										   $thismonth=date("F");
										   
										   if($i==$today && $monthName==$thismonth)	
										   {


										   	$cal_date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$i));

										   	$month_yr = date('m-d', strtotime($year.'-'.$month.'-'.$i));

										   	

										  	$this->db->where('staff_id',$this->session->userdata('user_type_id'));
										  	$this->db->select('attadence_role');
											$atten_role = $this->db->get(STAFF_DETAILS)->row_array();	

											//print_r($atten_role['attadence_role']); 		
										   
										  	$this->db->where('status',1);
											$this->db->where('holiday_date',$cal_date);
											//$this->db->where('MONTH(holiday_date)',$mon);
											$this->db->where('college_id',$this->session->userdata('college_id'));  
											$this->db->where('staff_atten_type',$atten_role['attadence_role']);  
											$this->db->select('holiday_date,holiday_name,holiday_category');
											$select_events = $this->db->get(HOLIDAY_EVENT_FIX)->row_array();

											



											 

											if($select_events['holiday_category'] == 'GH'){												

												$events_data = array('holiday_category'=>$select_events['holiday_category'],'holiday_name'=>$select_events['holiday_name']) ;
											}	
											else if($select_events['holiday_category'] == 'FL'){

												$events_data = array('holiday_category'=>$select_events['holiday_category'],'holiday_name'=>$select_events['holiday_name']);
											}
											else{
												$events_data = array('holiday_category'=>'','holiday_name'=>'');
											}
											 
											 

										    ?>	   
										   <td width="50" title="<?php if(isset($events_data['holiday_name'])){ echo $events_data['holiday_name']; } ?>"  class="daycell colored_tooltip <?php if(isset($events_data['holiday_category'])){  if($events_data['holiday_category'] == 'FL'){ echo 'floting_holiday'; }else if($events_data['holiday_category'] == 'GH'){ echo 'general_holiday'; }else { echo 'current_day_cal'; } }else { echo 'current_day_cal'; }?>" ><strong><?php echo $i;?></strong></td> 
										   <?php
										   }
										   else
										   {

										   		$cal_date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$i));

										   		$month_yr = date('m-d', strtotime($year.'-'.$month.'-'.$i));

										   	$this->db->where('staff_id',$this->session->userdata('user_type_id'));
										  	$this->db->select('attadence_role');
											$atten_role = $this->db->get(STAFF_DETAILS)->row_array();	
										  
										   
										  	$this->db->where('status',1);
											$this->db->where('holiday_date',$cal_date);
											//$this->db->where('MONTH(holiday_date)',$mon);
											$this->db->where('college_id',$this->session->userdata('college_id'));
											$this->db->where('staff_atten_type',$atten_role['attadence_role']);  
											$this->db->select('holiday_date,holiday_name,holiday_category');
											$select_events = $this->db->get(HOLIDAY_EVENT_FIX)->row_array();

											//print_r($select_events);
											 

											if($select_events['holiday_category'] == 'GH'){												

												$events_data = array('holiday_category'=>$select_events['holiday_category'],'holiday_name'=>$select_events['holiday_name']);
											}	
											else if($select_events['holiday_category'] == 'FL'){

												$events_data = array('holiday_category'=>$select_events['holiday_category'],'holiday_name'=>$select_events['holiday_name']);
											}
											else{
												$events_data = array('holiday_category'=>'','holiday_name'=>'');
											}
											 



										   ?>     
										    <td width="50" title="<?php if(isset($events_data['holiday_name'])){ echo $events_data['holiday_name']; }   ?>"  class="daycell colored_tooltip <?php if(isset($events_data['holiday_category'])){  if($events_data['holiday_category'] == 'FL'){ echo 'floting_holiday'; }else if($events_data['holiday_category'] == 'GH'){ echo 'general_holiday'; }else{ echo ''; } }?>"><?php  echo $i;?></td> 
										   <?php
										   }
										   }
										  
											?>
											
								</table>