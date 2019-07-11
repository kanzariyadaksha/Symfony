<?php  
$conn = mysqli_connect("localhost", "root", "", "leadsubmit");
 $query = "SELECT * FROM tbl_employee ORDER BY id desc";  
 $result = mysqli_query($conn, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Import CSV</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:900px;">  
                <h2 align="center">Import CSV File </h2>  
                <h3 align="center">Call Center Data</h3><br />  
                <form id="upload_csv" method="post" enctype="multipart/form-data">  
                     <div class="col-md-3">  
                          <br />  
                          <label>Add More Data</label>  
                     </div>  
                     <div class="col-md-4">  
                          <input type="file" name="employee_file" style="margin-top:15px;" id="employee_file" accept=".csv"/>  
                     </div>  
                     <div class="col-md-5">  
                          <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />  
                     </div>  
                     <div style="clear:both"></div>  
                </form> 

                <br /><br /><br />  
                <div class="table-responsive" id="employee_table">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="5%">CALL_ID</th>  
                               <th width="25%">TIME_STAMP</th>  
                               <th width="35%">CAMPAIGN</th>  
                               <th width="10%">CALL_TYPE</th>  
                               <th width="20%">AGENT</th>  
                               <th width="5%">AGENT_NAME</th>
                               <th width="5%">DISPOSITION</th>  
                               <th width="5%">ANI</th>  
                               <th width="5%">CUSTOMER_NAME</th>  
                               <th width="5%">DNIS</th>  
                               <th width="5%">CALL_TIME</th>
                               <th width="5%">TALK _TIME</th>  
                               <th width="5%">AFTER_CALL_WORK_TIME</th>
                               <th width="5%">CONFERENCES</th>
                               <th width="5%">HOLDS</th>
                               <th width="5%">RECORDINGS</th>         
                          </tr>  
                          <?php  
                          if($result > 0){
                          while($row = mysqli_fetch_array($result))  
                          {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["CALL_ID"]; ?></td>  
                               <td><?php echo $row["TIME_STAMP"]; ?></td>  
                               <td><?php echo $row["CAMPAIGN"]; ?></td>  
                               <td><?php echo $row["CALL_TYPE"]; ?></td>  
                               <td><?php echo $row["AGENT"]; ?></td>  
                               <td><?php echo $row["AGENT_NAME"]; ?></td>
                               <td><?php echo $row["DISPOSITION"]; ?></td>  
                               <td><?php echo $row["ANI"]; ?></td>  
                               <td><?php echo $row["CUSTOMER_NAME"]; ?></td>  
                               <td><?php echo $row["DNIS"]; ?></td>  
                               <td><?php echo $row["CALL_TIME"]; ?></td>  
                               <td><?php echo $row["TALK _TIME"]; ?></td>  
                               <td><?php echo $row["AFTER_CALL_WORK_TIME"]; ?></td>
                               <td><?php echo $row["CONFERENCES"]; ?></td>
                               <td><?php echo $row["HOLDS"]; ?></td>  
                               <td><?php echo $row["RECORDINGS"]; ?></td>  



                          </tr>  
                          <?php  
                           }
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  

           <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Lead Submit Successfully</h4>
                    </div>
                    <div class="modal-body">
                      <p>CSV Uploaded.............</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  
                </div>
             </div>


      </body>  
 </html>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
 <script>  
      $(document).ready(function(){  
        $("#upload_csv").validate({
            rules:{
               employee_file:{
                required:true
               }
            },
       
            submitHandler: function(form) {
                   $('#upload_csv').on("submit", function(e){  
                      $.ajax({  
                           url:"csvupload.php",  
                           method:"POST",  
                           data:new FormData(this),  
                           contentType:false,        
                           cache:false,                 
                           processData:false,     
                           success: function(data){  
                              
                             $('#employee_table').html(data);
                             $('#myModal').modal('show');  
                           }  
                      })  
                  })
            },
        });
    });

      
 </script>  