 

<section class="content"  >
    <div class="container-fluid">
            
        <div class="block-header">
            <h2>Attendance Log</h2>
        </div>

       
        <div class="conteiner-fluid">
            

            <div class="col-sm-12">
                
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Time Duration</h2>
                            
                        </div>
                        <div class="body "> 
                             
                                <form method="post" class="get_attd_log"> 
                                    <div class="row clearfix"> 
                                       
                                        <?php if($this->session->userdata('user_type') == 'super_admin'){ ?>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line"  >                                   

                                                    <select class="form-control show-tick" name="college_name">
                                                        <option value="">-- Please select --</option>
                                                        <?php foreach($get_college_details as $college_details){ ?>
                                                            <option <?php if(isset($college_name)){ if($college_name == $college_details['college_id']){ echo 'selected'; } } ?> value="<?php echo $college_details['college_id'] ?>" ><?php echo $college_details['college_name'] ?></option>
                                                         <?php }?>
                                                    </select>
                                                   
                                                </div>
                                            </div>
                                        </div>     
                                         <?php }else{?>
                                                <input type="hidden"  value="<?php echo $this->session->userdata('college_id') ?>" name="college_name" class="form-control" placeholder="Enter  Department" required>

                                                <input type="hidden"  value="<?php echo $user['approve_type']; ?>" name="approve_type" class="form-control" placeholder="Enter  Department" required>
                                        <?php }?>
                                        
                                       

                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="from_date_log" value="<?php if(isset($from_date)){ echo $from_date;} ?>" class="form-control common_date_picker_attd" placeholder="YYYY-MM-DD">
                                            </div>
                                        </div>
                                    </div>
                                     
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <input type="checkbox" id="remember_me_5" class="filled-in">
                                         
                                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect"><i class="material-icons">search</i></button>
                                    </div>
                                </div>
                            </form>
                             
                        </div>
                    </div>
            </div>
                        
        </div>
    </div>
</section>        