<?php // PHP file ?>

<!-- Modal -->
<div id="aboutUsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">About Us</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>1099taxhelp.net proudly serves all 50 states and it's the largest matching service in the country. We connect individuals and business with daunting tax debt issues with the most qualified and proven tax resolution companies. These companies are made up of taxdebt experts, attorneys and ex-IRS investigators and provide customized tax relief solutions for individuals and families who are worried about, or have experienced, wage garnishments, tax liens, bank levies, or other IRS tax-related collection measures. We realize stopping the IRS in its tracks and getting the most favorable settlement are your big priorities and as such work with proven leaders in the industry who deliver amazing results every day.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php
$offername = '1099 Tax Help';
$address = '</br>15333 Culver Dr.</br>Suite 340-244</br>Irvine, CA 92604';
$email = 'support@1099taxhelp.net';
?>
<div id="contactUsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Contact Us</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p><?php echo $offername;?><?php echo $address;?> </p>
        <p> Contact us at: <a href="mailto:<?php echo $email?>" style="white-space: nowrap;"><?php echo $email?></a></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    
<div id="privacyModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Privacy Policy</h4>
      </div>
      <div class="modal-body">


          <?php include_once($_SERVER['DOCUMENT_ROOT'].'/privacyBody.php'); ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

