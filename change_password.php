<!DOCTYPE html>
<?php
session_start();
include("include/connection.php");

if(!isset($_SESSION['user_email'])){
  header("location: signin.php");
}
else{

?>

<html>
<head>
  <title>iChat -Change Password </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
body{
  overflow-x: hidden;
}
ul {
  list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: white;
    font-size: 14px;
    border-bottom: 2px solid #3A3A3A;
color:black;


}

li {
  float: left;
}

li a {
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;

}

li a:hover:not(.active) {
  background-color: grey;
}

.active {
  background-color: #4CAF50;
}
a{
  font-size: 14px;
  color:black;


}
a:hover {
  color: black;
  text-decoration: none;

}
.red{
  background-color: red;

}
</style>
</head>
<body>

<ul>
  <li>  <?php
      $user = $_SESSION['user_email'];
      $get_user="select * from users where user_email='$user'";
      $run_user=mysqli_query($con,$get_user);
      $row=mysqli_fetch_array($run_user);

      $user_name = $row['user_name'];
      echo "<b><a class='active' href='home.php?user_name=$user_name'><img src='images/Chat.png' height='20px'>iChat</a></li>";
       ?>
</li>
  <li><a class="" style="pointer-events:none;">Welcome, <?php echo "$user_name"; ?> </a></li>
  <li style="float:right; right:4px;top:6px;" >   <form method="post">
  <button name="logout" class="btn btn-danger" style="margin-right:5px;margin-top:5px;">Logout</button>
</form>
  <?php
     if(isset($_POST['logout'])){
       $update_msg = mysqli_query($con, "UPDATE users SET log_in='Offline'
       WHERE user_name='$user_name'");
       header("Location:logout.php");
       exit();


     }
     ?></li>
  <li style="float:right"><a  href="account_settings.php">
<i style="font-size:12px" class="fa">&#xf085;</i> Account Settings </a></li>
    <li style="float:right"><a  href="include/find_friends.php">
  <i style="font-size:12px" class="fa">&#xf067;	</i> Add Friends </a></li></b>
</ul>
    <br>
  <div class="row">
      <div class="col-sm-2">
      </div>

       <div class="col-sm-8">
         <form action="" method="post" enctype="multipart/form-data">
           <table class="table table-bordered table-hover">
             <tr aligh="center">
               <td colspan="6"><h2>Change Password </h2></td>
             </tr>
             <tr>
               <td style="font-weight:bold;">Current Password </td>
               <td>
                 <input type="password" name="current_pass" id="mypass" class="form-control" required
                 placeholder="Current Password" />
               </td>
             </tr>
             <tr>
               <td style="font-weight:bold;">New Password </td>
               <td>
                 <input type="password" name="u_pass1" id="mypass" class="form-control" required
                 placeholder="New Password" />
               </td>
             </tr>
             <tr>
               <td style="font-weight:bold;">Confirm Password </td>
               <td>
                 <input type="password" name="u_pass2"  id="mypass" class="form-control" required
                 placeholder="Confirm Password" />
               </td>
             </tr>
             <tr align="center">
               <td colspan="6">
                 <input type="submit" name="change"  value="Change" class="btn btn-primary" />
               </td>
             </tr>

           </table>
         </form>
         <?php
              if(isset($_POST['change'])){
                $c_pass=$_POST['current_pass'];
                $pass1=$_POST['u_pass1'];
                $pass2=$_POST['u_pass2'];

                $user = $_SESSION['user_email'];
                $get_user="select * from users where user_email='$user'";
                $run_user=mysqli_query($con,$get_user);
                $row=mysqli_fetch_array($run_user);

                $user_pass = $row['user_pass'];
                    if($c_pass != $user_pass){
                      echo "
                            <div class='alert alert-danger'>
                            <strong>Your Old Password didn't match</strong>
                            </div>
                      ";

                    }
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
                  if($pass1 == $pass2 AND $c_pass == $user_pass){
                    $update_pass=mysqli_query($con, "UPDATE users SET user_pass='$pass1' WHERE
                    user_email='$user'");
                    echo " <div class='alert alert-danger'>
                          <strong>Your Password has been changed.</strong>
                            </div>

                        ";
                  }
              }
         ?>
       </div>

       <div class="col-sm-2">

       </div>


  </div>

</body>
</html>
<?php } ?>
