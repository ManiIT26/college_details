  <section class="content" ng-app="Common_app">
	<div class="container-fluid">
            
		<div class="block-header">
            <h2>Home</h2>
        </div>

        <div class="conteiner">
        	 <?php if(isset($get_staff_notification)){ if(count($get_staff_notification) != 0){ ?> 
        		<div class="alert bg-pink alert-dismissible" role="alert" style="text-align: left;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                   Leave Notification  <span class="badge badge-light"> <?php echo count($get_staff_notification); ?></span>
                    <a href="javascript:void(0);" class="alert-link" data-toggle="modal" data-target="#largeModal">Click here..!</a>
                </div>
            <?php } }?>    
        	 
        </div>
	</div>
	
    <div class="modal fade in" id="largeModal" tabindex="-1" role="dialog" style="display: none;" ng-controller="alter_reqController">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header modal-col-grey">
                    <h4 class="modal-title" id="largeModalLabel">Alternative Approval</h4>
                </div>
                <div class="modal-body">
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               <th>Sl No</th>
                               <th>Staff ID</th>
                               <th>Name</th> 
                               <th>From Date</th>
                               <th>To Date</th>
                               <th>Hrs</th>
                               <th>Action</th>
                           </tr>
                       </thead>

                       <tbody>
                            <?php $i=1; foreach ($get_staff_notification as $key => $notification) { ?>
                               <tr class="remove_leave<?php echo $notification['alter_manage_id']; ?>">
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $notification['staff_id']; ?></td>
                                    <td><?php echo $notification['firstname'].''.$notification['lastname']; ?></td>
                                    <td><?php echo $notification['from_date']; ?></td>
                                    <td><?php echo $notification['to_date']; ?></td>
                                    <td><?php print_r($notification['dept_staff_hrs']); ?></td>
                                    <td> 
                                        <button type="button" class="btn btn-success" ng-click="alter_staff_details(<?php echo $notification['alter_manage_id'].','.$notification['emp_leave_id'].','.$notification['alter_staff_type'].','.$notification['total_approval']; ?>,1)"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger" ng-click="alter_staff_details(<?php echo $notification['alter_manage_id'].','.$notification['emp_leave_id'].','.$notification['alter_staff_type'].','.$notification['total_approval']; ?>,0)"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </td> 
                               </tr>
                            <?php }?>
                       </tbody>
                   </table>
                </div>
                <div class="modal-footer "> 
                    <a href="<?php echo base_url() ?>index"><button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button></a>
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