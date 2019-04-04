<section class="content" ng-app="Common_app" ng-controller="Approve_LeaveController">
    <div class="container-fluid">
            
        <div class="block-header">
            <h2>Leave Apply</h2>
        </div>
       
        
         
        <div class="conteiner-fluid">
            
            <div class="card">
                <div class="header">
                    <h2>
                        Approve Leaves
                    </h2>
                     
                </div>
                <div class="body">
                    <div class="row clearfix">
                         
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab" aria-expanded="true" ng-click="get_leave_req(1)">Level 1  
                                    <span class="badge" style="background: red;    color: white;margin: 0px 0 1px 6px;">{{leve1_1_count}}</span></a></li>
                                <li role="presentation" class=""><a href="#profile_animation_2" data-toggle="tab" aria-expanded="false" ng-click="get_leave_req(2)">Level 2
                                <span class="badge" style="background: red;    color: white;margin: 0px 0 1px 6px;">{{level_2_count}}</span></a></li> 
                                 
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" >
                                    <div class="row">
                                        <div class="col-md-12" ng-show="filter_data > 0">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl No</th>
                                                        <th>Staff Name</th>
                                                        <th>Staff ID</th>
                                                        <th>Applied Date</th>
                                                        <th>From Date</th>
                                                        <th>To date</th>
                                                        <th>Reason</th>
                                                        <th>Attachment</th>
                                                        <th>Leave Type</th>
                                                        <th>View</th>
                                                        <th>Status type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="data in searched = (Leave_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                        <td>{{(current_grid*10 - 9)+ $index}}</td>
                                                        <td>{{data.firstname}} {{data.lastname}}</td>
                                                        <td>{{data.staff_id}}</td>
                                                        <td>{{data.apply_date}}</td>
                                                        <td>{{data.from_date}}  </td>
                                                        <td>{{data.to_date}}</td>
                                                        <td>{{data.reason}}</td>
                                                        <td ng-if="data.file_name != ''">
                                                            <a target="_blank" href="<?php echo base_url().'assets/images/attendance_doc/';?>{{data.file_name}}"><span  style="background-color: #2b982b !important;" class="badge badge-warning">view</span></a>
                                                        </td>
                                                        <td ng-if="data.file_name == ''">-</td>
                                                        <td>{{data.leave_type}}</td>
                                                        
                                                        <td> <button data-toggle="modal" data-target="#largeModal" type="button" class="btn btn-primary waves-effect"  ng-click="get_leave_policy_details(data.emp_leave_id)"><i class="fa fa-eye" aria-hidden="true"></i></button></td>

                                                        <td style="    width: 3cm;" ng-if="role_Type == '1' && data.approve_status >= 1 && data.approve_status < 3"> 
                                                            <button  ng-disabled="data.approve_status == 2" type="button" class="btn btn-success waves-effect"  ng-click="accept_leave_apply(data.emp_leave_id,data.staff_id,role_Type)"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                           <button data-toggle="modal" data-target="#RejectModal{{data.emp_leave_id}}"  type="button" class="btn btn-danger waves-effect"   ><i class="fa fa-times" aria-hidden="true"></i></button>
                                                            
                                                                            <div class="modal fade in" id="RejectModal{{data.emp_leave_id}}" tabindex="-1" role="dialog" style="display: none;">
                                                                                <div class="modal-dialog modal-sm" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title" id="smallModalLabel">Reject Reason</h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                           
                                                                                            <textarea class="form-control" name="reject_reason" ng-model="reject_reason"></textarea>
                                                                          
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-link waves-effect" ng-click="reject_leave_apply(data.emp_leave_id,data.staff_id,role_Type,reject_reason)"> OK</button>
                                                                                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>                                                                        
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                        </td>

                                                        <td style="    width: 3cm;" ng-if="role_Type == '2' && data.approve_status >= 2"> 
                                                            <button  ng-disabled="data.approve_status >= 3" type="button" class="btn btn-success waves-effect"  ng-click="accept_leave_apply(data.emp_leave_id,data.staff_id,role_Type)"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                           <button data-toggle="modal" data-target="#RejectModal{{data.emp_leave_id}}" type="button" class="btn btn-danger waves-effect"  ><i class="fa fa-times" aria-hidden="true"></i></button>
                                                            
                                                                    <div class="modal fade in" id="RejectModal{{data.emp_leave_id}}" tabindex="-1" role="dialog" style="display: none;">
                                                                        <div class="modal-dialog modal-sm" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title" id="smallModalLabel">Reject Reason</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <textarea class="form-control" name="reject_reason" ng-model="reject_reason"></textarea>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-link waves-effect" ng-click="reject_leave_apply(data.emp_leave_id,data.staff_id,role_Type,reject_reason)"> OK</button>
                                                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


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
                 
                        
        </div>
    </div>


    

    <div class="modal fade in" id="largeModal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">View Leave Details</h4>
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