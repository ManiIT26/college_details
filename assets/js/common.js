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

common.controller('Common_conroller', function($scope,$http,$timeout){

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
 

	$http.post('department_role/Get_dept_details')
	.then(function(response){
		console.log(response.data); 

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


