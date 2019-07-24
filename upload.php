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
  <title>iChat -Change Profile Picture </title>
  <meta charset="utf-8">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
.card{
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  max-width: 400px;
  margin: auto;
  text-align: center;
  font-family: arial;
}
.card img{
  height: 200px;
  width:200px;
  text-align:center;
  border-radius: 2px;
  border-width: medium;
  border-color: black;
}
.title{
  color:grey;
  font-size: 18px;
}
button.a{

  display: inline-block;
  padding: 8px;
  color: white;
  background-color: grey;
  text-align: center;
  cursor: pointer;
  width: 50%;
  font-size: 18px;
}
#update_profile{

  cursor: pointer;
  padding: 10px;
  border-radius: 4px;
  color: white;
  background-color:grey;
}
label{
  align:center;
  padding: 7px;
  display: table;
  color:#fff;
}
input[type="file"]{
  display: none;
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
    <br>
  <b>  <h2 align="center">Change Profile Picture </h2></b>
  <?php
  $user = $_SESSION['user_email'];
  $get_user= "select * from users where user_email='$user'";
  $run_user = mysqli_query($con, $get_user);
  $row= mysqli_fetch_array($run_user);

  $user_name=$row['user_name'];
  $user_profile=$row['user_profile'];

  echo "
  <div class='card'>
    <center><img src ='$user_profile' ></center>
    <h1>$user_name</h1>

    <form method='post' enctype='multipart/form-data'><center>
      <label id='update_profile'><i  aria-hidden='true'></i>Select Profile
      <input type='file' name='u_image'size='60px'></label>
      <p>*Please Select Picture and Click update profile.</p>
      <button class='btn btn-primary' id='button_profile' name='update' align='center'><i  aria-hidden='true'>
      </i>Update Profile</button>
      </center>
    </form><br>
  </div><br><br>
  ";

  if(isset($_POST['update'])){

    $u_image=$_FILES['u_image']['name'];
    $image_tmp=$_FILES['u_image']['tmp_name'];
    $random_number= rand(1,100);

    if($u_image==''){
      echo"<script>alert('Please select profile')</script>";
      echo"<script>window.open('upload.php','_self')</script>";
      exit();

    }
    else{
      move_uploaded_file($image_tmp, "images/$u_image.$random_number");
      $update="update users set user_profile='images/$u_image.$random_number'where user_email='$user'";

      $run=mysqli_query($con,$update);
        if($run){
          echo"<script>alert('Your profile image has been updated!')</script>";
          echo"<script>window.open('upload.php','_self')</script>";
        }

    }
  }
  ?>




</body>
</html>
<?php } ?>
