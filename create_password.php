<!DOCTYPE html>
<html>
<head>
  <title>Log In to your Account</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA Compatible" content="IE=edge">
  <meta name="viewport" content="with=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/signin.css">
</head>
<body>
<div class="signin-form">
    <form action="" method="post">
      <div class="form-header">
        <h2>Create New Password</h2>
        <p>iChat</p>
      </div>

      <div class="form-group">
        <label>Enter Password</label>
        <input type="password" class="form-control" name="pass1" placeholder="Password" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="pass2" placeholder="Confirm Password" autocomplete="off" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block btn-lg" name="change">Change Password</button>
      </div>
      <?php
      session_start();
      include("include/connection.php");


        if(isset($_POST['change'])){
            $user = $_SESSION['user_email'];
            $pass1=$_POST['pass1'];
            $pass2=$_POST['pass2'];

            if($pass1 != $pass2){
              echo " <div class='alert alert-danger'>
                    <strong>Your New Password didn't match with Confirm password.</strong>
                      </div>

                  ";
            }

            if($pass1 < 8 AND $pass2 < 8){
            echo " <div class='alert alert-danger'>
                  <strong>Use 8 or more than 8 characters.</strong>
                    </div>

                ";
              }
              if($pass1 == $pass2){
                $update_pass=mysqli_query($con, "UPDATE users SET user_pass='$pass1' WHERE
                user_email='$user'");
                session_destroy();
                echo "<script>alert('Go Ahead and Sign In. ')</script> ";
                echo "<script>window.open('signin.php','_self')</script>";
              }
        }


       ?>
    </form>

</div>

</body>
</html>
