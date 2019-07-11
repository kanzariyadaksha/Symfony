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
    //return (/^\d{10}$/).test(phonenumber);
    return this.optional(element) || phonenumber.match(/^\d{10}$/);
}, "Please enter valid phone number");

$.validator.addMethod("fnameCheck", function(value, element) {
    return this.optional(element) || /^[a-zA-Z !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+$/i.test(value);
}, "First Name must contain only letters and characters");

$.validator.addMethod("lnameCheck", function(value, element) {
    return this.optional(element) || /^[a-zA-Z !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+$/i.test(value);
}, "Last Name must contain only letters and characters");
$.validator.addMethod("noSpace", function(value, element) { 
    return value.indexOf(" ") < 0 && value != ""; 
}, "Space are not allowed");
$.validator.addMethod("customregex", function(e, t) {
    return this.optional(t) || /^[^-\s][a-zA-Z\s-]+$/i.test(e)
}, "Only letters and characters accepted")
    
function setFormValidation(){
    
    $("#ckm_form").validate({
        rules:{
            state:"required",
            first_name :{
                required:true,
                fnameCheck:true,
                noSpace:true  
            },
            last_name :{
                required:true,
                lnameCheck:true,
                noSpace:true
            },
            email_address :{
                required:true,
                email:true,
                emailCheck: true
            },
            employment_type_other: {
                required: true,
                maxlength: 255,
                customregex: true
            },
            primary_phone: {
                required:true,
                phoneCheck: true
            },
            opt_special_offers:"required",
            TCPA_checkbox:"required",
            "employment_type": {
                required: true
            }
        },
        
        messages: {
            TCPA_checkbox: "Please agree terms",
            "employment_type": "Please select at least one option"
        },
        submitHandler: function(form) {
            $("#loading-div-background").show();
            form.submit();
        },
        ignore: ':hidden:not(:checkbox, :input.current_sit)'
    });
};

function isStepFormComplete(currentBtn){
   
    var isComplete = true;
     isComplete = $("#ckm_form").valid();
    if(window.stepId && window.stepId != "step-2"){
        isComplete = $("#ckm_form").valid();
    }
    console.log(isComplete);
    return isComplete;
}

function changeFormWizardStep(currentBtn){
        

    var nextId = $(currentBtn).parents('.tab-pane').next().attr("id");
    
    var isCompleteform = $("#ckm_form").valid();
        

    if(isCompleteform){
    
        $('[href=#'+nextId+']').tab('show');
        return false;
    
    }
    return false;

    
    window.stepId = nextId ;
    
    if (nextId == 'step-2') {
        $(".progress").removeClass('hidden');
    }
   
}

function onNextClick(){
   var currentBtn = this;
   var stepFormStatus =  isStepFormComplete(currentBtn);
   
   if (stepFormStatus){
       changeFormWizardStep(currentBtn);
   }
}

function onSelectChange(){
        var nextId = $(this).parents('.tab-pane').next().attr("id");

        $('[href=#'+nextId+']').tab('show');
        window.stepId = nextId ;
}

function updateProgressBar(e) {
    
    var step = $(e.target).data('step');
    var percent = (parseInt(step) / 6) * 100;
    
    $('.progress-bar').css({width: percent + '%'});
    $('.progress-bar').text("Step " + step + " of 6");
    
}

function setFormListeners(){
    
    $('select.change').change(onSelectChange);
    //$('a[data-toggle="tab"]').on('shown.bs.tab',updateProgressBar);
    $('.next').click(onNextClick);
   
}

function initForm(){
   
   setFormValidation();
   setFormListeners();
};

$(function(){   
  initForm();
});
