jQuery.validator.addMethod("emailCheck", function(value, element) 
{
    if(value == '') 
        return true;
    var temp1;
    temp1 = true;
    var ind = value.indexOf('@');
    var str2=value.substr(ind+1);
    var str3=str2.substr(0,str2.indexOf('.'));
    if(str3.lastIndexOf('-')==(str3.length-1)||(str3.indexOf('-')!=str3.lastIndexOf('-')))
        return false;
    var str1=value.substr(0,ind);
    if((str1.lastIndexOf('_')==(str1.length-1))||(str1.lastIndexOf('.')==(str1.length-1))||(str1.lastIndexOf('-')==(str1.length-1)))
        return false;
    str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/;
    temp1 = str.test(value);
    return temp1;
}, "Please enter a valid email address.");

$.validator.addMethod("phoneCheck", function(phonenumber, element) {
    phonenumber = phonenumber.replace(/_/g, "");
    phonenumber = phonenumber.replace(/-/g, "");
    return this.optional(element) || phonenumber.match(/^\d{10}$/);
}, "Please enter valid phone number");

$.validator.addMethod("fnameCheck", function(value, element) {
    return this.optional(element) || /^[a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+$/i.test(value);
}, "First Name must contain only letters and characters");

$.validator.addMethod("lnameCheck", function(value, element) {
    return this.optional(element) || /^[a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+$/i.test(value);
}, "Last Name must contain only letters and characters");
    
function setFormValidation(){
    $("#ckm_form").validate({
        rules:{
            state:"required",
            tax_debt:"required",
            first_name :{
                required:true,
                fnameCheck:true  
            },
            last_name :{
                required:true,
                lnameCheck:true  
            },
            email_address :{
                required:true,
                email:true,
                emailCheck: true
            },
            primary_phone: {
                required:true,
                phoneCheck: true
            },
            opt_in:"required",
            opt_special_offers:"required",
            TCPA_checkbox:"required",
            "current_situation[]": {required: true},
        },
        messages: {
            TCPA_checkbox: "Please accept terms.",
              "current_situation[]": "Please select at least one option",
        },
        submitHandler: function(form) {
            $("#loading-div-background").show();
            form.submit();
        },
        ignore: ':hidden:not(:checkbox)'
    });
};

function initForm(){
   
   setFormValidation();
  
};

$(function(){   
  initForm();
});

