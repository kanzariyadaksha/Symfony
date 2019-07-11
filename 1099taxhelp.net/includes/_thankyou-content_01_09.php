<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 4/20/16
 * Time: 09:26 PM
 */

if($tax_debt > 9999) :
?>

<!-- Over $10k -->
<div id="tyads">
    <script type='text/javascript'><!--// <![CDATA[
        /* [id526] FPG-1 */
        OA_show(526);
      // ]]> --></script>
      <script type='text/javascript'><!--// <![CDATA[
        /* [id527] FPG-2 */
        OA_show(527);
      // ]]> --></script>
      <script type='text/javascript'><!--// <![CDATA[
        /* [id528] FPG-3 */
        OA_show(528);
      // ]]> --></script>
      <script type='text/javascript'><!--// <![CDATA[
        /* [id529] FPG-4 */
        OA_show(529);
      // ]]> --></script>
      <script type='text/javascript'><!--// <![CDATA[
        /* [id530] FPG-5 */
        OA_show(530);
      // ]]> --></script>
</div>
    
<?php
else :
?>

<!-- Sub $10k -->
<div id="tyads">
    <script type='text/javascript'><!--// <![CDATA[
        /* [id671] FPG-1 */
        OA_show(671);
        // ]]> --></script>
    <br />
    <script type='text/javascript'><!--// <![CDATA[
        /* [id672] FPG-2 */
        OA_show(672);
        // ]]> --></script>
    <br />
    <script type='text/javascript'><!--// <![CDATA[
        /* [id673] FPG-3 */
        OA_show(673);
        // ]]> --></script>
    <br />
    <script type='text/javascript'><!--// <![CDATA[
        /* [id674] FPG-4 */
        OA_show(674);
        // ]]> --></script>
    <br />
    <script type='text/javascript'><!--// <![CDATA[
        /* [id675] FPG-5 */
        OA_show(675);
        // ]]> --></script>
</div>
<?php
endif;
?>

<script type="text/javascript">
    // Ad styling
    $(document).ready(function() {

        var ads = $('#tyads a img');
        ads.attr('height','')
           .attr('width','')
           .css('margin-top','10px');

    });

</script>

<script type="text/javascript">var ssaUrl = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'pixel.sitescout.com/iap/d12226f43b8f3eea';new Image().src = ssaUrl;</script>
