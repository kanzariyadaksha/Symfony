<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="css/login_css.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<div class="login-page" id="read_login">
    <div class="form">
        <form class="login-form"  id="login-form" action="process_login.php" method="post">
            <input type="text" placeholder="Username" name="username"/>
            <label class="error" generated="true" for="username"></label>
            <input type="password" placeholder="Password" name="password"/>
            <label class="error" generated="true" for="password"></label>

            <button>login</button>
            <div class="message" > <?php if (isset($_GET['msg'])) {
               echo $_GET['msg'];
             } ?> </div>

        </form>

    </div>
</div>

<script>

    $(function() {

        $("#login-form").validate({
            rules: {
                username: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery.validate.min.js"></script>
</body>
</html>