<section class="content"  ng-app="Common_app">  
    <div class="container-fluid">
            
        <div class="block-header">
            <h2>Department & Role</h2>
        </div>

        <div class="conteiner-fluid" ng-controller="Common_dept_conroller" >
            

            <div class="col-sm-8" >
                
                    <div class="card">
                        <div class="header bg-light-blue">
                            <h2>View Department Details</h2>
                            
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
                                                    <th>College Name</th>
                                                    <th>Department</th>
                                                     
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="data in searched = (dept_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                    <td>{{(current_grid*5 - 4)+ $index}}</td>
                                                    <td>{{data.college_name}}</td>
                                                    <td>{{data.department_name}}</td>
                                                    

                                                    <td style="    width: 3cm;">
                                                        <button type="button" class="btn btn-danger waves-effect"  ng-click="delete_dept_details(data.department_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        <!-- <button type="button" class="btn btn-primary waves-effect   "  ng-click="edit_college_details(data.college_id)"><i class="fa fa-pencil" aria-hidden="true"></i></button> -->
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

            <div class="col-sm-4">
                
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Department Details</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" class="submit_departments" ng-submit="submit_departments()">
                               
                                <div class="form-group">
                                    <?php if($this->session->userdata('user_type') == 'super_admin'){ ?>
                                        <label for="email_address">College Name</label>
                                        <div class="form-line"  >                                   

                                            <select class="form-control show-tick" name="college_name">
                                                <option value="">-- Please select --</option>
                                                <?php foreach($get_college_details as $college_details){ ?>
                                                    <option value="<?php echo $college_details['college_id'] ?>" ><?php echo $college_details['college_name'] ?></option>
                                                 <?php }?>
                                            </select>
                                           
                                        </div>
                                     <?php }else{?>
                                            <input type="hidden"  value="<?php echo $this->session->userdata('college_id') ?>" name="college_name" class="form-control" placeholder="Enter  Department" required>
                                    <?php }?>
                                </div>
                                <label for="password">Department</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  id="clg_department" name="clg_department" class="form-control" placeholder="Enter  Department" required>
                                    </div>
                                </div>

                               
                                
                                  
                                

                                 
                                    <br>
                              
                                <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                        
            </div>
        </div>


        <div class="conteiner-fluid" ng-controller="Common_role_conroller">
            

            <div class="col-sm-8"> 
                
                    <div class="card">
                        <div class="header bg-green">
                            <h2>View Role Details  </h2>
                            
                        </div>

                        <div class="body">
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
                                                    <th>College Name</th>
                                                    <th>Department</th>
                                                     
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="data in searched = (Role_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                    <td>{{(current_grid*5 - 4)+ $index}}</td>
                                                    <td>{{data.college_name}}</td>
                                                    <td>{{data.role}}</td>
                                                    

                                                    <td style="    width: 3cm;">
                                                        <button ng-disabled="data.role == 'PRINCIPAL' || data.role == 'HOD'"  type="button" class="btn btn-danger waves-effect"  ng-click="delete_role_details(data.role_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

            <div class="col-sm-4">
                <div class="card">
                        <div class="header bg-light-green">
                            <h2>Role Details</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST"  class="submit_roles" ng-submit="submit_roles()">
                               
                                <div class="form-group">
                                    <?php if($this->session->userdata('user_type') == 'super_admin'){ ?>
                                        <label for="email_address">College Name</label>
                                        <div class="form-line"  >                                   

                                            <select class="form-control show-tick" name="college_name_role">
                                                <option value="">-- Please select --</option>
                                                <?php foreach($get_college_details as $college_details){ ?>
                                                    <option value="<?php echo $college_details['college_id'] ?>" ><?php echo $college_details['college_name'] ?></option>
                                                 <?php }?>
                                            </select>
                                           
                                        </div>
                                     <?php }else{?>
                                            <input type="hidden"  value="<?php echo $this->session->userdata('college_id') ?>" name="college_name_role" class="form-control" placeholder="Enter  Department" required>
                                    <?php }?>
                                    <!-- <div class="form-line"  >
                                        <select class="form-control show-tick" name="college_name_role">
                                            <option value="">-- Please select --</option>
                                            <?php foreach($get_college_details as $college_details){ ?>
                                                <option value="<?php echo $college_details['college_id'] ?>" ><?php echo $college_details['college_name'] ?></option>
                                             <?php }?>
                                        </select>
                                    </div> -->
                                </div>
                                <label for="password">Role</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  id="clg_role" name="clg_role" class="form-control" placeholder="Enter  Role" required>
                                    </div>
                                </div>

                              <br>
                              
                                <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                        
            </div>
        </div>
        
        
        
        
        
        
        
        
        <div class="conteiner-fluid" ng-controller="Common_holiday_conroller">
            

            <div class="col-sm-8"   > 
                
                    <div class="card">
                        <div class="header bg-green">
                            <h2>View Holiday Details  </h2>
                            
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
                                                    <th>College Name</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="data in searched = (Role_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                    <td>{{(current_grid*5 - 4)+ $index}}</td>
                                                    <td>{{data.college_name}}</td>
                                                     <td>{{data.holiday_date}}</td>
                                                    <td>{{data.holiday_name}}</td>
                                                    

                                                    <td style="    width: 3cm;">
                                                        <button ng-disabled="data.role == 'PRINCIPAL' || data.role == 'HOD'"  type="button" class="btn btn-danger waves-effect"  ng-click="delete_holiday_details(data.holiday_event_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

           <!--  <div class="col-sm-4">
                
                    <div class="card">
                        <div class="header bg-light-green">
                            <h2>Holiday Details</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST"  class="submit_holidays" ng-submit="submit_holidays()">
                               
                                <div class="form-group">
                                    <?php if($this->session->userdata('user_type') == 'super_admin'){ ?>
                                        <label for="email_address">College Name</label>
                                        <div class="form-line"  >                                   

                                            <select class="form-control show-tick" name="college_name_holiday">
                                                <option value="">-- Please select --</option>
                                                <?php foreach($get_college_details as $college_details){ ?>
                                                    <option value="<?php echo $college_details['college_id'] ?>" ><?php echo $college_details['college_name'] ?></option>
                                                 <?php }?>
                                            </select>
                                           
                                        </div>
                                     <?php }else{?>
                                            <input type="hidden"  value="<?php echo $this->session->userdata('college_id') ?>" name="college_name_holiday" class="form-control" placeholder="Enter  Department" required>
                                    <?php }?>
                                     
                                </div>
                                <label for="password">Date</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  id="h_date" name="h_date" class="form-control common_date_picker" placeholder="Enter Date" required>
                                    </div>
                                </div>
                                
                                <label for="password">Holiday</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  id="holiday" name="holiday" class="form-control" placeholder="Enter  Holiday" required>
                                    </div>
                                </div>

                               
                                
                                  
                                

                                 
                                    <br>
                              
                                <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                        
            </div> -->
        </div>

        <div class="conteiner-fluid" ng-controller="Common_email_conroller">
            

            <div class="col-sm-8"> 
                
                    <div class="card">
                        <div class="header bg-green">
                            <h2>View Email Details  </h2>
                            
                        </div>

                        <div class="body">
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
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr ng-repeat="data in searched = (Role_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                    <td>{{(current_grid*5 - 4)+ $index}}</td>
                                                    <td>{{data.email_id}}</td>
                                                  <td style="    width: 3cm;">
                                                        <button  type="button" class="btn btn-danger waves-effect"  ng-click="delete_email_details(data.mail_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

            <div class="col-sm-4">
                <div class="card">
                        <div class="header bg-light-green">
                            <h2>Email Details</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST"  class="submit_emails" ng-submit="submit_emails()">
                               
                               <!--  <div class="form-group">
                                    <?php if($this->session->userdata('user_type') == 'super_admin'){ ?>
                                        <label for="email_address">College Name</label>
                                        <div class="form-line"  >                                   

                                            <select class="form-control show-tick" name="college_name_role">
                                                <option value="">-- Please select --</option>
                                                <?php foreach($get_college_details as $college_details){ ?>
                                                    <option value="<?php echo $college_details['college_id'] ?>" ><?php echo $college_details['college_name'] ?></option>
                                                 <?php }?>
                                            </select>
                                           
                                        </div>
                                     <?php }else{?>
                                            <input type="hidden"  value="<?php echo $this->session->userdata('college_id') ?>" name="college_name_role" class="form-control" placeholder="Enter  Department" required>
                                    <?php }?>
                                
                                </div> -->
                                <label for="password">Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email"  id="email_id" name="email_id" class="form-control" placeholder="Enter Email" required>
                                    </div>
                                </div>
                                 <br>
                              
                                <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
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