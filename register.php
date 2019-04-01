<?php
    ob_start();
    session_start();

    if(isset($_SESSION['user']) != ""){
        header("Location : home.php");
    }
    include_once 'dbconnect.php';

    $error = false;

    if(isset($_POST['btn-signup'])){
        // Clean User Input To Prevent SQL Injection
        $name = trim($_POST['name']);
        $name = strip_tags($name);
        $name = htmlspecialchars($name);

        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST['pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);

        // Basic Name Validation

        if(empty($name)){
            $error = true;
            $nameError = "Please Enter Your Full Name";
        }
        else if(strlen($name) < 3){
            $error = true;
            $nameError = "Name Must Have Atleast 3 Characters";
        }
        else if(!preg_match("/^[a-zA-Z ]+$/",$name)) {
            $error = true;
            $nameError = "Name Must Contain Alphabets & Spaces";
        }
        // Basic Email Validation
        if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error =true;
            $emailError = "Please Enter A Valid Email";
        }
        else{
            // Check If Email Exists Or Not
            $sql = "SELECT userEmail FROM users WHERE userEmail = '$email'";
            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);
            if($count != 0){
                $error = true;
                $emailError = "Provided Email Is Already In Use";
            }
        }
        // Password Validation
        if(empty($pass)){
            $error = true;
            $passError = "Please Enter A Password";
        }
        else if(strlen($pass) < 6){
            $error =true;
            $passError = "Password Must Have Atleast 6 Characters";
        }
        // Password Encryption Using SHA256()
        $password = hash('sha256', $pass);
        // If There Are No Errors, Continue To Sign Up
        if(!$error){
            $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email', '$password')";
            $res = mysqli_query($con,$query);
            if($res){
                $errTyp = "success";
                $errMSG  = "You Are Successfully Registered";
            }
            else{
                $errTyp = "danger";
                $errMSG  = "Something Went Wrong, Try Again Later";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Register</title>
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

                <form method="post" action="<?php echo htmlspecialchars($_SERVER['register.php']); ?>" autocomplete="off">
                    <div class="col-md-12">

                    <div class="form-group">
                        <h2 class="">Sign Up.</h2>
                    </div>

                    <div class="form-group">
                        <hr />
                    </div>

                    <?php
                    if ( isset($errMSG) ) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                    ?>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
                        </div>
                            <span class="text-danger"><?php echo $nameError; ?></span>
                    </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success" name="btn-signup">Sign Up</button>
                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <a href="index.php">Sign in Here.</a>
                </div>

            </div>

            </form>
        </div>

    </div>

</body>
</html>
<?php ob_end_flush(); ?>
