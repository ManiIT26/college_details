 

<section class="content"  >
    <div class="container-fluid">
            
        <div class="block-header">
            <h2>Bio Metrics</h2>
        </div>

       
        <div class="conteiner-fluid">
            

            <div class="col-sm-12">
                
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Bio Metrics</h2>
                            
                        </div>
                        <div class="body "> 
                             
                                <form method="post" class="get_attd_log" enctype="multipart/form-data"> 
                                    <div class="row clearfix"> 
                                       
                                       
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="hidden" name="college_id" class="hidden_college_val" value="<?php echo $this->session->userdata('college_id'); ?>">
                                                    <input type="file" id="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="biometric_upload" class="form-control" placeholder="Enter Confrim password" required="">
                                                 </div>
                                            </div>
                                        </div>     
                                         
                                        
                                       

                                     
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <input type="checkbox" id="remember_me_5" class="filled-in">
                                         
                                       <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                             
                        </div>
                    </div>
            </div>
                        
        </div>
    </div>
</section>        