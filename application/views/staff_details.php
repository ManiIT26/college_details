<section class="content"  ng-app="Test_app">  
	<div class="container-fluid">
            
		<div class="block-header">
            <h2>Staff Deatails</h2>
        </div>

        <div class="conteiner-fluid" ng-controller="Test_staff_conroller" >
        <div class="col-sm-12">
                 
         <div class="card">
                <div class="header bg-orange">
                    
                    <h2>Staff Details</h2>
              </div>

        <div class="body">
            <form id="form_validation" method="POST" class="submit_staff" ng-submit="submit_staff()" enctype="multipart/form-data" autocomplete="off"> 
                <div class="row clearfix">
                    <div class="col-sm-6 ">

                      
                        <div class="form-group required">
                          <label for="password">Bio Metric Id</label>
                            <div class="form-line">
                                <input type="text"  value="{{View_staffs.staff_id}}" id="staff_id" name="staff_id" class="form-control" placeholder="Enter  Bio Metric Id" required>
                                <input type="hidden"  value="{{View_staffs.s_id}}" id="s_id" name="s_id" class="form-control" placeholder="Enter  Staff ID" >
                             </div>
                        </div>

                        <!-- <label for="password">Bio Metric Id</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text"  value="{{View_staffs.bio_metric_id}}" id="bio_id" name="bio_id" class="form-control" placeholder="Enter Bio Metric Id" required>
                                
                             </div>
                        </div> -->
                         <?php if($this->session->userdata('user_type') == 'super_admin'){ ?>
                            
                            <div class="form-group required">
                                <label for="email_address">College Name</label>
                                <div class="form-line"  >
                                    <select class="form-control show-tick college_name_select" name="college_name">
                                        <option value="">-- Please select --</option>
                                        <?php foreach($get_college_details as $college_details){ ?>
                                            <option value="<?php echo $college_details['college_id'] ?>" ><?php echo $college_details['college_name'] ?></option>
                                         <?php }?>
                                    </select>
                                </div>
                            </div>

                         

                        <?php }else{?>
                            <input type="hidden" name="college_name" class="hidden_college_val" value="<?php echo $this->session->userdata('college_id'); ?>">
                        <?php }?> 

                        <div class="form-group required">
                            <label for="password">Attendance Type</label>
                            <div class="form-line"  >
                                    <select class="form-control show-tick attendance_type" name="attendance_type" required>
                                        <option value="">-- Please select --</option>
                                        <option value="0">Biometric</option>
                                        <option value="1">Attendance</option> 
                                
                                    </select>
                             </div>
                        </div>
                       
                        <div class="form-group required">
                             <label for="password">Teaching Type</label>
                            <div class="form-line"  >
                                    <select class="form-control show-tick staff_type" name="staff_type" id = "staff_type" required>
                                        <option value="">-- Please select --</option>
                                            <option value="1">Non Teaching</option>
                                         <option value="0">Teaching</option>
                                        
                                         
                                
                                    </select>
                             </div>
                         </div>   

                        <div style='display:none;' id='department'>
                        
                        <div class="form-group">
                            <label for="department">Department</label>
                            <div class="form-line">
                                <select class="form-control show-tick clg_department" name="clg_department" >
                                    <option value="">-- Please select --</option>                                     
                                    <option ng-repeat="data in Dept_details"  value="{{data.department_id}}">{{data.department_name}} </option>
                                    
                                </select>
                             </div>
                         </div> 
                        </div>


                        
                        <div class="form-group required">
                            <label for="password">Role</label>
                            <div class="form-line">
                                 <select class="form-control show-tick role" name="role"  required>
                                    <option value="">-- Please select --</option>
                                 
                                    <option  ng-repeat="data in Role_details" value="{{data.role_id}}">{{data.role}}</option>
                                     
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group required">
                            <label for="password">First Name</label>
                            <div class="form-line">
                                <input type="text" value="{{View_staffs.firstname}}" id="firstname" name="firstname" class="form-control" placeholder="Enter  First Name" required>
                             </div>
                        </div>

                         
                        <div class="form-group required">
                            <label for="password">Last Name</label>
                            <div class="form-line">
                                <input type="text" value="{{View_staffs.lastname}}"  id="lastname" name="lastname" class="form-control" placeholder="Enter  Last Name" required>
                             </div>
                        </div>

                        
                        <div class="form-group required">
                            <label for="password">DOB</label>
                            <div class="form-line">
                                <input type="text"  value="{{View_staffs.dob}}" id="dob" name="dob" class="form-control common_date_picker" placeholder="Enter  DOB" required>
                             </div>
                        </div>

                        
                        <div class="form-group required">
                            <label for="password">Gender</label>
                            <div class="form-line"  >
                                    <select class="form-control show-tick gender" name="gender" required>
                                        <option value="">-- Please select --</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Transgender">Transgender</option>
                                
                                    </select>
                             </div>
                        </div>
                      
                         

                    </div>    

                    <div class="col-sm-6">

                        
                       

                       
                        <div class="form-group required">
                            <label for="password">Mobile Number </label>
                            <div class="form-line">
                                <input type="number"  value="{{View_staffs.mobile_number}}" id="mobile_number" name="mobile_number" class="form-control common_mobile" placeholder="Enter  Mobile Number" required>
                             </div>
                        </div>

                        
                        <div class="form-group required">
                            <label for="password">Email Id</label>
                            <div class="form-line">
                                <input type="email"  value="{{View_staffs.email_id}}" id="email_id" name="email_id" class="form-control" placeholder="Enter  Email Id" required>
                             </div>
                        </div>

                         
                        <div class="form-group required">
                            <label for="password">Address</label>
                            <div class="form-line">
                                <input type="text" value="{{View_staffs.address}}"  id="ad  dress" name="address" class="form-control" placeholder="Enter Address" required>
                             </div>
                        </div>

                        <div  id='approve_type' >
                            
                            <div class="form-group required">
                                <label for="password">Approve Type</label>
                                <div class="form-line">
                                    <select class="form-control show-tick approve approve_type" name="approve_type" required>
                                        <option value="">-- Please select --</option>
                                        <option value="1">Level 1</option>
                                        <option value="2">Level 2</option>
                                    </select>
                                 </div>
                            </div>
                        </div>


                        <div class="reorting_person_1" style="display:none"> 
                            
                            <div class="form-group required">
                                <label for="password">Reporting Person 1</label>
                                <div class="form-line">
                                    <input list="reporting_person"   class="form-control show-tick reporting_person1_role" ng-model="reporting_person1_role" name="reporting_person1_role" placeholder="Search Reporting Person" ng-keyup="get_reporting_person(reporting_person1_role)">
                                    <datalist id="reporting_person">

                                        <option ng-repeat="data in Reporting_person" value="{{data.staff_id}} - {{data.firstname}} {{data.lastname}} ( {{data.department_name}} - {{data.role}} )">
                                        
                                    </datalist> 

                                   
                                </div>
                            </div>
                        </div>     

                        <div class="reorting_person_2" style="display:none"> 

                            
                            <div class="form-group required">
                                <label for="password">Reporting Person 2</label>
                                <div class="form-line">
                                      <input list="reporting_person_2"   class="form-control show-tick reporting_person2_role" ng-model="reporting_person2_role" name="reporting_person2_role" placeholder="Search Reporting Person" ng-keyup="get_reporting_person(reporting_person2_role)">
                                
                                       <datalist id="reporting_person_2">

                                            <option ng-repeat="data in Reporting_person" value="{{data.staff_id}} - {{data.firstname}} {{data.lastname}} ( {{data.department_name}} - {{data.role}} )">
                                        
                                        </datalist> 
                                </div>
                            </div>
                        </div>    


                        <!-- <div style='display:none;' id='approve_type_1'>
                        <label for="password">Approve Type</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select class="form-control show-tick approve" name="approve_type">
                                    <option value="">-- Please select --</option>
                                    <option value="1">Level 1</option>
                                 </select>
                             </div>
                        </div>
                        </div> -->
                     


                         
                        <div class="form-group required">
                            <label for="password">Password</label>
                            <div class="form-line">
                                <input type="password"  id="password" name="password" class="form-control newpassword" placeholder="Enter Password" required>
                             </div>
                        </div>

                        
                        <div class="form-group required">
                            <label for="password">Confirm Password</label>
                            <div class="form-line">
                                <input type="password"  id="confrim_password" name="confrim_password" class="form-control confrimpassword" placeholder="Enter Confirm password" required>
                             </div>
                        </div>

                        
                        <div class="form-group required">
                            <label for="password">Profile Image</label>
                            <div class="form-line">
                                <input type="file"  id="file" name="file" class="form-control" placeholder="Enter Confrim password" required>
                             </div>
                        </div>



                    </div>
      
                       <br>
                              
                            
                </div>           
                 <center>   <button class="btn btn-success waves-effect" type="submit">SUBMIT</button></center>
                            </form>
                </div>
           </div>
                        
            </div>

            <div class="col-sm-12" >
                
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <h2>View Staff Details</h2>
                            
                        </div>
                            <?php  ?>
                        <div class="body">
                            <div class="table-responsive">
                                    
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
                                                    <th>Profile Image</th>
                                                    <th>College Name</th>
                                                    <th>Staff Id</th>
                                                    <th>Staff Name</th>
                                                    <th>Department</th>
                                                    <th>Role</th>
                                                    <th>Gender</th>
                                                    <th>Mobile Number</th>
                                                     <th>Mail</th>

                                                    
                                                     <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="data in searched = (staff_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                    <td>{{(current_grid*25 - 24)+ $index}}</td>
                                                    <td ng-if="data.profile_image != ''"><img src="assets/images/staff_profile/{{data.profile_image}}" width="30" height="30" alt="User"  class="img-rounded"></td>
                                                    <td ng-if="data.profile_image == ''"><img src="assets/images/default.jpg" width="30" height="30" alt="User"  class="img-rounded" ></td>
                                                    <td>{{data.college_name}}</td>
                                                    <td>{{data.staff_id}}</td>
                                                    <td>{{data.firstname}} {{data.lastname}}</td>
                                                    <td ng-if="data.department_name != null">{{data.department_name}}</td>
                                                     <td ng-if="data.department_name == null">-</td>
                                                    <td>{{data.role}}</td>
                                                    <td>{{data.gender}}</td>
                                                    <td>{{data.mobile_number}}</td>
                                                    <td>{{data.email_id}}</td>
 
                                                    <td style="    width: 3cm;">
                                                        <button type="button" class="btn btn-danger waves-effect"  ng-click="delete_staff_details(data.s_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        <button type="button" class="btn btn-primary waves-effect   "  ng-click="edit_staff_details(data.s_id)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
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


<script type="text/javascript">
	$(document).ready(function(){
    $('#staff_type').on('change', function() {
      if (this.value == '0')
     {
        $("#department").show();
        //$('#approve_type option[value="2"]').show();
         
      }
      else
      {
        $("#department").hide();
         //$('#approve_type option[value="2"]').hide();
      }

      });
});
</script>