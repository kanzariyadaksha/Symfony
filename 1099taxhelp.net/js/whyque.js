    $(document).ready(function () {
     $('.other_chk').click(function () {
     	var chkbox = $(this);
         if (chkbox.is(':checked')) {
             $('.other_type').show();
         } else {
            $('.other_type').hide();
         }
     });
 });
