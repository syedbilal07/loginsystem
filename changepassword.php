<?php
    // Database Connection
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'dbtest');
    $con = mysqli_connect(DBHOST,DBUSER,DBPASS);
    $dbcon = mysqli_select_db($con,DBNAME);
    //
    $_SESSION['userId'] = "24";
    if(count($_POST) > 0){
        $result = mysqli_query($con,"SELECT * FROM users WHERE userId = '". $_SESSION['userId']. "'");
        $row = mysqli_fetch_array($result);
        if($_POST['currentPassword'] == $row['userPassword']){
            mysqli_query("UPDATE users set userPassword = '". $_SESSION["newPassword"]."' WHERE userEmail = '". $_SESSION['userId']. "'");
            $message = "Password Changed Successfully";
        }
        else{
            $message = "Password Is Not Correct";
        }
    }

?>
<html>
    <head>
        <title>Change Password</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body{
                background-image:url("background.jpg");
                margin-left:600px;
                margin-top:250px;
            }
            label,h1{
                color:white;
            }
            .btn{
                margin-left:300px;
            }
        </style>
        <script>
            function validatePassword()
            {
                var currentPassword, newPassword, confirmPassword, output = true;
                currentPassword = document.frmChange.currentPassword;
                newPassword = document.frmChange.newPassword;
                confirmPassword = document.frmChange.confirmPassword;
                if(!currentPassword.value){
                    currentPassword.focus();
                    document.getElementById("currentPassword").innerHTML = "Required Field";
                    output = false;
                }
                else if(!newPassword.value){
                    newPassword.focus();
                    document.getElementById("newPassword").innerHTML = "Required Field";
                    output = false;
                }
                else if(!confirmPassword.value){
                    confirmPassword.focus();
                    document.getElementById("confirmPassword").innerHTML = "Required Field";
                    output = false;
                }
                if(newPassword. value != confirmPassword.value){
                    newPassword.value = "";
                    confirmPassword.value = "";
                    newPassword.focus();
                    document.getElementById("confirmPassword").innerHTML = "Not Same";
                    output = false;
                }
                return output;
            }
        </script>
    </head>
        <body>
            <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                <div style="width:500px;">
                    <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                        <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
                            <tr class="tableheader">
                                <td colspan="2"><h1>Change Password</h1></td>
                            </tr>
                            <tr>
                                <td width="40%"><label class="control-label">Current Password</label></td>
                                <td width="60%"><input type="password" class="form-control" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
                            </tr>
                            <tr>
                                <td><label class="control-label">New Password</label></td>
                                <td><input type="password" name="newPassword" class="form-control" class="txtField"/><span id="newPassword" class="required"></span></td>
                            </tr>
                                <td><label class="control-label">Confirm Password</label></td>
                                <td><input type="password" name="confirmPassword" class="form-control" class="txtField"/><span id="confirmPassword" class="required"></span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="submit" class="btn btn-success btn-lg" value="Submit" class="btnSubmit"></td>
                            </tr>
                        </table>
                </div>
            </form>
        </body>
</html>
