<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>FLM Data Submission Engine</title>



    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" crossorigin="anonymous" />



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->



    <style type="text/css">

        body, table {

            font-size: 12px;

        }

        td.page,

        td.query_string,

        td.referrer,

        td.created_at {

            white-space: nowrap;

        }

        td.query_string,

        td.referrer,

        td.tries,

        td.created_at,

        td.cakestatus{

            color: #66c;

        }

        td.id a {

            font-weight: bold;

        }

        td.id a:hover {

            text-decoration: underline;

        }

        tr:hover {

          background-color: #ddf !important;

        }

        .toClick {

          background-color: #dfd !important;

        }

        .noCake {

          background-color: #faa !important;

        }

    </style>

</head>

<body>

  <div class="row" style="margin: 10px;">

  <form class="form-inline" action="?authKey=b7hak8w2nKDb2KS2n0d" method="post">

      <div class="col-md-2">
          <?php 
          if (strpos($_SERVER['REQUEST_URI'], 'zeta_read') !== false) { ?>
              <a href="/local_storage/read/?authKey=b7hak8w2nKDb2KS2n0d" class="btn btn-primary">View Cake Leads</a>
          <?php } else {?>
              <a href="/local_storage/zeta_read/?authKey=b7hak8w2nKDb2KS2n0d" class="btn btn-primary">View Zeta Leads</a>
          <?php }?>
      </div>

      <div class="col-md-2">

          <input type="submit" name="export" value="Export as CSV" class="btn btn-primary" />

      </div>

      <div class="col-md-8">

          <div class="form-group">

              <div class='input-group date' id='datetimepicker1'>

                  <span class="input-group-addon">

                      From:

                  </span>

                  <input type='text' class="form-control" name="starttime" value="<?= (!empty($startTime)) ? $startTime : '' ?>" />

                  <span class="input-group-addon">

                      <span class="glyphicon glyphicon-calendar"></span>

                  </span>

              </div>

          </div>

          <div class="form-group">

              <div class='input-group date' id='datetimepicker2'>

                  <span class="input-group-addon">

                      To:

                  </span>

                  <input type='text' class="form-control" name="endtime" value="<?= (!empty($endTime)) ? $endTime : '' ?>" />

                  <span class="input-group-addon">

                      <span class="glyphicon glyphicon-calendar"></span>

                  </span>

              </div>

          </div>

          <div class="form-group">

              <div class='input-group'>

                  <input type='submit' class="btn btn-success" name="filter" value="Filter Data" />

              </div>

          </div>

          <div class="form-group">

              <div class='input-group'>

                  <a href="?authKey=b7hak8w2nKDb2KS2n0d" class="btn btn-primary">Clear Filter</a>

              </div>

          </div>

          <div class="form-group" style="text-align: right">

              <div class='input-group'>
                  <a href="../logout.php" class="btn btn-primary">Logout</a>

              </div>

          </div>

      </div>

  </form>

</div>



<?php

echo $header;

echo $body;

?>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->

<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">

    $('#datetimepicker1').datetimepicker({

        format: 'YYYY-MM-DD HH:mm',

        locale: 'en',

        useCurrent: true

    });

    $('#datetimepicker2').datetimepicker({

        format: 'YYYY-MM-DD HH:mm',

        locale: 'en',

        useCurrent: true

    });

</script>



</body>

</html>