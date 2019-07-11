// JavaScript Document
//for email validation
function validateForm(emailid) {
    var x = emailid;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        //alert("Not a valid e-mail address");
        return false;
    } else {
        return true;
    }
}

//for phone start//  
//for phone degit validation
function validatePhone(phoneid) {
    var y = phoneid;
    if ($.isNumeric(y)) {
        return true;
    } else {
        //alert("Only Numbers Allowed")
        return false;
    }
}

$(document).ready(function() {
    $('.btn').click(function formvalidation(event) {
        event.preventDefault();
        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var state = $('.state').val();
        var debt = $('#tax_debt').val();


        var myErrors = "";
        if (debt.length < 1) {
            myErrors += "Please select a debt amount\n";
            $("#tax_debt").addClass("error");
        }
        if (fname.length < 1) {
            //alert("Please enter your email")
            myErrors += "Please enter your First Name\n";
            $(".fname").addClass("error");
        }
        if (lname.length < 1) {
            //alert("Please enter your email")
            myErrors += "Please enter your Last Name\n";
            $(".lname").addClass("error");
        }
        if (state.length < 1) {
            //alert("Please enter your email")
            myErrors += "Please Select State\n";
            $(".state").addClass("error");
        }
        if (email.length < 1) {
            //alert("Please enter your email")
            myErrors += "Please enter your Email\n";
            $(".email").addClass("error");
        }
        if (email.length > 0 && !validateForm(email)) {
            myErrors += "Email is Invalid\n";
            $(".email").addClass("error");
        }
        if (phone.length < 1) {
            myErrors += "Please enter your phone number\n";
            $(".phone").addClass("error");
        } else if (phone.length != 10) {
            myErrors += "Please enter a valid phone number\n";
            $(".phone").addClass("error");
        } else {
            var toVerify = $.get('../lookUpPhoneNumber.php?phone=' + phone, function(e) {
                $('#toVerify').val(e.toString());
//                alert($('#toVerify').val());
            });
        }
        //for phone end             
        //redirect form to second form
        if (myErrors.length > 0) {
            alert(myErrors);
        } else {
            $('#ckm_form').submit();
        }




    });
});

