<?php
ob_start( );
session_start();

?>
<html>
    <head>
        <title>Forgot Password</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body{
                background-image:url("background.jpg");
                margin-top:300px;
                margin-left:500px;
                margin-right:800px;
            }
            label,h1{
                color:white;
            }
        </style>
    </head>
    <body>
    <form name="frmForgot" id="frmForgot" method="post" onSubmit="return validate_forgot();">
        <h1>Forgot Password?</h1>
        <?php if(!empty($success_message)) { ?>
            <div class="success_message"><?php echo $success_message; ?></div>
        <?php } ?>

        <div id="validation-message">
            <?php if(!empty($error_message)) { ?>
                <?php echo $error_message; ?>
            <?php } ?>
        </div>

        <div class="field-group">
            <div><label for="email" class="control-label">Email</label></div>
            <div><input type="text" name="user-email" class="form-control" id="user-email" class="input-field"></div>
        </div>
        <br />
        <div class="field-group">
            <div><input type="submit" name="forgot-password" class="btn btn-success btn-lg" id="forgot-password" value="Submit" class="form-submit-button"></div>
        </div>
    </form>
    </body>
</html>
