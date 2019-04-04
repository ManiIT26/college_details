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
    background: #7d6e6d;
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
}

</style>

<section class="content" ng-app="Common_app" ng-controller="Leave_policyController">
	<div class="container-fluid">
            
		<div class="block-header">
            <h2>Leave Apply</h2>
        </div>

       
    	<div class="conteiner-fluid">
            <div class="col-sm-4">
                
                    <div class="card">
                        <div class="header bg-orange ">
                            <h2>Holiday Calender</h2>
                            
                        </div>
                        <div class="body calc table-responsive">
                        </div>
                    </div>
            </div>

            <div class="col-sm-8">
                
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h2>Leave Apply</h2>
                            
                        </div>
                        <div class="body ">
                        <form method="post" class="leave_apply_form" enctype="multipart/form-data" ng-submit="leave_apply_form()" autocomplete ="off">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group required">
                                        <label for="password">Subject</label>
                                        <div class="form-line">
                                            <input type="text" id="leave_subject " name="leave_subject" required class="form-control" placeholder="Enter your Subject">
                                        </div>
                                    </div>

                                     <div class="row clearfix">
                                        <div class="col-sm-6" style="margin-bottom: 0px;">
                                            <div class="form-group required">
                                                <label for="password">From date</label>
                                                <div class="form-line">
                                                    <input type="text" id="from_date_leave" required name="from_date_leave"   class="leave_from_date form-control common_date_picker" placeholder="YYYY-MM-DD"  >
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="col-sm-6" style="margin-bottom: 0px;">
                                            <div class="form-group required">
                                                <label for="password">To date</label> 
                                                <div class="form-line">
                                                    <input type="text" id="to_date_leave" required name="to_date_leave"   class="leave_to_date form-control common_date_picker"   placeholder="YYYY-MM-DD">
                                                </div>
                                            </div>
                                        </div>
                                        
                                     </div>


                                     <div class="row clearfix">
                                        <div class="col-sm-6" style="margin-bottom: 0px;">
                                            <div class="form-group required">
                                                <label for="password">Leave Type</label>
                                                <div class="form-line">
                                                    <select class="form-control show-tick" name="college_leave_type" required>
                                                        <option value="">-- Please select --</option>
                                                        
                                                        <option value="{{data}}" ng-repeat="data in LeaveDetails">{{data}}  </option>
                                                    </select>
                                                    <!-- <input type="text" id="leave_type" name="leave_type" required class="form-control" placeholder="Enter your Subject"> -->
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="col-sm-6" style="margin-bottom: 0px;">
                                            <div class="form-group leave_day_type">
                                               
                                                <div class="form-line leave_day_type" style="display:none;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                     </div>

                                    <div class="row clearfix ">
                                         <div class="col-sm-12">
                                            <input type="checkbox" id="md_checkbox_35" class="filled-in chk-col-orange no_periods" >
                                            <label for="md_checkbox_35" style="height: 0px !important;">No Classes</label>
                                         </div>
                                    </div>     

                                       <?php if($view_reporting_person['current_staff']['staff_type'] == 0){ ?>

                                         <div class="row clearfix hide_staff_alter">
                                          

                                            <div class="col-sm-4 " style="margin-bottom: 0px;">
                                                <div class="form-group required">
                                                    <label for="password">Department</label>
                                                    <div class="form-line">
                                                        <select id="dept_1" name="dept_1" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <?php foreach($Dept_details as $dept){ ?>
                                                                <option value="<?php echo $dept['department_id']; ?>"><?php echo $dept['department_name'];?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-4 " style="margin-bottom: 0px;">
                                                <div class="form-group required">
                                                    <label for="password">Alternative Staff 1</label>
                                                    <div class="form-line">
                                                        <select id="dept_staff1" name="dept_staff1" class="form-control" required >
                                                            <option value="">Select</option>
                                                           
                                                                <option ng-hide="Get_staff_details.length == '0'" ng-repeat="data in Get_staff_details" value="{{data.staff_id}}">{{data.firstname}} {{data.lastname}} - {{data.staff_id}} </option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>    

                                            <div class="col-sm-4 " style="margin-bottom: 0px;">
                                                <div class="form-group required">
                                                    <label for="password">Hrs</label>
                                                    <div class="form-line">
                                                        <select id="dept_staff1_hrs" name="dept_staff1_hrs" class="form-control"  required>
                                                            <option value="">Select</option>
                                                            <?php for($i=1; $i<=7; $i++){ ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                         </div>
                                    <?php }?>  

                                     
                                </div> 

                                <div class="col-sm-6">
                                    <div class="form-group required">
                                        <label for="password">Date</label>
                                        <div class="form-line">
                                            <input type="text" id="curr_date" name="curr_date" required readonly value="<?php echo date('Y-m-d'); ?>" class="form-control common_date_picker"  >
                                        </div>
                                    </div>

                                    <div class="form-group required" >
                                        <label for="password ">Total</label>
                                        <div class="form-line">
                                            <input type="text" id="leave_total" name="leave_total" readonly class="total_leaves form-control" placeholder="Enter your Subject">
                                        </div>
                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-6" style="margin-bottom: 0px;">
                                            <div class="form-group required">
                                                <label for="password">Reason</label>
                                                <div class="form-line">
                                                    <input type="text"  id="leave_reason" name="leave_reason" required class="form-control" placeholder="Enter your Subject">
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="col-sm-6" style="margin-bottom: 0px;">
                                            <div class="form-group">
                                                <label for="password">Attachment</label>
                                                <div class="form-line">
                                                    <input type="file" id="leave_attachment" name="leave_attachment" class="form-control" placeholder="Enter your Subject">
                                                </div>
                                            </div>
                                        </div>
                                        
                                     </div>

                                     <div class="row clearfix hide_staff_alter">
                                         <div class="col-sm-12">
                                          &nbsp;&nbsp;&nbsp;
                                         </div>
                                    </div>  

                                     <?php if($view_reporting_person['current_staff']['staff_type'] == 0){ ?>



                                         <div class="row clearfix hide_staff_alter" >
                                            <div class="col-sm-4" style="margin-bottom: 0px;">
                                                <div class="form-group  ">
                                                    <label for="password">Department</label>
                                                    <div class="form-line">
                                                        <select id="dept_2" name="dept_2" class="form-control" >
                                                            <option value="">Select</option>
                                                            <?php foreach($Dept_details as $dept){ ?>
                                                                <option value="<?php echo $dept['department_id']; ?>"><?php echo $dept['department_name'];?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4" style="margin-bottom: 0px;">
                                                <div class="form-group  ">
                                                    <label for="password">Alternative Staff 2</label>
                                                    <div class="form-line">
                                                        <select id="dept_staff2" name="dept_staff2" class="form-control" >
                                                            <option value="">Select</option>
                                                            <option ng-hide="Get_staff_details2.length == '0'" ng-repeat="data in Get_staff_details2" value="{{data.staff_id}}">{{data.firstname}} {{data.lastname}} - {{data.staff_id}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>    

                                            <div class="col-sm-4" style="margin-bottom: 0px;">
                                                <div class="form-group">
                                                    <label for="password">Hrs</label>
                                                    <div class="form-line">
                                                        <select id="dept_staff2_hrs" name="dept_staff2_hrs" class="form-control" >
                                                            <option value="">Select</option>
                                                            <?php for($i=1; $i<=7; $i++){ ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                         </div>
                                    <?php }?>     
                                </div> 

                                 <br>
                              
                                <center><button class="btn btn-success waves-effect leave_sub_button" type="submit">SUBMIT</button></center>
                            </div>    

                        </form>
                        </div>
                    </div>
            </div>
                        
        </div>

        <div class="conteiner-fluid">
            <div class="col-sm-12" >
                
                    <div class="card">
                        <div class="header bg-pink">
                            <h2>View Leave Details</h2>
                            
                        </div>
                          
                        <div class="body">
                            <div class=" ">
                                    
                                <div class="row">
                                    
                                    <div class="col-sm-3 pull-right" style="    margin-bottom: 0px;">
                                       
                                        <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" />
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12" ng-show="filter_data > 0">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Applied Date</th>
                                                    <th>From Date</th>
                                                    <th>To date</th>
                                                    <th>Reason</th>
                                                    <th>Leave Type</th>
                                                   
                                                    <th>Status type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="data in searched = (Leave_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                    <td>{{(current_grid*10 - 9)+ $index}}</td>
                                                     
                                                    <td>{{data.apply_date}}</td>
                                                    <td>{{data.from_date}}  </td>
                                                    <td>{{data.to_date}}</td>
                                                    <td>{{data.reason}}</td>
                                                    <td>{{data.leave_type}}</td>
                                                    
                                                    

                                                    <td style="    width: 3cm;">


                                                        <button ng-if="data.approve_status == 1 && data.alter_staff1_status == 0 && data.alter_staff2_status == 0" type="button" class="btn btn-danger waves-effect"  ng-click="delete_leave_apply(data.emp_leave_id,data.staff_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        <button ng-if="data.approve_status == 2 && data.alter_staff1_status == 0 && data.alter_staff2_status == 0" type="button" class="btn btn-danger waves-effect"  ng-click="delete_leave_apply(data.emp_leave_id,data.staff_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        <span ng-if="data.approve_status == 1 && data.alter_staff1_status == 1 && data.alter_staff2_status == 1" style="    background: orange !important;" class="badge badge-warning">Waiting For First Level</span>
                                                         <span ng-if="data.approve_status == 2 && data.alter_staff1_status == 1 && data.alter_staff2_status == 1" style="    background: orange !important;" class="badge badge-warning">Waiting For Second Level</span>
                                                         <span ng-if="data.approve_status == 3 && data.alter_staff1_status == 1 && data.alter_staff2_status == 1" style="background-color: #2b982b !important;" class="badge badge-warning">Approved</span>
                                                         <span ng-if="data.approve_status == 0 && data.alter_staff1_status == 1 && data.alter_staff2_status == 1" style="background-color: red !important;" class="badge badge-warning">Rejected</span>
                                                         <span ng-if="data.approve_status == 0 && data.alter_staff1_status == 0 && data.alter_staff2_status == 0" style="background-color: red !important;" class="badge badge-warning">Rejected</span>
                                                         <span ng-if="data.approve_status == 0 && data.alter_staff1_status == 2 && (data.alter_staff2_status == 0 || data.alter_staff2_status == 1)" style="background-color: red !important;" class="badge badge-warning">Staff 1 Not Accecpt Your Req</span>
                                                         <span ng-if="data.approve_status == 0 && (data.alter_staff1_status == 0 || data.alter_staff1_status == 1) && data.alter_staff2_status == 2" style="background-color: red !important;" class="badge badge-warning">Staff 2 Not Accecpt Your Req</span>
                                                        

                                                        <span ng-if="data.approve_status == 1 && data.alter_staff1_status == 1 && data.alter_staff2_status == 0" style="background-color: orange !important;" class="badge badge-warning">Waiting for Staff Approval</span>
                                                         <span ng-if="data.approve_status == 1 &&  data.alter_staff1_status == 0 && data.alter_staff2_status == 1" style="background-color: orange !important;" class="badge badge-warning">Waiting for Staff Approval</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12" ng-show="filter_data == 0">
                                        <div class="col-md-12">
                                            <h4>No records found..</h4>
                                        </div>
                                    </div>
                                  
                                        
                                    <div class="col-md-12"  > 
                                        <div pagination="" page="current_grid" on-select-page="page_position(page)" max-size="CollegemaxSize" boundary-links="true" total-items="filter_data" items-per-page="data_limit" class="pagination-small pull-right" previous-text="&laquo;" next-text="&raquo;"></div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                      
            </div>
        </div>
	</div>
</section>
