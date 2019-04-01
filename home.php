<?php
    ob_start();
    session_start();
    require_once 'dbconnect.php';
    // If Session Is Not Set, It Will Redirect To Login Page
    if(!isset($_SESSION['user'])){
        header("Location: index.php");
        exit;
    }
    // Select Loggin In User Detail
    $result = mysqli_query($con,"SELECT * FROM users WHERE userId =".$_SESSION['user']);
    $userRow = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
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

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html">Back to Article</a></li>
                    <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
                    <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="changepassword.php"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Change Password</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </nav>

        <div id="wrapper">

            <div class="container">

                <div class="page-header">
                    <h3>Programming Blog</h3>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h1>Focuses On PHP, MySQL, Ajax, jQuery, Web Design And More.!</h1>
                    </div>
                </div>

            </div>

        </div>
    </body>
</html>
<?php ob_end_flush(); ?>