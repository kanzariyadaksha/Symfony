<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<script>
    $(function () {
        $.validator.addMethod("fnameCheck", function(value, element) {
            return this.optional(element) || /^[a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+$/i.test(value);
        }, "First Name must contain only letters and characters");

        $.validator.addMethod("lnameCheck", function(value, element) {
            return this.optional(element) || /^[a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+$/i.test(value);
        }, "Last Name must contain only letters and characters");
        
        $("#ckm_form").validate({
            rules: {
                tax_debt: "required",
                state: "required",
                first_name :{
                    required:true,
                    fnameCheck:true  
                },
                last_name :{
                    required:true,
                    lnameCheck:true  
                },
                email_address: {
                    required: true,
                    email: true
                },
                primary_phone: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
              primary_phone: {
                  minlength: "Please enter valid phone"
              }
            }
        });
    })
</script>
<style>
    .error {
        color: red !important;
        font-size: 12px !important;
    }
</style>