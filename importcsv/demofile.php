<?php
$conn = mysqli_connect("localhost", "root", "", "leadsubmit");

if (isset($_POST["upload"])) {
echo "<pre>";
    print_r($conn);exit;
    
    $fileName = $_FILES["employee_file"]["tmp_name"];
    
    if ($_FILES["employee_file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {  
            echo "<pre>";
            print_r($column);exit;
             $sqlInsert ="INSERT INTO `lead_data`(`CALL_ID`, `TIME_STAMP`, `CAMPAIGN`, `CALL_TYPE`, `AGENT`, `AGENT_NAME`, `DISPOSITION`, `ANI`, `CUSTOMER_NAME`, `DNIS`, `CALL_TIME`, `TALK _TIME`, `AFTER_CALL_WORK_TIME`, `TRANSFERS`, `CONFERENCES`, `HOLDS`, `RECORDINGS`) VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','".$column[5]."','".$column[6]."','".$column[7]."','".$column[8]."','".$column[9]."','".$column[10]."','".$column[11]."','".$column[12]."','".$column[13]."','".$column[14]."','".$column[15]."','".$column[16]."')";
         
            $result = mysqli_query($conn, $sqlInsert);            
            if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
</head>
<body>

<div class="container mt-3">
  <h2>CSV Import</h2>
  
   <form method="post" action="" enctype="multipart/form-data" id="myform">
    <p>Upload</p>
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="filename">
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>
    <div class="mt-3">
      <button class="btn btn-primary" id="csvupload">Submit</button>
    </div>
  </form>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $("#myform").validate({
        rules:{
           filename:{
            required:true
           }
        },
       
        submitHandler: function(form) {
            $("#csvupload").click(function(){

                var fd = new FormData();
                var files = $('#customFile')[0].files[0];
                fd.append('file',files);

                $.ajax({
                    url: 'csvupload.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                       $('#myModal').show();
                    },
                });
            });
        },
    });
    
});

$("#contactForm").validate({
        
        rules: {
            name: "required",
            phone: "required",
            recaptcha_response_field: "required",
            email: {
                required: true,
                email: true
            }
            
        },// end rules
        messages: {
            name: "Please enter your name",
            recaptcha_response_field: "Please Complete",
            phone: "Please enter Your Phone Number",
            email: "Please enter a valid email address",
            
        },// end messages
        
        submitHandler: function(form) {
        
        var form = $("#contactForm"); // contact form
  var submitButton = $("#submitContact");  // submit button
  var message = $('#ajaxMessage'); // alert div for show alert message
    
    $.ajax({
        
        
      url: 'ppmailcontactajax.php', // form action url
      
      type: 'POST', // form submit method get/post
      dataType: 'html', // request type html/json/xml
    data: $("#contactForm").serialize(), // serialize form data 
      beforeSend: function() {
        message.fadeOut();
        submitButton.html('Sending....'); // change submit button text
      },
      success: function(data) {
    
    var response = $.parseJSON(data);
    
        message.html(response.message).fadeIn(); // fade in response data
        form.trigger('reset'); // reset form
        submitButton.val('Send Email'); // reset submit button text
      },
      error: function(e) {
        console.log(e)
      }
    });
 
        
        
        
}// end submit handler
         
         
    });  //end validate


  

</script>

</body>
</html>




<!DOCTYPE html>
<html>

<head>
<!-- <script src="jquery-3.2.1.min.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>
body {
  font-family: Arial;
  width: 550px;
}

.outer-scontainer {
  background: #F0F0F0;
  border: #e0dfdf 1px solid;
  padding: 20px;
  border-radius: 2px;
}

.input-row {
  margin-top: 0px;
  margin-bottom: 20px;
}

.btn-submit {
  background: #333;
  border: #1d1d1d 1px solid;
  color: #f0f0f0;
  font-size: 0.9em;
  width: 100px;
  border-radius: 2px;
  cursor: pointer;
}

.outer-scontainer table {
  border-collapse: collapse;
  width: 100%;
}

.outer-scontainer th {
  border: 1px solid #dddddd;
  padding: 8px;
  text-align: left;
}

.outer-scontainer td {
  border: 1px solid #dddddd;
  padding: 8px;
  text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

      $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
              $("#response").addClass("error");
              $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import CSV file into Mysql using PHP</h2>
    
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="file" name="file"
                        id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>

        </div>
              
    </div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $("#frmCSVImport").validate({
        rules:{
           file:{
            required:true
           }
        },
       
        submitHandler: function(form) {
                var fd = new FormData();
                $.ajax({
                    url: 'csvupload.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                       $('#myModal').show();
                    },
                });
        },
    });
    
});

</script>

</body>

</html>