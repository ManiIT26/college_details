 

<section class="content"  >
    <div class="container-fluid">
            
        <div class="block-header">
            <h2>Leave Update</h2>
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
                              
                                 <div class="col-md-3">

                                <div class="form-group required">
                                 <label for="to date">CCL Count</label>
                                    <div class="form-line">
                                        <input type="text"  value="" id="ccl_total_1" name="ccl_total_1" class="form-control " placeholder="ccl "  required>
                                     </div>
                                 </div>

                                </div> 

                                <div class="col-md-3">

                                <div class="form-group required">
                                 <label for="to date">CL Count</label>
                                    <div class="form-line">
                                        <input type="text"  value="" id="cl_total_1" name="cl_total_1" class="form-control " placeholder="Leave Type"  required>
                                        <input type="hidden"  value="" id="leave_id_1" name="leave_id_1" class="form-control " placeholder="Leave Type"  required>
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
                            <h2>Leave Update</h2>
                            
                        </div>
                        <div class="body "> 

                             <form method="post" class="get_attd_log"  autocomplete="off"> 
                                    <div class="row clearfix"> 
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" value="<?php if(isset($staff_id)){ echo $staff_id; } ?>" name="staff_id"  class="form-control " placeholder="Enter Staff ID" required>
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
                                        <table class="table table-striped table-bordered table-responsive"> 
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Name</th>
                                                    <th>CCL Count</th>
                                                    <th>Cl Count</th>
                                                    <th>Edit</th>

                                                </tr>
                                            </thead>
                                           <tbody>
                                                    <?php if(isset($get_staff_details)){ ?>
                                                        <?php  if(count($get_staff_details) != 0){ $i=1; foreach($get_staff_details as $sd) {?>

                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $sd['firstname'].' '.$sd['lastname']; ?></td>
                                                                <td><?php echo $sd['ccl_total']; ?></td>
                                                                <td><?php echo $sd['cl_total']; ?></td>
                                                             
                                                                <input type="hidden"  value="<?php echo $sd['ccl_total'] ?>" id="appn_ccl_total" name="appn_ccl_total" class="form-control appn_ccl_total" >
                                                                <input type="hidden"  value="<?php echo $sd['cl_total'] ?>" id="appn_cl_total" name="appn_cl_total" class="form-control appn_cl_total" >
                                                                <input type="hidden"  value="<?php echo $sd['leave_id'] ?>" id="appn_leave_id" name="appn_leave_id" class="form-control appn_leave_id" >
                                                                
                                                                <td> <button style="padding: 3px 8px;" data-toggle="modal" data-target="#View_AlterStaff" data-id="'.$sd['s_id'].'"   type="button" onclick="appn_data()" class="btn btn-primary waves-effect"><i style="font-size: 16px;" class="fa fa-pencil" aria-hidden="true"></i></button></td>
                                                            </tr>
                                                        <?php } }?>
                                                        <?php } else{?>
                                                            <tr>
                                                                <td colspan="5"><center><strong>No Result Found</strong></center></td>
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

    var ccl_total = $('.appn_ccl_total').val();

    var cl_total = $('.appn_cl_total').val();

    var leave_id = $('.appn_leave_id').val();

    $('#ccl_total_1').val(ccl_total);
    $('#cl_total_1').val(cl_total);
    $('#leave_id_1').val(leave_id);
    

    
}

</script>