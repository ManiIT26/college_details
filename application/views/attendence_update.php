<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
 -->
<section class="content"  >
    <div class="container-fluid">
            
        <div class="block-header">
            <h2>Attendance Update</h2>
        </div>

       
        <div class="conteiner-fluid">

            <div class="modal fade in" id="View_AlterStaff" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="View_AlterStaffLabel">Edit  Leave</h4>
                        </div>
                        <div class="modal-body">
                           
                               <form id="form_validation" method="POST"  enctype="multipart/form-data" autocomplete="off"> 
                                 <div class="col-md-12"> 
                                <div class ="row">
                              
                                 <div class="col-md-6">

                                   <div class="form-group required">
                                            <label for="from date">From Date</label> 
                                               <div class="form-line">
                                                 <input type="text"  value="" id="from_date_1" name="attach_from_date" class="form-control attach_from_date" placeholder="From Date" readonly required>
                                             </div>
                                       </div>
                                       
                                     <div class="form-group required">
                                        <label for="to date">To Date</label>
                                        <div class="form-line">
                                             <input type="text"  value="" id="to_date_1" name="attach_to_date" class="form-control attach_to_date" onchange="leave_details()" placeholder="To Date" readonly required>
                                        </div>
                                    </div> 

                                    <div class="form-group required">
                                 <label for="to date">Leave Type</label>
                                    <div class="form-line">
                                        <input type="text"  value="" id="leave_type_1" name="reason" class="form-control " placeholder="Leave Type" readonly required>
                                     </div>
                                 </div>

                                 <div class="form-group required">
                                 <label for="to date">Reason</label>
                                    <div class="form-line">
                                        <input type="text"  value="" id="reason_1" name="reason" class="form-control " placeholder="Reason" readonly required>
                                     </div>
                                 </div> 

                                 <div class="form-group required">
                                  <label for="attachment">Attachment</label> 
                                    <div class="form-line">
                                        <input type="file"  value="" id="attachement" name="attachement" class="form-control"  required>
                                        <input type="hidden"  value="" id="staff_id_1" name="staff_id_1" class="form-control staff_id_1" >
                                        <input type="hidden"  value="" id="approve_type_1" name="approve_type_1" class="form-control approve_type_1" >
                                         <input type="hidden"  value="" id="reporting_1" name="reporting_1" class="form-control reporting_1" >
                                        <input type="hidden"  value="" id="reporting_2" name="reporting_2" class="form-control reporting_2" >
                                        <input type="hidden"  value="" id="leave_id_1" name="leave_id_1" class="form-control leave_id_1" >
                                     </div>
                                 </div>

                                 
                                 </div>  


                                 
                                     <div class="col-md-6">
                                         <div class="form-group required">
                                            <label for="from date">From Date</label> 
                                               <div class="form-line">
                                                 <input type="text"  value="" id="from_date_1" name="from_date_1" class="form-control common_date_picker from_date_1" placeholder="From Date" required>
                                             </div>
                                       </div>
                                       
                                     <div class="form-group required">
                                        <label for="to date">To Date</label>
                                        <div class="form-line">
                                             <input type="text"  value="" id="to_date_1" name="to_date_1" class="form-control common_date_picker to_date_1" onchange="leave_details()" placeholder="To Date" required>
                                        </div>
                                        </div>
                                   
                                <div class="form-group required">
                                    <label for="password">Available Leave</label>
                                    <div class="form-line">
                                        <select class="form-control show-tick" id='select'  name="leave_date[]" multiple required>
                                            <option value="">-- Please select --</option>
                                         </select>
                                        <!-- <input type="text" id="leave_type" name="leave_type" required class="form-control" placeholder="Enter your Subject"> -->
                                    </div>
                                </div>
                             

                                 <div class="form-group required">
                                 <label for="to date">Reason</label>
                                    <div class="form-line">
                                        <input type="text"  value="" id="reason" name="reason" class="form-control " placeholder="Reason" required>
                                     </div>
                                 </div>
                           
                                <div class="form-group required">
                                    <label for="password">Leave</label>
                                 <div class="form-line">
                                    <select class="form-control show-tick " name="leave_day_type" required="">
                                    <option value="">-- Please select --</option>
                                    <option value="HD" >Halfday</option>
                                    <option value="FD">Fullday</option></select></div>
                                </div>  

                                <div class="form-group required">
                                    <label for="password">Leave Type</label>
                                <div class="form-line">
                                    <select class="form-control show-tick leave_type_new" name="leave_type_new" required="">
                                        <option value="">-- Please select --</option>
                                        
                                    </select>
                                </div>
                                </div>

                             </div>
                          </div>
                        
                    </div>

                 

                       <center><button type="submit" class="btn btn-success  waves-effect">Submit</button></center>   

                               </form>



                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
             </div>
            

            <div class="col-sm-12">
                
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Attendance Update</h2>
                            
                        </div>
                        <div class="body "> 

                             <form method="post" class="get_attd_log"  autocomplete="off"> 
                                    <div class="row clearfix"> 
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" value="<?php if(isset($staff_id)){ echo $staff_id; } ?>" name="staff_id"  class="form-control " placeholder="Enter Staff ID">
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-3">

                                 <div class="form-group required">
                                 <!--    <label for="password">From Date</label> -->
                                    <div class="form-line">
                                        <input type="text"  value="<?php if(isset($from_date)){ echo $from_date; } ?>" id="from_date" name="from_date" class="form-control common_date_picker" placeholder="From Date" required>
                                     </div>
                                 </div>
                                 </div>

                                 <div class="col-md-3">

                                 <div class="form-group required">
                                  <!--   <label for="password">To Date</label> -->
                                    <div class="form-line">
                                        <input type="text"  value="<?php if(isset($to_date)){ echo $to_date; } ?>" id="to_date" name="to_date" class="form-control common_date_picker" placeholder="To Date" required>
                                     </div>
                                 </div>
                                 </div>  
                                  
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                      <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect"><i class="material-icons">search</i></button>
                                    </div>
                                </div>
                            </form>
                             
                        </div>



                        <?php 
                          //  echo '<pre>';
                       // print_r($get_staff_details); ?>

                    </div>
            </div>

            <div class="col-sm-12"> 
                
                    <div class="card">
                        <div class="header bg-green">
                            <h2>View Attendance Details  </h2>
                            
                        </div>

            

                        <div class="body">
                           <div class="row">
                                  <!--  <div class="col-sm-3 pull-right" style="    margin-bottom: 0px;">
                                       <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control ng-pristine ng-untouched ng-valid ng-empty">
                                    </div> -->
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12" ng-show="filter_data > 0">
                                        <table class="table table-striped table-bordered"> 
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Name</th>
                                                    <th>From date</th>
                                                    <th>To Date</th>
                                                    <th>Total Days</th>
                                                    <th>leave Type</th>
                                                    <th>Reason</th>
                                                    <th>Edit</th>

                                                </tr>
                                            </thead>
                                           <tbody>
                                                    <?php if(isset($get_staff_details)){ ?>
                                                        <?php  if(count($get_staff_details) != 0){ $i=1; foreach($get_staff_details as $sd) {?>

                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $sd['firstname'].' '.$sd['lastname']; ?></td>
                                                                <td><?php echo $sd['from_date']; ?></td>
                                                                <td><?php echo $sd['to_date']; ?></td>
                                                                <td><?php echo $sd['total_days']; ?></td>
                                                                <td><?php echo $sd['leave_type']; ?></td>
                                                               <td><?php echo $sd['reason']; ?></td>
                                                                <input type="hidden"  value="<?php echo $sd['from_date'] ?>" id="appn_from_date" name="appn_from_date" class="form-control appn_from_date" >
                                                                <input type="hidden"  value="<?php echo $sd['to_date'] ?>" id="appn_to_date" name="appn_to_date" class="form-control appn_to_date" >
                                                                <input type="hidden"  value="<?php echo $sd['staff_id'] ?>" id="appn_s_id" name="appn_s_id" class="form-control appn_s_id" >
                                                                <input type="hidden"  value="<?php echo $sd['reason'] ?>" id="appn_reason" name="appn_reason" class="form-control appn_reason" >
                                                                 <input type="hidden"  value="<?php echo $sd['emp_leave_id'] ?>" id="appn_leave_id" name="appn_leave_id" class="form-control appn_leave_id" >
                                                                <input type="hidden"  value="<?php echo $sd['leave_type'] ?>" id="appn_leave_type" name="appn_leave_type" class="form-control appn_leave_type" >
                                                                <input type="hidden"  value="<?php echo $sd['approve_type'] ?>" id="appn_approve_type" name="appn_approve_type" class="form-control appn_approve_type" >
                                                                 <input type="hidden"  value="<?php echo $sd['reporting_person1_role'] ?>" id="appn_reporting_person1_role" name="appn_reporting_person1_role" class="form-control appn_reporting_person1_role" >
                                                                <input type="hidden"  value="<?php echo $sd['reporting_person2_role'] ?>" id="appn_reporting_person2_role" name="appn_reporting_person2_role" class="form-control appn_reporting_person2_role" >
                                                                <td> <button style="padding: 3px 8px;" data-toggle="modal" data-target="#View_AlterStaff" data-id="'.$sd['s_id'].'"   type="button" onclick="appn_data()" class="btn btn-primary waves-effect"><i style="font-size: 16px;" class="fa fa-pencil" aria-hidden="true"></i></button></td>
                                                            </tr>
                                                        <?php } }?>
                                                        <?php } else{?>
                                                            <tr>
                                                                <td colspan="8"><center><strong>No Result Found</strong></center></td>
                                                            </tr>
                                                            <?php } ?>
                                                    </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 ng-hide" ng-show="filter_data == 0">
                                        <div class="col-md-12">
                                            <h4>No records found..</h4>
                                        </div>
                                    </div>
                                  
                                        
                                    <div class="col-md-12"> 
                                        <ul class="pagination-small pull-right pagination ng-isolate-scope" pagination="" page="current_grid" on-select-page="page_position(page)" max-size="CollegemaxSize" boundary-links="true" total-items="filter_data" items-per-page="data_limit" previous-text="«" next-text="»">
  <!-- ngRepeat: page in pages --><li ng-repeat="page in pages" ng-class="{active: page.active, disabled: page.disabled}" class="ng-scope disabled"><a ng-click="selectPage(page.number)" class="ng-binding">First</a></li><!-- end ngRepeat: page in pages --><li ng-repeat="page in pages" ng-class="{active: page.active, disabled: page.disabled}" class="ng-scope disabled"><a ng-click="selectPage(page.number)" class="ng-binding">«</a></li><!-- end ngRepeat: page in pages --><li ng-repeat="page in pages" ng-class="{active: page.active, disabled: page.disabled}" class="ng-scope active"><a ng-click="selectPage(page.number)" class="ng-binding">1</a></li><!-- end ngRepeat: page in pages --><li ng-repeat="page in pages" ng-class="{active: page.active, disabled: page.disabled}" class="ng-scope disabled"><a ng-click="selectPage(page.number)" class="ng-binding">»</a></li><!-- end ngRepeat: page in pages --><li ng-repeat="page in pages" ng-class="{active: page.active, disabled: page.disabled}" class="ng-scope disabled"><a ng-click="selectPage(page.number)" class="ng-binding">Last</a></li><!-- end ngRepeat: page in pages -->
</ul>
                                    </div>
                                   
                                </div>
                            
                        </div>
                    </div>
                      
            </div>
                        
        </div>
    </div>
</section>        

<script type="text/javascript">

  function leave_details(){

    

    /*var from_date = $('input[name="from_date_1"]').val();

    var to_date = $('input[name="to_date_1"]').val();*/

    var from_date = $('.from_date_1').val();

    var to_date = $('.to_date_1').val();

    var attach_from_date = $('.attach_from_date').val();

    var attach_to_date = $('.attach_to_date').val();

    var s_id = $('.staff_id_1').val();

   
   

   
$('#select').empty();
        $.ajax({
            url: 'attendance_update/getLeave_available',
            type: 'POST',
            data:{'s_id':s_id,'from_date':from_date,'to_date':to_date,'attach_from_date':attach_from_date,'attach_to_date':attach_to_date},
            success: function (data) {

                        console.log(data);
                        
                        var jsonData = JSON.parse(data);
                       
                        $.each(jsonData, function(i, value) {   
                        $('#select').append('<option value="'+value['curr_date']+'">'+value['curr_date']+'</option>');
           
                         });
                         }
                    });
                }
</script>

<script>

$(document).ready(function(){
    $('.from_date_1').on('change', function(){

        var from_date = $(this).val();

        var to_date = $('.to_date_1').val();

       
        if(from_date == ''){

            $('.from_date_1').parent('div').addClass('has-error');

        }
        else{

            $('.from_date_1').parent('div').removeClass('has-error').addClass('has-success');

            if(to_date != ''){
                if(new Date(from_date) <= new Date(to_date)){

                    date_diff(from_date,to_date);
                }
                else{
                    $.alert('Todate is not allowed to be smaller than Fromdate ');

                    $('.leave_to_date').val('');
                 
                }
            }
                
        }

            
    });


    $('.to_date_1').on('change', function(){

        var from_date = $('.from_date_1').val();

        var to_date = $(this).val();

        if(to_date == ''){

            $('.to_date_1').parent('div').addClass('has-error');

        }
        else{

            $('.to_date_1').parent('div').removeClass('has-error').addClass('has-success');

            if(from_date != ''){

                if(new Date(from_date) <= new Date(to_date)){

                     date_diff(from_date,to_date);
                }
                else{
                    $.alert('Todate is not allowed to be smaller than Fromdate ');

                    $(this).val('');

                   
                }
            }
                
        }

            
    });
});

 function date_diff(from_date,todate){

    $('.leave_day_type').empty();

        var d1 = new Date(from_date);
        var d2 = new Date(todate);


            var oneDay = 24*60*60*1000;
            var diff = 0;
            if (d1 && d2) { 
          
              diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));
            }

            $('.leave_type_new').empty();

            $('.leave_type_new').append('<option value="" >Select</option>');

            $.ajax({
                url:'leave_apply/getLeave_policy',
                type:'post',
                data:{'fromdate':from_date,'todate':todate,'no_days':0},
                success:function(data){
                   var Json_data = JSON.parse(data);  

                   for(var i=0; i<Json_data.length; i++){

                        $('.leave_type_new').append('<option value="'+Json_data[i]+'" >'+Json_data[i]+'</option>'); 
                   }
                   console.log(Json_data); 
                }
            }); 
                

            /*$http.post('leave_apply/getLeave_policy',{'fromdate':from_date,'todate':todate,'no_days':0})
            .then(function(responce){

                console.log(responce.data   );

                if(responce.data == 'Already_Exist'){

                    $.alert('Already Apply on this date, Please Cancel and Re-apply'); 

                    $('.leave_from_date').val('');
                    $('.leave_to_date').val('');
                }
                else{
                    $scope.LeaveDetails = responce.data;
                }

             

                
            });*/
 }

function appn_data() 
{

    var from_date = $('.appn_from_date').val();

    var to_date = $('.appn_to_date').val();

    var s_id = $('.appn_s_id').val();

    var reason = $('.appn_reason').val();

    var leave_type = $('.appn_leave_type').val();

    var approve_type = $('.appn_approve_type').val();

    var reporting_1 = $('.appn_reporting_person1_role').val();

    var reporting_2 =$('.appn_reporting_person2_role').val();

    var leave_id =$('.appn_leave_id').val();



    

   
    $('#from_date_1').val(from_date);
    $('#to_date_1').val(to_date);
    $('#staff_id_1').val(s_id);
    $('#reason_1').val(reason);
    $('#leave_type_1').val(leave_type);
    $('#approve_type_1').val(approve_type);
    $('#reporting_1').val(reporting_1);
    $('#reporting_2').val(reporting_2);
    $('#leave_id_1').val(leave_id);

    
}

</script>