<section class="content"  >  
	<div class="container-fluid">
            
		<div class="block-header">
            <h2>College Details</h2>
        </div>

        <div class="conteiner-fluid">
        	<div class="col-sm-4">
                
                    <div class="card">
                        <div class="header">
                            <h2>Add College Details</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST"  >
                                <div class="form-group form-float ">
                                    <div class="form-line  college_form">
                                        <input type="text"   class="form-control college_form" name="college_name" required aria-required="true" aria-invalid="true">
                                        <input type="hidden"   class="form-control college_id" name="college_id" required aria-required="true" aria-invalid="true">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <label class="form-label">College Name</label>
                                    </div>
                                </div>    

                                <div class="form-group form-float">

                                    <div class="form-line  ">
                                        <textarea class="form-control college_form"   name="colleg_addr"  type="text" required aria-required="true" rows="5" ></textarea>
                                        <label class="form-label">College Address</label>
                                    </div>
                                </div>    

                                <!-- <div class="form-group form-float">
                                    <div class="form-line  ">
                                        <input type="file" class="form-control" name="college_name" required="" aria-required="true" aria-invalid="true">
                                        <label class="form-label">College Logo</label>
                                    </div>
                                </div> -->  

                                <!-- <div class="form-group form-float">
                                    <div class="form-line  ">
                                        <input type="text" class="form-control" name="college_name" required aria-required="true" aria-invalid="true">
                                        <label class="form-label">College Logo</label>
                                    </div>
                                </div>   -->

                                  
                                <div class="form-group form-float">
                                    <div class="form-line  ">
                                        <input type="text"     class="form-control college_form" name="college_latitude" required aria-required="true" aria-invalid="true">
                                        <label class="form-label">College latitude </label>
                                    </div>
                                </div> 

                                <div class="form-group form-float">
                                    <div class="form-line  ">
                                        <input type="text"   class="form-control college_form" name="college_longitude" required aria-required="true" aria-invalid="true">
                                        <label class="form-label">College longitude </label>
                                    </div>
                                </div>
                                    <br>
                              
                                <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                        
            </div>

            <div class="col-sm-8" ng-controller="Common_conroller" ng-app="Common_app">
                
                    <div class="card">
                        <div class="header">
                            <h2>View College Details</h2>
                            
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                    
                                <div class="row">
                                    <!-- <div class="col-sm-2 pull-left">
                                        <label>PageSize:</label>
                                        <select ng-model="data_limit" ng-change="dssdasd(data_limit)" class="form-control">
                                          
                                            <option>10</option>
                                            <option>20</option>
                                            <option>50</option>
                                            <option>100</option>
                                        </select>
                                    </div> -->
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
                                                    <th>Address</th>
                                                    <th>latitude </th>
                                                    <th>longitude </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="data in searched = (college_details | filter:search | orderBy : base :reverse) | beginning_data:(current_grid-1)*data_limit | limitTo:data_limit">
                                                    <td>{{(current_grid*10 - 9)+ $index}}</td>
                                                    <td>{{data.college_name}}</td>
                                                    <td>{{data.college_addr}}</td>
                                                    <td>{{data.college_latitude}}</td>
                                                    <td>{{data.college_longitude}}</td>

                                                    <td style="    width: 3cm;">
                                                        <button type="button" class="btn btn-danger waves-effect"  ng-click="delete_college_details(data.college_id)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        <button type="button" class="btn btn-primary waves-effect   "  ng-click="edit_college_details(data.college_id)"><i class="fa fa-pencil" aria-hidden="true"></i></button>
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

		//alert(4545);
	});
</script>