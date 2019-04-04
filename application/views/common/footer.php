<!-- Jquery Core Js -->
    

    <!-- Select Plugin Js -->
    <script src="assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/morrisjs/morris.js"></script>
    <script src="assets/js/input_mask.js"></script>
    <script src="assets/test.js"></script>


    <!-- ChartJs  
    <script src="assets/plugins/chartjs/Chart.bundle.js"></script>

    
    <script src="assets/plugins/flot-charts/jquery.flot.js"></script>
    <script src="assets/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="assets/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="assets/plugins/flot-charts/jquery.flot.time.js"></script>

     
    <script src="assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    -->

    <!-- Custom Js -->
    <script src="assets/js/admin.js"></script>
     <script src="assets /js/pages/ui/modals.js"></script>
    <!--<script src="assets/js/pages/index.js"></script>-->

    <!-- Demo Js -->
    <script src="assets/js/demo.js"></script>

    <script src="assets/js/common.js"></script>
    <script src="assets/js/jquery_confirm.js"></script>
    <script src="assets/js/bootstrap_datepicker.js"></script>



    <script type="text/javascript">
        function add_attendance(staff_id,college_id,attendance_type){

            
            if(attendance_type == 2){
              
                var attendance_log = 'Present'
                attendance_type = 1;
            }
            else if(attendance_type == 0){
                $('.attendance_add').attr('data-target','#smallModal');
                 var attendance_log = $('.attendance_log').val();

                if(attendance_log != ''){

                    $('#smallModal').modal('hide');
                }
                else{
                    $('.error').text('Please Choose Log');
                }
                
            }
            else{
                $('.attendance_add').removeAttr('data-target');
                 
                var attendance_log = 'Present';
              
            }

            

            if(attendance_log != ''){
                $.ajax({

                    type:'post',
                    url:'staff_details/Insert_attd',
                    data:{'staff_id':staff_id,'college_id':college_id,'attendance_type':attendance_type,'log':attendance_log},
                    success:function(data){
                         location.reload();    
                    }
                });
            }
                
             

        }


        function close_modal(){

            location.reload();   
        }
 
    </script>
</body>

</html>
<style>
.collapse-nav {
	display: block !important;
	text-align: center;
}
.navbar-toggle{
	display:none;
}
.dl-horizontal dd {
   padding: 7px;
}
</style>