<script type="text/javascript">

    $(document).ready(function() {

        $('#submitForm').click(function(e) {
            e.preventDefault(); // prevent the link's default behaviour
            if($("#opt_in").is(':checked'))
            {
                phone = $.trim($('#primary_phone').val());

                //regex to remove () and -
                var r = /\d+/g;
                var tmp;
                var fixedPhone = "";
                while ((tmp = r.exec(phone)) != null) {
                    fixedPhone += tmp[0];
                }

                var postData = $( "#ckm_form" ).serialize();
                $.post( "/local_storage/store/", postData, function(data) {
                    console.log(data);
                } );

                jQuery.ajax({
                    url: '/lookUpPhoneNumber.php?phone=' + fixedPhone,
                    success: function(phone) {
                        console.log(phone);

                        // we want to make sure we get back a valid string...if not, create one.
                        if(typeof phone !== 'string') phone = 'unknown';

                        jQuery('#toVerify').val(phone);
                        $('#ckm_form').submit(); // trigger the submit handler
                    },
                    error: function( status){
                        console.log(phone);
                        $('#ckm_form').submit(); // trigger the submit handler

                    }
                });
            }
            else
            {
                alert("You have to agree to the terms to be able to continue");
            }
        });

    });

</script>