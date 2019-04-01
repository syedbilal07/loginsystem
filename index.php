<?php
    ob_start();
    session_start();
    require_once 'dbconnect.php';
    // It Will Never Let You Open Login Page When Session Is Set
    if ( isset($_SESSION['user'])!="" ) {
    header("Location : home.php");
    exit;
    }
    $error = false;
    if(isset($_POST['btn-login'])){
        // Prevent SQL Injection & Clear Invalid User Input
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST['pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);
        if(empty($email)){
            $error =true;
            $emailError = "Email Address Is Not Recognized";
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "Please Enter A Valid Email Address";
        }
        if(empty($pass)){
            $error = true;
            $passError = "Please Enter A Password";
        }
        // If There Is No Error Continue To Login
        if(!$error){
            $password = hash('sha256',$pass);
            $result = mysqli_query($con,"SELECT userId, userName, userPass FROM users WHERE userEmail = '$email'");
            $row = mysqli_fetch_array($result);
            // If User Name And Password Is Correct, It Must Return 1 Row
            $count = mysqli_num_rows($result);
            if($count == 1 && $row['userPass'] == $password){
                $_SESSION['user'] = $row['userId'];
                header("Location: home.php");
            }
            else{
                $errMSG = "Invalid Credentials. Please Try Again Later";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body {
                background-image: url("background.jpg");
            }
        </style>
    </head>
    <body>

        <div class="container">

            <div id="login-form">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

                    <div class="col-md-12">

                <div class="form-group">
                    <h2 class="">Sign In.</h2>
                </div>

                <div class="form-group">
                    <hr />
                    <?php
                    if(!empty($_GET['status']) && empty($_SESSION['user'])){
                        echo '<div>You Have Been Logged Out!</div>';
                    }
                    else if(empty($_SESSION['user'])){
                        echo '<div>Please Login To Continue.!</div>';
                    }
                    ?>
                </div>

                <?php
                if ( isset($errMSG) ) {

                ?>
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success" name="btn-login">Sign In</button>
                    <a href="forgotpassword.php">Forgot Password</a>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <a href="register.php">Sign Up Here.</a>
                </div>

            </div>

        </form>
    </div>

</div>

</body>
</html>
<?php ob_end_flush(); ?>