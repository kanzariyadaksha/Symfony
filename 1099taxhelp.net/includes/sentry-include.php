<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 12/23/15
 * Time: 12:08 AM
 */
 /*
?>

<script src="https://cdn.ravenjs.com/1.3.0/jquery,native/raven.min.js"></script>

<script type="text/javascript">
    Raven.config('https://ccbd232ebd164922b0e53184b6b60758@app.getsentry.com/62078').install();
</script>

<style>

    .tooltip, .tt-arrow:after {
        background: #c00;
        border: 2px solid white;
    }

    .tooltip {
        pointer-events: none;
        opacity: 0;
        display: inline-block;
        position: absolute;
        padding: 10px 20px;
        color: white;
        border-radius: 20px;
        margin-top: 20px;
        text-align: center;
        font: bold 14px "Helvetica Neue", Sans-Serif;
        font-stretch: condensed;
        text-decoration: none;
        box-shadow: 0 0 7px black;
    }
    .tt-arrow {
        width: 70px;
        height: 16px;
        overflow: hidden;
        position: absolute;
        left: 50%;
        margin-left: -35px;
        bottom: -16px;
    }
    .tt-arrow:after {
        content: "";
        position: absolute;
        left: 20px;
        top: -20px;
        width: 25px;
        height: 25px;
        -webkit-box-shadow: 6px 5px 9px -9px black,
        5px 6px 9px -9px black;
        -moz-box-shadow: 6px 5px 9px -9px black,
        5px 6px 9px -9px black;
        box-shadow: 6px 5px 9px -9px black,
        5px 6px 9px -9px black;
        -webkit-transform: rotate(45deg);
        -moz-transform:    rotate(45deg);
        -ms-transform:     rotate(45deg);
        -o-transform:      rotate(45deg);
    }
    .tooltip.active {
        opacity: 1;
        margin-top: 5px;
        -webkit-transition: all 0.2s ease;
        -moz-transition:    all 0.2s ease;
        -ms-transition:     all 0.2s ease;
        -o-transition:      all 0.2s ease;
    }
    .tooltip.out {
        opacity: 0;
        margin-top: -20px;
    }

</style>

<script type="text/javascript">

$(document).ready(function () {

    var $tooltip,
        $body = $('body'),
        $el = $("#primary_phone"),
        $invalid = false,
        $text = "This number doesn't appear to be<br>valid or is listed as a business.<br>Please enter another number.";

    // Make DIV and append to page
    var $tooltip = $('<div class="tooltip" data-tooltip="phone">' + $text + '<div class="tt-arrow"></div></div>').appendTo("body");

    // Position right away, so first appearance is smooth
    var linkPosition = $el.offset();

    $tooltip.css({
        top: linkPosition.top - $tooltip.outerHeight() - 13,
        left: linkPosition.left - ($tooltip.width()/2)
    });

    function nuestarErrorShow() {

        $tooltip = $('.tooltip');

        // Reposition tooltip, in case of page movement e.g. screen resize
        var linkPosition = $el.offset();

        $tooltip.css({
            top: linkPosition.top - $tooltip.outerHeight() - 13,
            left: linkPosition.left - ($tooltip.width()/2)
        });

        // Adding class handles animation through CSS
        $tooltip.addClass("active");
        $el.addClass('input-error');
        $invalid = true;

    }

    function nuestarErrorHide() {

        // Temporary class for same-direction fadeout
        $tooltip = $('.tooltip').addClass("out");
        $el.removeClass('input-error');

        // Remove all classes
        setTimeout(function() {
            $tooltip.removeClass("active").removeClass("out");
        }, 300);
        $invalid = false;

    }

    $el.keyup(function(e) {

        var tax_debt = $('#tax_debt').val();
        var tmp, digits = '', entry = $.trim($(this).val());
        var regex = /\d+/g;
        while ((tmp = regex.exec(entry)) != null) {
            digits += tmp[0];
        }
        if(digits.length == 10 && tax_debt > 9999) {
            $.get( "/validatePhoneNumber.php?phone=" + digits, function(data) {
                $('#neustar').val(data);
                if(data == 'fail') {
                    nuestarErrorShow();
                } else {
                    nuestarErrorHide();
                }
                console.log('Phone: '+data);
            } );
        } else if($invalid) {
            nuestarErrorHide();
        }

    });

});

</script>
<?php */?>