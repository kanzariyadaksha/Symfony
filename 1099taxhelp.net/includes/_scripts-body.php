<script>
    function getURLParameter(name) {
       return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
    }

    function replaceNumber() {
      var supplier_phone;
      if (getURLParameter("aff_sub")) {
        supplier_phone = getURLParameter("aff_sub");
        supplier_phone = supplier_phone.substr(supplier_phone.length - 10).replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
      } else {
        supplier_phone = "833-300-0849";
      }
      $(".header_tel").html(supplier_phone);
      $(".CallerReadyPhone").html(supplier_phone);
      $(".CallerReadyPhone").attr("href","tel:"+supplier_phone.replace(/-/g,""));
    }

    jQuery(document).ready(function() {
      replaceNumber();
    });
</script>
