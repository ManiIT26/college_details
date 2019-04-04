var common = angular.module('Test_app',['ui.bootstrap']);
common.filter('beginning_data', function() {
    return function(input, begin) {
        if (input) {
            begin = +begin;
            return input.slice(begin);
        }
        return [];
    }
});



common.controller('Test_staff_conroller', function($scope,$http,$timeout){ 

	$scope.submit_staff = function(){

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
			
			$('.submit_staff').submit();
		}

		
	}

	$http.post('staff_details/Get_staff_details')
	.then(function(response){
		//console.log(response.data); 

		$scope.staff_details = response.data;
		$scope.current_grid = 1;
	    $scope.data_limit = 25;  
	    $scope.CollegemaxSize = 5;
	    $scope.filter_data = $scope.staff_details.length;
	    $scope.entire_user = $scope.staff_details.length;

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

     

    $scope.delete_staff_details = function(s_id){

    	if (confirm('Are you sure to delete..!')) {
		    $http.post('staff_details/delete_staff_details',{'s_id':s_id})
			.then(function(response){
				 console.log(response.data);
				location.reload();

			});
		} 
    }

     $scope.edit_staff_details = function(s_id){

    	

    	$http.post('staff_details/edit_staff_details',{'s_id':s_id})
		.then(function(response){
 				
 				console.log(response.data['reporting_person_2']);

				 
				$('.college_name_select option[value="'+response.data['college_id']+'"]').prop('selected',true);

				$('.college_name_select').change();

				$('.staff_type option[value="'+response.data['staff_type']+'"]').prop('selected',true);

				$('.attendance_type option[value="'+response.data['staff_type']+'"]').prop('selected',true);

				$('.staff_type').change();

				$('.approve option[value="'+response.data['approve_type']+'"]').prop('selected',true);

				$('.approve_type').change();

				$scope.reporting_person1_role = response.data['reporting_person_1'];

				$scope.reporting_person2_role = response.data['reporting_person_2'];

				/*$('.reporting_person1_role').val(response.data['reporting_person_1']);

				$('.reporting_person2_role').val(response.data['reporting_person_2']);*/

				$scope.clg_department = response.data['department_id'];

				$scope.role_staff = response.data['role_id'];

				$('.clg_department option[value="'+response.data['department_id']+'"]').prop('selected',true);
				$('.role option[value="'+response.data['role_id']+'"]').prop('selected',true);

				$('.gender option[value="'+response.data['gender']+'"]').prop('selected',true);
				$('.approve option[value="'+response.data['approve_type']+'"]').prop('selected',true);

			


			$scope.View_staffs = response.data;
			
			 
			/*$('input[name=college_id]').val(response.data['college_id']);
			$('input[name=college_name]').val(response.data['college_name']).focus();
			$('textarea[name=colleg_addr]').val(response.data['college_addr']).focus();
			$('input[name=college_latitude]').val(response.data['college_latitude']).focus();
			$('input[name=college_longitude]').val(response.data['college_longitude']).focus();*/
 

		});

    }

    $('.college_name_select').on('change', function(){

    	$http.post('staff_details/Get_dept_roles',{'college_id':$(this).val()})
		.then(function(responce){
			 $scope.Dept_details = responce.data['dept'];
			 $scope.Role_details = responce.data['role'];
		});
    });

    var hidden_college_val = $('.hidden_college_val').val();

    if(hidden_college_val != undefined || hidden_college_val != ''){
    	 $http.post('staff_details/Get_dept_roles',{'college_id':hidden_college_val})
		.then(function(responce){
			 $scope.Dept_details = responce.data['dept'];
			 $scope.Role_details = responce.data['role'];
		});
    }


   $('.approve_type').on('change', function(){

   		var approve_type = $(this).val();

   		//console.log(approve_type);

   		if(approve_type == 1){
   			$('.reorting_person_1').show();
   			$('.reorting_person_2').hide(); 

   			$('.reporting_person1_role').attr('required',true);
   			$('.reporting_person2_role').removeAttr('required');
   		}
   		else if(approve_type == 2){
   			$('.reorting_person_1').show();
   			$('.reorting_person_2').show();

   			$('.reporting_person1_role').attr('required',true);
   			$('.reporting_person2_role').attr('required',true);

   		}
   		else{
   			$('.reorting_person_1').hide();
   			$('.reorting_person_2').hide();
   			$('.reporting_person1_role').removeAttr('required');
   			$('.reporting_person2_role').removeAttr('required');
   		}
   });

   $scope.get_reporting_person = function(reporting_person){

   		if(reporting_person != '' || reporting_person != undefined){

   			$http.post('staff_details/Get_reporting_person',{'reporting_person':reporting_person})
   			.then(function(responce){

   				console.log(responce.data);

   				$scope.Reporting_person = responce.data;

   			});
   		}
   }
    

});





