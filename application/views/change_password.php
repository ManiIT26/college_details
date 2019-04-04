 

<section class="content"   ng-app="Common_app">
        <div class="conteiner-fluid" ng-controller="Change_password_conroller" >
            

            <div class="col-sm-6">
                
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Change Password</h2>
                            
                        </div>
                        <div class="body "> 
                             
                                <form method="post"  class="change_password" ng-submit="change_password()"> 
                                    <div class="row clearfix"> 
                                       
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="old_password" value="" class="form-control" placeholder="Enter Old Password">
                                            </div>
                                         </div>

                                         <div class="form-group"> 
                                            <div class="form-line">
                                                <input type="password" name="new_password" value="" class="form-control newpassword" placeholder="Enter New Password">
                                            </div>
                                          </div>
                                        <div class="form-group">  
                                            <div class="form-line">
                                                <input type="password" name="confirm_password" value="" class="form-control confrimpassword" placeholder="Enter Confirm Password">
                                            </div>
                                         </div>   

                                    </div>
                                 </div>
                                         <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                            </form>
                             
                        </div>
                    </div>
            </div>
                        
        </div>

</section>        