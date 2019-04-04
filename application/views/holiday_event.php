<style type="text/css">
    /****** Calander Design **/
 
 .ui-tooltip, .arrow:after {
    background: black;
    border: 2px solid white;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 20px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
    box-shadow: 0 0 7px black;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: -16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }
.calander_head{
   background: #6b6961;
    color: white;
    font-weight: bold;
    font-size: 18px;
}

.general_holiday {
    background: #abff4a;
    color: black;
    cursor: pointer;
}
.current_day_cal{
    background: #dadada;
    color: white;
}


.floting_holiday{
      background: #FFC107;
      color: black;
      cursor: pointer;
}
th.weekcell {
    text-align: center;
    padding: 10px;
    background: #F44336;
    color: white;
}

td.daycell {
    text-align: center;
    padding: 10px;
     font-size: 40px;
     cursor:pointer;
     height: 126px !important;
}
 
</style>


<script type="text/javascript">
    function goLastMonth_event(month, year){
    if(month == 1){
        --year;
        month = 13;
        }

        window.location.replace("<?php echo base_url(); ?>holiday_event?month="+(month-1)+"&year="+year);


         

    }
    function goNextMonth_event(month, year){
        if(month == 12){
        ++year;
        month = 0;
        }

          window.location.replace("<?php echo base_url(); ?>holiday_event?month="+(month+1)+"&year="+year);
   
    }

    function check_box_check(check_id){

         if ($('#basic_checkbox_'+check_id).is(":checked")) {
           $('.event_name_'+check_id).show();
         }
         else{
            $('.event_name_'+check_id).hide();
         }

        //console.log("Clicked, new value = " + $('#basic_checkbox_'+check_id).checked);

        /*var attr = $('#basic_checkbox_'+check_id).attr('alt');

        if(attr == 0){
            $('#basic_checkbox_'+check_id).attr('checked', true);       
            $('#basic_checkbox_'+check_id).attr('alt', 1);       
        }
        else{
             $('#basic_checkbox_'+check_id).attr('checked', false);       
            $('#basic_checkbox_'+check_id).attr('alt', 0); 
        }*/
 

    }
</script>

<section class="content" >
	<div class="container-fluid">
            
		<div class="block-header">
            <h2>Leave Apply</h2>
        </div>

        <div class="conteiner-fluid">
            <form method="post" class="myForm">

                <div class="col-sm-12  ">
                    
                        <div class="card">
                            <div class="header bg-blue-grey">
                                <h2>Add Holidays</h2>
                                
                            </div>

                            <div class="body">
                                <?php
                                    date_default_timezone_set("Asia/Calcutta");

                                    $day = (isset($_GET["day"])) ? $_GET['day'] : "";
                                    $month = (isset($_GET["month"])) ? $_GET['month'] : "";
                                    $year = (isset($_GET["year"])) ? $_GET['year'] : "";

                                    if($year == ''){
                                        $yr = date('Y');    }
                                    else{
                                        $yr = $year;
                                    }

                                    if($month == ''){
                                        $mon = date('m');   }
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

                                    $this->db->where('college_id',$this->session->userdata('college_id'));
                                    $this->db->select('role');
                                    $get_role = $this->db->get(ROLE)->result_array();
                                ?>

                                    <div class="col-md-6">
                                   
               
                                

                                 <div class="demo-checkbox">

                                    <?php
                                        
                                        $get_month = (isset($_GET["month"])) ? $_GET['month'] : date('m');
                                        $get_year = (isset($_GET["year"])) ? $_GET['year'] : date('Y');
 
                                        $month_selected = date('Y-m', strtotime($get_year.'-'.$get_month));

                                        $this->db->where('status',1);                                        
                                        $this->db->where('college_id',$this->session->userdata('college_id'));
                                        $this->db->where('month',$month_selected);
                                        $this->db->select('staff_atten_type');
                                        $this->db->distinct();
                                        $select_events_role = $this->db->get(HOLIDAY_EVENT_FIX)->result_array();

                             

                                        echo '<script> $(document).ready(function(){';

                                       foreach($select_events_role as $roles){



                                            echo "

                                                $('.role_checkbox_".$roles['staff_atten_type']."').attr('checked',true);
 
                                                ";
 
                                       }  

                                        echo ' });</script>';
                                    ?>


                                    <input type="checkbox" class="role_checkbox role_checkbox_1" id="basic_checkbox_45" name ="attd_role_type[]" value="1">
                                    <label for="basic_checkbox_45">Staff</label>
                                    <input class="role_checkbox role_checkbox_2" type="checkbox" id="basic_checkbox_46" name ="attd_role_type[]" value="2"> 
                                    <label for="basic_checkbox_46">Admin</label>
                                    <input class="role_checkbox role_checkbox_2" type="checkbox" id="basic_checkbox_46" name ="attd_role_type[]" value="3"> 
                                    <label for="basic_checkbox_46">Warden</label>
                                  
                                </div>

                                </div>



                                    <table width="300" cellspacing="2" class="table table-bordered">
                                        <tr class="calander_head">
                                            <td width="50" height="29" class="calheader" align="center">
                                                <button type="button" class="btn btn-default btn_design_class" onClick="goLastMonth_event(<?php echo $month . ", " . $year; ?>);"><i class="fa fa-angle-left" aria-hidden="true"></i></button></td>
                                            <td width="250" colspan="5" align="center" class="calheader">
                                            <span class="title"><?php echo $monthName . " " . $year; ?>
                                               </span><br></td>
                                            <td width="50" align="center" class="calheader">
                                                <button type="button" class="btn btn-default btn_design_class"  onClick="goNextMonth_event(<?php echo $month . ", " . $year; ?>);"><i class="fa fa-angle-right" aria-hidden="true"></i></button></td>
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
                                               
                                                $this->db->where('status',1);
                                                $this->db->where('holiday_date',$cal_date);
                                                $this->db->where('college_id',$this->session->userdata('college_id')); 
                                                $this->db->select('holiday_date,holiday_name,holiday_category');
                                                $select_events = $this->db->get(HOLIDAY_EVENT_FIX)->row_array();

                                                ?>     
                                               <td width="50" class="daycell colored_tooltip current_day_cal" >
                                                     <input  onchange="check_box_check(<?php echo $i;?>)"   type="checkbox" <?php if($select_events['holiday_date']){ echo 'checked'; } ?> id="basic_checkbox_<?php echo $i;?>" alt="0" class="filled-in" value="<?php echo $cal_date; ?>" name="event_check_box[]" >
                                                    <label  for="basic_checkbox_<?php echo $i;?>" class="pull-left" style="display:block;"> </label>
                                               <strong><?php echo $i;?></strong>
                                              <input type="hidden" value="<?php echo $cal_date; ?>" class="form-control " name="event_date[]" >
                                                    <input style="display:<?php if($select_events['holiday_date']){ echo 'block'; }else{ echo 'none'; } ?>;" type="text" class="form-control event_name_<?php echo $i;?>" name="event_name[]" value="<?php echo $select_events['holiday_name']; ?>">

                                               </td> 
                                               <?php
                                               }
                                               else
                                               {

                                                    $cal_date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$i));

                                                    $month_yr = date('m-d', strtotime($year.'-'.$month.'-'.$i));


                                                    //print_r($cal_date);
                                               
                                                $this->db->where('status',1);
                                                $this->db->where('holiday_date',$cal_date);
                                                $this->db->where('college_id',$this->session->userdata('college_id'));
                                                $this->db->select('holiday_date,holiday_name,holiday_category');
                                                $select_events = $this->db->get(HOLIDAY_EVENT_FIX)->row_array();

                                               

                                               // print_r($get_role);


                                                 
                                                 

                                                /*if($select_events['holiday_category'] == 'GH'){                                             

                                                    $events_data = array('holiday_category'=>$select_events['holiday_category'],'holiday_name'=>$select_events['holiday_name']);
                                                }   
                                                else if($select_events['holiday_category'] == 'FL'){

                                                    $events_data = array('holiday_category'=>$select_events['holiday_category'],'holiday_name'=>$select_events['holiday_name']);
                                                }
                                                else{
                                                    $events_data = array('holiday_category'=>'','holiday_name'=>'');
                                                }*/
                                                 



                                               ?>     
                                                <td width="50"    class="daycell colored_tooltip ">
                                                
                                                    <input  onchange="check_box_check(<?php echo $i;?>)"   type="checkbox" <?php if($select_events['holiday_date']){ echo 'checked'; } ?> id="basic_checkbox_<?php echo $i;?>" alt="0" class="filled-in" value="<?php echo $cal_date; ?>" name="event_check_box[]" >
                                                    <label  for="basic_checkbox_<?php echo $i;?>" class="pull-left" style="display:block;"> </label>
                                                <?php  echo $i;?>
                                                     <input type="hidden" value="<?php echo $cal_date; ?>" class="form-control " name="event_date[]" >
                                                    <input style="display:<?php if($select_events['holiday_date']){ echo 'block'; }else{ echo 'none'; } ?>;" type="text" class="form-control event_name_<?php echo $i;?>" name="event_name[]" value="<?php echo $select_events['holiday_name']; ?>">
                                                </td> 
                                               <?php
                                               }
                                               }
                                              
                                                ?>
                                                
                                    </table>

                                    <center>
                                        <button type="button" class="btn btn-success"  onclick="validateForm()">Submit</button>
                                    </center>
                            </div>
                        </div>
                          
                </div>

            </forrm>
        </div>
  </div>
</section>  

<script type="text/javascript">

function validateForm(){
 
    var role_array = [];

    $('.role_checkbox:checked').each(function(){

        role_array.push($(this).val());
    });

    console.log(role_array.length);

    if(role_array.length == 0){

        $.alert('Please Select Role Type');
    }
    else{
        $('.myForm').submit();
    }

}



</script>  
