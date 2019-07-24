<?php
session_start();
include("include/connection.php");
if(!isset($_SESSION['user_email'])){
  header("location: signin.php");
}
else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <title>iChat-Account Settings</title>
  <style>
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
  <br>
  <div class="row">
      <div class="col-sm-2">
      </div>
      <?php
        $user = $_SESSION['user_email'];
        $get_user= "select * from users where user_email='$user'";
        $run_user = mysqli_query($con, $get_user);
        $row= mysqli_fetch_array($run_user);

        $user_name=$row['user_name'];
        $user_pass=$row['user_pass'];
        $user_email=$row['user_email'];
        $user_profile=$row['user_profile'];
        $user_country=$row['user_country'];
        $user_gender=$row['user_gender'];

        ?>
        <div class="col-sm-8">
          <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered table-hover">
              <tr aligh="center">
                <td colspan="6" ><h2>Change Account Settings </h2></td>
              </tr>
              <tr>
                <td style="font-weight:bold;">Username </td>
                <td>
                  <input type="text" name="u_name" class="form-control" required value="<?php echo $user_name;?>"/>
                </td>
              </tr>
              <tr>
                <td></td>
                <td><a class="btn btn-success" style="text-decoration: none; font-size:15px;" href="upload.php">
                  <i class="fa fa-user" aria-hidden="true"></i> Change Profile Picture </a>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold;">Email </td>
                <td>
                  <input type="email" name="u_email" class="form-control" required value="<?php echo $user_email;?>"/>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold;">Country </td>
                <td>
                <select class="form-control" name="u_country">
                  <option><?php echo $user_country;?></option>
                  <option></option>
                  <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
                </select>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold;">Gender </td>
                <td>
                <select class="form-control" name="u_gender">
                  <option><?php echo $user_gender;?></option>
                  <option></option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
                </td>
              </tr>
              <tr>
                <td style="font-weight:bold;"> Forgotten Password </td>
                <td>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                        Forgotten Password </button>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                  <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                            &times;</button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="recovery.php?id=<?php echo $user_id;?>" method="post" id="f">
                                            <strong>What is your bestfriend name? </strong>
                                            <textarea class = "form-control" cols="83" rows="4" name="content"
                                            placeholder="Someone"></textarea><br>
                                            <input class="btn btn-success" type="submit" name="sub" value="Submit"
                                            style="width: 100px;"><br><br>
                                            <pre>Answer above question. We will ask you this question if you forgot your <br>Password.</pre>
                                            <br><br>
                                          </form>
                                          <?php
                                          if(isset($_POST['sub'])){
                                            $bfn=htmlentities($_POST['content']);

                                              if($bfn ==''){
                                                echo"<script type='text/javascript'>alert('Please Enter Something.')</script";
                                                echo"<script type='text/javascript'>window.open('account_settings.php','_self')</script>";
                                                exit();
                                              }
                                              else{
                                                $update="update users set forgotten_answer='$bfn' where user_email='$user'";
                                                $run=mysqli_query($con,$update);
                                                  if($run){
                                                    echo"<script type='text/javascript'>alert('Working...');
                                                    window.location='account_settings.php';</script";
                                                    echo"<script type='text/javascript'>window.open('account_settings.php','_self')</script>";

                                                  }else{
                                                    echo"<script type='text/javascript'>alert('Error while updating information.');
                                                    window.location='account_settings.php';</script";
                                                    echo"<script type='text/javascript'>window.open('account_settings.php','_self')</script>";
                                                  }
                                              }

                                          }

                                           ?>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                        </div>
                                  </div>
                            </div>
                        </div>

                                        </tr>
                                        <tr><td></td><td><a class="btn btn-success" style="text-decoration: none; font-size: 15px;"
                                          href="change_password.php"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</td>
                                        </tr>



                                        <tr align="center">
                                          <td colspan="6">
                                            <input type="submit" value="Update" name="update" class="btn btn-primary">
                                          </td>
                                        </tr>

                                      </table>
                                    </form>
                                    <?php
                                    if(isset($_POST['update'])){
                                      $user_name=htmlentities($_POST['u_name']);
                                      $u_email=htmlentities($_POST['u_email']);
                                      $u_gender=htmlentities($_POST['u_gender']);
                                      $u_country=htmlentities($_POST['u_country']);

                                      $update="update users set user_name='$user_name', user_email='$u_email',
                                      user_country='$u_country',user_gender='$u_gender' where user_email='$user'";

                                      $run=mysqli_query($con,$update);

                                      if($run){
                                        echo "<script type='text/javascript'>window.open('account_settings.php','_self')</script>";
                                      }
                                    }

                                     ?>
                                  </div>
  </div>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</html>
<?php } ?>
