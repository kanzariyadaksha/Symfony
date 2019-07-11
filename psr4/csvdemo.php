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

</script>

</body>
</html>