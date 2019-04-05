var common = angular.module('Common_app',['ui.bootstrap']);
common.filter('beginning_data', function() {
    return function(input, begin) {
        if (input) {
            begin = +begin;
            return input.slice(begin);
        }
        return [];
    }
});


$(document).ready(function () {

		$('.common_date_picker').mask('0000-00-00');
		$('.common_mobile').mask('0000000000');

		$('.common_date_picker').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose: true,
		    todayHighlight: true,

		    //startDate: new Date() 
		   // startDate: '-3d' 
		}); 

		$('.profile_date_picker').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose: true,

		    //startDate: new Date() 
		   // startDate: '-3d' 
		}); 


		 
	
	$('.common_date_picker_leave').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose: true,
		    //startDate: new Date() 
		    startDate: '-4d' ,
		    todayHighlight: true,
		}); 

		$('.common_date_picker_attd').datepicker({
		    format: 'yyyy-mm-dd',
		    autoclose: true,
		    endDate: '+0d' 
		   // startDate: '-3d' 
		}); 
		 
});

/*function check_leave_val(leave_val){ 

	if(leave_val.value == 'HD'){
		$('#leave_total').val(0.5);
	}
	else{
		$('#leave_total').val(1);
	}
}
*/
function goLastMonth(month, year){
	if(month == 1){
		--year;
		month = 13;
		}

		$(".calc").load("leave_apply/Event_calander?month="+(month-1)+"&year="+year);

	}
	function goNextMonth(month, year){
		if(month == 12){
		++year;
		month = 0;
		}
		$(".calc").load("leave_apply/Event_calander?month="+(month+1)+"&year="+year);
	}

common.controller('Common_conroller', function($scope,$http,$timeout){


	$scope.college_details_submit = function(){


		var pass = 	$('.newpassword').val();

		var cn_pass = $('.confrimpassword').val();

		if(pass.length <= 8)
		{

			$.alert('New Password should contain at least 8 characters');
		}
		else if(cn_pass.length <= 8)
		{

			$.alert('Confirm Password should contain at least 8 characters');
		}
		else if(pass != cn_pass)
		{

			$.alert('Password Not Matched');
		}
		else{
			
			$('.college_details_submit').submit();
		}
	}

	 

	$http.post('college_details/Get_college_details')
	.then(function(response){
		console.log(response.data.length);

		$scope.college_details = response.data;
		$scope.current_grid = 1;
	    $scope.data_limit = 10; 
	    $scope.CollegemaxSize = 5;
	    $scope.filter_data = $scope.college_details.length;
	    $scope.entire_user = $scope.college_details.length;

	});


	 

	$scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) { 
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

    $scope.edit_college_details = function(college_id){

    	

    	$http.post('college_details/edit_college_details',{'college_id':college_id})
		.then(function(response){
			 
			$('input[name=college_id]').val(response.data['college_id']);
			$('input[name=college_name]').val(response.data['college_name']).focus();
			$('textarea[name=colleg_addr]').val(response.data['college_addr']).focus();
			$('input[name=college_latitude]').val(response.data['college_latitude']).focus();
			$('input[name=college_longitude]').val(response.data['college_longitude']).focus();
			$('input[name=college_radius]').val(response.data['college_radius']).focus();
			$('input[name=college_user]').val(response.data['college_user']).focus();
 

		});

    }

    $scope.delete_college_details = function(college_id){

    	if (confirm('Are you sure to delete..!')) {
		    $http.post('college_details/delete_college_details',{'college_id':college_id})
			.then(function(response){
				 
				location.reload();

			});
		} 

    	
    }


    

});
common.controller('Common_dept_conroller', function($scope,$http,$timeout){

	$scope.submit_departments = function(){

		$('.submit_departments').submit();
	}
 

	$http.post('department_role/Get_dept_details')
	.then(function(response){
		//console.log(response.data); 

		$scope.dept_details = response.data;
		$scope.current_grid = 1;
	    $scope.data_limit = 5;  
	    $scope.CollegemaxSize = 5;
	    $scope.filter_data = $scope.dept_details.length;
	    $scope.entire_user = $scope.dept_details.length;

	});

	 
 
	$scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) { 
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

     

    $scope.delete_dept_details = function(dept_id){

    	if (confirm('Are you sure to delete..!')) {
		    $http.post('department_role/delete_dept_details',{'dept_id':dept_id})
			.then(function(response){
				 
				location.reload();

			});
		} 
    }

});

common.controller('Common_role_conroller', function($scope,$http,$timeout){
 
	$scope.submit_roles = function(){

		$('.submit_roles').submit(); 
	}
	 

	$http.post('department_role/Get_role_details')
	.then(function(response){
		console.log(response.data); 

		$scope.Role_details = response.data;
		$scope.current_grid = 1;
	    $scope.data_limit = 5;  
	    $scope.CollegemaxSize = 5;
	    $scope.filter_data = $scope.Role_details.length;
	    $scope.entire_user = $scope.Role_details.length;

	});
 
	$scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) { 
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

     

    $scope.delete_role_details = function(role_id){

    	if (confirm('Are you sure to delete..!')) {
		    $http.post('department_role/delete_role_details',{'role_id':role_id})
			.then(function(response){
				 
				location.reload();

			});
		} 
    }

});

common.controller('Common_email_conroller', function($scope,$http,$timeout){
 
	$scope.submit_emails = function(){

		$('.submit_emails').submit(); 
	}
	 

	$http.post('department_role/Get_email_details')
	.then(function(response){
		//console.log(response.data); 

		$scope.Role_details = response.data;
		$scope.current_grid = 1;
	    $scope.data_limit = 5;  
	    $scope.CollegemaxSize = 5;
	    $scope.filter_data = $scope.Role_details.length;
	    $scope.entire_user = $scope.Role_details.length;

	});
 
	$scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) { 
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

     

    $scope.delete_email_details = function(mail_id){

    	if (confirm('Are you sure to delete..!')) {
		    $http.post('department_role/delete_email_details',{'mail_id':mail_id})
			.then(function(response){
				 
				location.reload();

			});
		} 
    }

});


common.controller('Common_holiday_conroller', function($scope,$http,$timeout){
 
	$scope.submit_holidays = function(){

		$('.submit_holidays').submit(); 
	}
	 

	$http.post('department_role/Get_holiday_details')
	.then(function(response){
		//console.log(response.data); 

		$scope.Role_details = response.data;
		$scope.current_grid = 1;
	    $scope.data_limit = 5;  
	    $scope.CollegemaxSize = 5;
	    $scope.filter_data = $scope.Role_details.length;
	    $scope.entire_user = $scope.Role_details.length;

	});
 
	$scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) { 
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

     

    $scope.delete_holiday_details = function(holiday_event_id){

    	if (confirm('Are you sure to delete..!')) {
		    $http.post('department_role/delete_holiday_details',{'holiday_event_id':holiday_event_id})
			.then(function(response){
				 
				location.reload();

			});
		} 
    }

});


common.controller('Leave_policyController', function($scope,$http,$timeout){

	$('.no_periods').on('change', function(){

		var no_periods = $('.no_periods:checked').val();

		if(no_periods == 'on'){

			$('.hide_staff_alter').hide();

			$('#dept_1').removeAttr('required');
			$('#dept_staff1').removeAttr('required');
			$('#dept_staff1_hrs').removeAttr('required');
		}
		else{
			$('.hide_staff_alter').show();
			$('#dept_1').attr('required',true);
			$('#dept_staff1').attr('required',true);
			$('#dept_staff1_hrs').attr('required',true);


			
			
		}
	});

	$(".calc").load("leave_apply/Event_calander");

	$('.leave_from_date').on('change', function(){

		var from_date = $(this).val();

		var to_date = $('.leave_to_date').val();

		if(from_date == ''){

			$('.leave_from_date').parent('div').addClass('has-error');

		}
		else{

			$('.leave_from_date').parent('div').removeClass('has-error').addClass('has-success');

			if(to_date != ''){
				if(new Date(from_date) <= new Date(to_date)){

					$scope.date_diff(from_date,to_date);
				}
				else{
					$.alert('Todate is not allowed to be smaller than Fromdate ');

					$('.leave_to_date').val('');
					$('.total_leaves').val(0);
				}
			}
				
		}

			
	});


	$('.leave_to_date').on('change', function(){

		var from_date = $('.leave_from_date').val();

		var to_date = $(this).val();

		if(to_date == ''){

			$('.leave_to_date').parent('div').addClass('has-error');

		}
		else{

			$('.leave_to_date').parent('div').removeClass('has-error').addClass('has-success');

			if(from_date != ''){

				if(new Date(from_date) <= new Date(to_date)){

					$scope.date_diff(from_date,to_date);
				}
				else{
					$.alert('Todate is not allowed to be smaller than Fromdate ');

					$(this).val('');

					$('.total_leaves').val(0);
				}
			}
				
		}

			
	});

	$scope.date_diff = function(from_date,todate){

		$('.leave_day_type').empty();

		var d1 = new Date(from_date);
	    var d2 = new Date(todate);


		    var oneDay = 24*60*60*1000;
		    var diff = 0;
		    if (d1 && d2) { 
		  
		      diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));
		    }

		      var two_date_diff = parseInt(diff) + parseInt(1);

		     

		      if(two_date_diff <= 1){

		      	$('.leave_day_type').append(
		      		' <label for="password">Leave </label>'	+
		      		'<div class="form-line">'+
			      		'<select class="form-control show-tick leave_day_type" name="leave_day_type" required onclick="check_leave_val(this)">'+
	                        '<option value="">-- Please select --</option>'+
	                        '<option value="HD" style="display">Halfday</option>'+
	                        '<option value="FD">Fullday</option>'+
	                         
	                    '</select>'+
                    '</div>'

		      	);

		      }
		      else{
		      		$('.leave_day_type').append(
		      			' <label for="password">Leave </label>'+
		      			'<div class="form-line">'+
				      		'<select class="form-control show-tick leave_day_type" name="leave_day_type" required onclick="check_leave_val(this)">'+
		                        '<option value="">-- Please select --</option>'+
		                        
		                        '<option value="FD">Fullday</option>'+
		                         
		                    '</select>'+
						 '</div>'	                    

		      	);
		      }

		    $('.total_leaves').val(two_date_diff);

		     

		    // Get Employee Leave Ploicy

		    $http.post('leave_apply/getLeave_policy',{'fromdate':from_date,'todate':todate,'no_days':two_date_diff})
		    .then(function(responce){

		    	console.log(responce.data);

		    	if(responce.data == 'Already_Exist'){

		    		$.alert('Already Apply on this date, Please Cancel and Re-apply'); 

		    		$('.leave_from_date').val('');
					$('.leave_to_date').val('');
		    	}
		    	else{
		    		$scope.LeaveDetails = responce.data;
		    	}

		     

		    	
		    });

		//console.log(from_date,todate,diff);
	}


 	$('#dept_1').on('change', function(data){
 		var dept_1 = $(this).val();

 		$scope.Get_staff_details = [];

 		if(dept_1 != ''){

 			$http.post('leave_apply/Get_dept_staffs',{'dept_id':dept_1})
	 		.then(function(responce){


	 			$scope.Get_staff_details = responce.data;

	 		});
 		}
 		 
 		  
 	});

 	$('#dept_2').on('change', function(data){
 		var dept_2 = $(this).val();

 		$scope.Get_staff_details2 = [];

 		if(dept_2 != ''){

 			$http.post('leave_apply/Get_dept_staffs',{'dept_id':dept_2})
	 		.then(function(responce){
 
	 			$scope.Get_staff_details2 = responce.data;

	 		});
 		}
 		 
 		  
 	});


	$http.post('leave_apply/Get_leave_details')
	.then(function(response){
		console.log(response.data); 

		$scope.Leave_details = response.data;
		$scope.current_grid = 1;
	    $scope.data_limit = 10;  
	    $scope.CollegemaxSize = 5;
	    $scope.filter_data = $scope.Leave_details.length;
	    $scope.entire_user = $scope.Leave_details.length;

	});
 
	$scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) { 
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

	$scope.leave_apply_form = function(){



		 $('.leave_apply_form').submit();

		 $(".leave_sub_button").attr("disabled", true);
        return true;
	}

	$scope.delete_leave_apply = function(emp_leave_id,staff_id){

		 


		$.confirm({
		    title: 'Leave Request',
		    content: 'Are you sure to cancel Leave!',

		    buttons: {
		        Ok: function () {	           
		        	 
		        	$http.post('leave_apply/cancel_leave',{'emp_leave_id':emp_leave_id,'staff_id':staff_id})
		        	.then(function(responce){
		        		 
 						location.reload();
		        	});  
		            
		        },
		        cancel: function () {
		            //$.alert('Canceled!');
		        }
		    }
		});

		 
	}

});

common.controller('Approve_LeaveController', function($scope,$http,$timeout){

	$http.post('approve_leave/Get_req_list',{'level_type':1})
	.then(function(response){	

			console.log(response.data);	 

			$scope.leave_count = response.data['leave_count'];
			$scope.leave_count_his = response.data['leave_count_his'];		 

			$scope.Leave_details = response.data['leave_management'];
			$scope.current_grid = 1;
		    $scope.data_limit = 10;  
		    $scope.CollegemaxSize = 5;
		    $scope.filter_data = $scope.Leave_details.length;
		    $scope.entire_user = $scope.Leave_details.length;
	});

	$scope.get_leave_req = function(level_type){




		$http.post('approve_leave/Get_req_list',{'level_type':level_type})
		.then(function(response){	
  			console.log(response.data);

			$scope.leave_count = response.data['leave_count'];
			$scope.leave_count_his = response.data['leave_count_his'];		 

			$scope.Leave_details = response.data['leave_management'];
			$scope.current_grid = 1;
		    $scope.data_limit = 10;  
		    $scope.CollegemaxSize = 5;
		    $scope.filter_data = $scope.Leave_details.length;
		    $scope.entire_user = $scope.Leave_details.length;
 
		});


	}

	 
	$scope.page_position = function(page_number) {
        $scope.current_grid = page_number;
    };
    $scope.filter = function() {
        $timeout(function() {
            $scope.filter_data = $scope.searched.length;
        }, 20);
    };
    $scope.sort_with = function(base) { 
        $scope.base = base;
        $scope.reverse = !$scope.reverse;
    };

	$scope.leave_apply_form = function(){

		 $('.leave_apply_form').submit();
	}

	$scope.accept_leave_apply = function(emp_leave_id,staff_id,role_type){ 

		//console.log(emp_leave_id,staff_id,role_type);


		$http.post('approve_leave/Approve_leave_req',{'emp_leave_id':emp_leave_id,'staff_id':staff_id,'role_type':role_type})
		.then(function(response){

			 location.reload(); 
		});
	}


	$scope.reject_leave_apply = function(emp_leave_id,staff_id,role_type,reject_reason){

		//console.log(emp_leave_id,staff_id,role_type,reject_reason);


		if(reject_reason != undefined){
		 

			$.confirm({
			    title: 'Reject Request',
			    content: 'Are you sure to Reject Leave!',

			    buttons: {
			        Ok: function () {	            
			        	 
			        	$http.post('approve_leave/Reject_leave_req',{'emp_leave_id':emp_leave_id,'staff_id':staff_id,'role_type':role_type,'reject_reason':reject_reason})
						.then(function(response){
							console.log(response.data);

 							 location.reload();
						});  
			            
			        },
			        cancel: function () {
			            //$.alert('Canceled!');
			        }
			    }
			});
		}	
		else{
			$.alert('Please Enter Reason..');
		}

	}


	$scope.get_leave_policy_details = function(emp_leave_id){


		$http.post('approve_leave/get_leave_policy_details',{'emp_leave_id':emp_leave_id})
		.then(function(responce){
			console.log(responce.data);

			$scope.StaFf_details = responce.data;
		});
	}

});


common.controller('alter_reqController', function($scope,$http,$timeout){

	$scope.alter_staff_details = function(alter_id,leave_id,staff_type,total_approval,status){

		if(status == 1){
			var txt = 'Are you sure want to Approve..!';
		}
		else{
			var txt = 'Are you sure want to Reject..!';
		}

		if (confirm(txt)) {

			$http.post('index/alter_staff_details',{'alter_id':alter_id,'leave_id':leave_id,'staff_type':staff_type,'total_approval':total_approval,'status':status})
			.then(function(responce){

				console.log(responce.data);

				//$('.remove_leave'+alter_id).hide();
 				location.reload();
			});
		}	 
	}
});

common.controller('Change_password_conroller', function($scope,$http,$timeout){ 

	$scope.change_password = function(){

		var pass = 	$('.newpassword').val();

		var cn_pass = $('.confrimpassword').val();

		if(pass.length <= 8)
		{

			$.alert('Password should contain at least 8 characters');
		}
		else if(pass != cn_pass)
		{

			$.alert('Password Not Matched');
		}
		else{
			
			$('.change_password').submit();
		}

	}

});





