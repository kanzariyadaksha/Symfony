<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 6/9/16
 * Time: 1:43 PM
 */
return false;
// added to make sure the exit pop ONLY fires for variants that specifically allow it
if(!isset($hasExitPop)) return;
?>


  <link href="/includes/bootstrap_modals/css/bootstrap.css" rel="stylesheet" > 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> 


 

<style>
	@import url(https://fonts.googleapis.com/css?family=Open+Sans);
	#exitModal {
	  font-family:'Open Sans',sans-serif;
	  font-size:14px;
	  line-height:1.42857143;
	}
    #exitModal img {
      height: auto;
      margin: 0;
      border-radius: 10px;
    }
    #exitModal .modal-content {
      border-radius: 0;
    }
    #exitModal .modal-header {
      background-color: #00a8cf;
      border-color: #0097bd;
      color: white;
      text-align:center;
    }
    #exitModal .modal-header h4 {
      color: white;
      font-weight: bold;
      font-size: 22px;
    }
    #exitModal .modal-body {
      text-align: left;
      padding-top: 30px;
      padding-bottom: 30px;
    }
    #exitModal .modal-body h3 {
      margin-top: 0;
      font-weight: bold;
      text-align: left;
      line-height: 1.3;
    }
    #exitModal .modal-body label {
      font-weight: normal;
      display: block;
      color: #bbb;
      margin-bottom: 5px;
    }
    #exitModal .modal-body .form-control {
      width: 100%;
      border-radius: 0;
    }
    
    #exitModal .modal-body .input-lg {
      height: 46px;
      padding: 10px 16px;
      font-size: 18px;
      line-height: 1.3333333;
	}
    
    #exitModal .modal-body .btn-primary {
      background-color: #00a8cf;
      border-radius: 0;
      border: 0;
      padding: 15px 0;
      border-bottom: 5px solid #007f9c;
    }
    #exitModal .modal-body .btn-primary:hover,
    #exitModal .modal-body .btn-primary:active,
    #exitModal .modal-body .btn-primary:focus {
      background-color: #007f9c;
    }
    
    #exitModal .modal-body .text-center {
    	text-align:center;
    }
    
    #exitModal .modal-body .text-muted {
      color: #777;
    }

</style>


<!-- Modal -->
<div id="exitModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="https://www.getdrip.com/forms/99285300/submissions" method="post" data-drip-embedded-form="99285300">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" data-drip-attribute="headline">Top 10 Mistakes to Avoid with your IRS Debt</h4>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-sm-6">
            <img class="img-responsive" src="/lf1/images/1.png"/>
          </div>
          <div class="col-sm-6">
              <div data-drip-attribute="description">IRS Debt is complicated. Discover the easy-to-fix mistakes that can land you into hot water...<br/><br/>Where should I send this free whitepaper...</div>
              <div>
                <label for="fields[email]">Email Address</label>
                <input type="email" name="fields[email]" class="form-control input-lg" value="" placeholder="Your Email Address" />
              </div>
              <div>
                <br />
                <input class="btn btn-primary btn-block btn-lg" type="submit" name="submit" value="Get My Free Whitepaper" data-drip-attribute="sign-up-button" />
              </div>
              <div class="text-center"><small class="text-muted">No Spam, 100% Security. We Value Your Privacy</small></div>

          </div>
        </div>

      </div>
      </form>
    </div>

  </div>
</div>

<script type="text/javascript">
    $(function(){
		/**
		 * Exit Timed Dropdown
		 */

	   var exitPopupIsReady = false;
	   var disableExitPopup = false;
	   setTimeout(function(){
		   if(!disableExitPopup){
			   exitPopupIsReady = true;
		   }
	   }, 3000);

	   $('body').mouseleave(function(){
		   if(exitPopupIsReady && !disableExitPopup){
			   $('#exitModal').modal('show');
			   exitPopupIsReady = false;
		   }
	   });
	});
</script>
