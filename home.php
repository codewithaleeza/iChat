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
  <title>iChat -Home</title>

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
ul.nav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: white;
  border-bottom: 2px solid #3A3A3A;

}

li.nav {
  float: left;

}

li.nav a {
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;

}

li.nav a:hover:not(.active) {
  background-color: grey;
}

.active {
  background-color: #4CAF50;
}
</style>
<body>
  <?php
  $user=$_SESSION['user_email'];
  $get_user="select * from users where user_email='$user'";
  $run_user=mysqli_query($con,$get_user);
  $row=mysqli_fetch_array($run_user);

  $user_id=$row['user_id'];
  $user_name=$row['user_name'];


   ?>
  <ul class="nav">
  <li class="nav"><a class="active"href="#home" style="pointer-events:none;"><img src="images/Chat.png" height="20px"><b>iChat</a></li>
  <li class="nav"><a class="" style="pointer-events:none;">Welcome, <?php echo "$user_name"; ?> </a></li>


  <li class="nav"style="float:right; right:4px;top:6px;">
       <form method="post">
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
  <li class="nav"style="float:right; right:4px;"> <a href="account_settings.php">
<i style="font-size:12px" class="fa">&#xf085;</i> Account Settings </a></b></li>
</ul>

  <div class="container main-section">
    <?php
    $user=$_SESSION['user_email'];
    $get_user="select * from users where user_email='$user'";
    $run_user=mysqli_query($con,$get_user);
    $row=mysqli_fetch_array($run_user);

    $user_id=$row['user_id'];
    $user_name=$row['user_name'];


     ?>
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
        <div class="input-group searchbox">
          <div class="input-group-btn">

            <center><a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user"
            type="submit">Add New User </button></a></center>
          </div>
        </div>
        <div class="left-chat">
          <ul>
            <?php include("include/get_users_data.php");?>

          </ul>
        </div>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
      <div class="row">
        <!-- getting the user info who is logged in -->
        <?php
        $user=$_SESSION['user_email'];
        $get_user="select * from users where user_email='$user'";
        $run_user=mysqli_query($con,$get_user);
        $row=mysqli_fetch_array($run_user);

        $user_id=$row['user_id'];
        $user_name=$row['user_name'];


         ?>

         <!-- getting the user data on which user click -->
         <?php
         if(isset($_GET['user_name'])){
           global $con;
           $get_username=$_GET['user_name'];
           $get_user="select * from users where user_name='$get_username'";

           $run_user=mysqli_query($con, $get_user);
           $row_user=mysqli_fetch_array($run_user);

           $username=$row_user['user_name'];
           $user_profile_image=$row_user['user_profile'];

         }

         $total_messages="select * from users_chat where (sender_username='$user_name' AND receiver_username='$username')
         OR (receiver_username='$user_name' AND sender_username='$username')";

         $run_messages=mysqli_query($con, $total_messages);
         $total = mysqli_num_rows($run_messages);

         ?>
         <div class="col-md-12 right-header">
              <div class="right-header-img">
             <img src="<?php echo"$user_profile_image";?>">
              </div>
              <div class="right-header-detail">
             <form method="post">
               <p><?php echo "$username"; ?></p>
               <span><?php echo $total; ?> messages </span>&nbsp &nbsp

             </form>


            </div>
          </div>
        </div>
  <div class="row">
    <div id ="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
      <?php
      $update_msg=mysqli_query($con, "UPDATE users_chat SET msg_status='read'
       WHERE sender_username='$username' AND receiver_username='$user_name'");

      $sel_msg= "select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR
      (receiver_username='$user_name' AND sender_username='$username') ORDER by 1 ASC";
      $run_msg = mysqli_query($con, $sel_msg);
      while ($row = mysqli_fetch_array($run_msg)) {
        $sender_username=$row['sender_username'];
        $receiver_username=$row['receiver_username'];
        $msg_content = $row['msg_content'];
        $msg_date=$row['msg_date'];

       ?>
       <ul>
         <?php
         if($user_name == $sender_username AND $username == $receiver_username){
            echo "
            <li>
            <div class='rightside-right-chat'>
            <span>$user_name <small> $msg_date </small></span><br><br>
            <p>$msg_content</p>

            </div>
            </li>

            ";
         }

         else if($user_name == $receiver_username AND $username == $sender_username){
            echo "
            <li>
            <div class='rightside-left-chat'>
            <span>$username <small> $msg_date </small></span><br><br>
            <p>$msg_content</p>

            </div>
            </li>

            ";
         }
         ?>
       </ul>

       <?php
     }

        ?>
  </div>
</div>
<div class="row">
<div class="col-md-12 right-chat-textbox">
  <form method="post">
    <input autocomplete="off" type="text" name="$msg_content" placeholder="Write your message....">
    <button class="btn" name="submit">Send <i class="fa fa-telegram" aria-hidden="true"></i></button>
  </form>
</div>
</div>
</div>
</div>
</div>
<?php
    if(isset($_POST['submit'])){
      $msg = htmlentities($_POST['$msg_content']);

      if($msg == ""){
        echo "
            <div class='alert alert-danger'>
              <strong><center>Message was unable to send </center></strong>
            </div>

        ";
      }
    else if(strlen($msg) > 100){
      echo "
      <div class='alert alert-danger'>
        <strong><center>Message is too long. Use only 100 characters </center></strong>
      </div>
      ";
    }
    else{
      $insert ="insert into users_chat(sender_username,receiver_username,msg_content,msg_status,msg_date)
      values('$user_name','$username','$msg','unread',NOW())";

      $run_insert = mysqli_query($con,$insert);
      echo"<script>window.open('home.php?user_name=$username','_self')</script>";

    }

    }




 ?>
 <script>
 $('#scrolling_to_bottom').animate({
   scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
</script>
 <script type="text/javascript">
 $(document).ready(function(){
   var height=$(window).height();
   $('.left-chat').css('height',(height - 92) + 'px');
   $('.right-header-contentChat').css('height',(height - 163) + 'px');

 });
 </script>

</body>

</html>
<?php } ?>
