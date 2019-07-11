<?php 
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>1099 Tax Help - Partner List</title>
     <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="assets/css/tc.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600" rel="stylesheet">
  </head>
  <body class="terms">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-center justify-content-sm-between fixed-top">
        <a class="navbar-brand" href="/rideshare/index.php">
          <img class="logo-img img-fluid" src="images/logo.png" alt="logo">
        </a>
        <!-- <div class="header-call-info text-center d-none d-sm-block"> -->
          <!-- <div class="header-call-info d-none d-sm-block">
            <label>For More Information call:</label>
            <a class="click-to-call d-block" href="tel:8555937983">855-593-7983</a>
          </div> -->
      </nav>
      
      <div id="form-container" class="container-fluid">
      	<div id="privacy" class="partner-list clearfix">

            <h1>Partner List</h1>
            <ul>
                <?php
                $partners = file('http://www.freshstart-initiative.net/partners.txt');
                natcasesort($partners);
                foreach($partners as $partner)
                {
                    echo "    <li>$partner</li>\n";
                }
                ?>
            </ul>
            
        </div>
      </div>
  </body>
</html>
