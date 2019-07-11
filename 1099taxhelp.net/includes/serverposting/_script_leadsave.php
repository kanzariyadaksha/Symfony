<script type="text/javascript">
    $(document).ready(function () {
        function storelead() {
            var postData = $("#ckm_form").serialize();
            $.post("/local_storage/store/", postData, function (data) {
                console.log(data);
            });
        }
        $('#primary_phone').blur(function (e) {
            var tmp, digits = '', entry = $.trim($(this).val());
            var regex = /\d+/g;
            while ((tmp = regex.exec(entry)) != null) {
                digits += tmp[0];
            }
            if (digits.length == 10) {
                storelead();
            }
        });
        $("#email_address").on("blur", function () {
            // CHECK validation
            var sEmail = $("#email_address").val();
            var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            if (filter.test(sEmail)) {
                storelead();
            }
        });
        var count = 0;
        $('#xsubmit_main_form').click(function (e) {
            e.preventDefault(); // prevent the link's default behaviour
            var phone = $.trim($('#primary_phone').val());
            //regex to remove () and -
            var r = /\d+/g;
            var tmp;
            var fixedPhone = "";
            while ((tmp = r.exec(phone)) != null) {
                fixedPhone += tmp[0];
            }
            storelead();
            jQuery.ajax({
                url: '/lookUpPhoneNumber.php?phone=' + fixedPhone,
                success: function (res) {
                    // we want to make sure we get back a valid string...if not, create one.
                    if (typeof res !== 'string')
                        res = 'unknown';
                    jQuery('#toVerify').val(res);
                    alert("hasdfafds");
                    $('#ckm_form').submit(); // trigger the submit handler
                },
                error: function (res) {
                    // we want to make sure we get back a valid string...if not, create one.
                    if (typeof res !== 'string')
                        res = 'unknown';
                    jQuery('#toVerify').val(res);
                    $('#ckm_form').submit(); // trigger the submit handler
                }
            });
        });
    });
</script>