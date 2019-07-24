<!DOCTYPE html>
<?php
session_start();
include("find_friends_function.php");

if(!isset($_SESSION['user_email'])){
  header("location: signin.php");
}
else{

?>

<html>
<head>
  <title>iChat -Search for Friends</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="../css/find_people.css"> -->

  <style>

  button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 8px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
  }

  a {
    text-decoration: none;
    color: black;
    font-size: 14px;
  }
  button:hover, a:hover{
    opacity: 0.7;
  }
  form.search_form input[type=text]{
    padding: 10px;
    font-size: 17px;
    border-radius: 4px;
    border: 1px solid #343a40 !important;
    float: left;
    width: 80%;
    color: white;
    background: #343a40 !important;
  }

  form.search_form button{
    float:left;
    width: 20%;
    padding: 10px;
    font-size: 17px;
    border: 1px solid #343a40 !important;
    border-left: none;
    cursor: pointer;
    background-color: #343a40 !important;
  }
  form.search_form button:hover{
    background: #343a40 !important;
  }
  form.search_form::after {
    content: "";
    clear: both;
    display: table;
  }
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
        echo "<b><a class='active' href='../home.php?user_name=$user_name'><img src='../images/Chat.png' height='20px'>iChat</a></li>";
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
    <li style="float:right"><a  href="../account_settings.php">
  <i style="font-size:12px" class="fa">&#xf085;</i> Account Settings </a></li>
    </b>
  </ul>
<br>
<br>

  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
      <form class="search_form" action="">

        <input type="text" name="search_query" placeholder="Search Friends" autocomplete="off" required>
        <button class="btn btn-primary" type="submit" name="search_btn">Search</button>
      </form>
    </div>
    <div class="col-sm--4">

    </div>
  </div><br><br>
  <?php search_user(); ?>
</body>
</html>
<?php } ?>
