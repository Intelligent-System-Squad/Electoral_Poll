<?php
session_start();
require('../connection.php');
?>
<?php
//This check whether your session is valid, if not asks you to login
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}


//If the update button is clicked 
if (isset($_GET['id']) && isset($_POST['update']))
{
$myId = addslashes( $_GET['id']);
$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];
$pattern = "@ousl.lk";
    if (substr($myEmail, -strlen($pattern)) !== $pattern) {
        // Email doesn't end with the desired pattern
        echo "<script>alert('Email address must end with $pattern. Please enter a valid email.');</script>";
    } else {
        $emailCheckQuery = "SELECT COUNT(*) as count FROM tbAdministrators WHERE email = '$myEmail' AND admin_id <> '$myId'";//Check uniqueness of email
        $emailCheckResult = mysqli_query($con, $emailCheckQuery);
        $emailCount = mysqli_fetch_assoc($emailCheckResult)['count'];
        if ($emailCount > 0) {
          // Email is not unique      
          echo "<script>alert('Email address is not unique. Please choose a different email.');</script>"; 
        }else{ 
        //get the new information from the update from and update the table
        $sql = mysqli_query($con, "UPDATE tbAdministrators SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail' WHERE admin_id = '$myId'" );
        }
    }
}

//fetching the details of the admin who is logged in 
$result=mysqli_query($con, "SELECT * FROM tbadministrators WHERE admin_id = '$_SESSION[admin_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get the information of the admin who is logged in 
 $adminId = $row['admin_id'];
 $firstName = $row['first_name'];
 $lastName = $row['last_name'];
 $email = $row['email'];
 }
?>
<html><head>
<title>Electoral Poll: Manage Admin</title>
<style>
    .mainnav {
      background-color: #0C0C1C;
      overflow: hidden;
      margin-left: 10cm;
      margin-left: 30px;
      display: inline-block;
     
    }
    #buttons {
      background-color: #D49FE7;
      border-radius: 5px;
      margin-top: 8px;
      padding: 10px 35px;
      font-weight: bolder;
      font-size: 18px;
    }
    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #0C0C1C;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }
    .sidenav a {
      padding: 8px 8px 20px 32px;
      text-decoration: none;
      font-size: 20px;
      color: #FFFFFF;
      display: block;
      transition: 0.3s;
    }
    .sidenav a:hover {
      color: #f1f1f1;
    }
    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
    h1{
      color:#FFFF;
    }
    .line{
      float:left;
    }
    #buttons{
      background-color: #D49FE7;
      border-radius: 5px;
      margin-top: 8px;
      padding: 10px 35px;
      font-weight: bolder;
      font-size: 18px;
    }
    .space {
      width: 20px;
      height: auto;
      display: inline-block;
    }
    .text1 {
      font-size: 25px;
      font-weight: bolder;
      text-align: center;
    }     
    .space {
      width: 20px;
      height: auto;
      display: inline-block;
    }
    #box {
      background-color: #D49FE7;
      height: 400px;
      width: 500px;
      border-radius: 20px;            
      position: absolute;
      position: absolute;
      top: 50%;
      left: 50%;
      margin-right: -50%;
      transform: translate(-50%, -50%);
      margin:0;  
    }
    input {
      margin-left: 20%;
      width: 300px;
      border-color: #DDBEBE;
      height: 25px;
      background-color: #0C0C1C;
      color:#FFFF;
    }
    label {
      margin-left: 20%;
    } 
    .form {
      background-color: #0C0C1C;
      padding: 15px;
      height: 350px;           
      color: #DDBEBE;
      border-radius: 0px 0px 20px 20px;      
    }

    #box2 {
      margin-left: 200px;
    }
    .registerbtn {
      background-color: #D49FE7;
      padding: 10px 35px;
      font-weight: bolder;
      font-size: 18px;
      border-radius: 8px;
      height: 40px;
      color:#0C0C1C;
    }

</style>
</head>
<script language="JavaScript" src="js/admin.js">
</script>
<body>
<div style="background-color: #0C0C1C;">
<!--side navigation bar-->
<div class="mainnav">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="admin.php">Home</a>
  <a href="voters.php">Manage Voters</a>
  <a href="positions.php">Manage Positions</a>
  <a href="candidates.php">Manage Candidates</a>
  <a href="results.php">Poll Results</a>
  <a href="manage-admins.php">Manage Account</a>
  <a href="change-pass.php">Change Password</a>
</div>
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px" onclick="openNav()">&#9776; </span>

<?php
//fetching the details of the admin who is logged in 
  $query= mysqli_query($con,"SELECT * FROM tbadministrators WHERE admin_id ='$_SESSION[admin_id]'") or die (mysqli_error());
  $fetch = mysqli_fetch_array($query);
  // Displaying the name of the admin whose logged , in the top bar 
  echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  ?>

<!--logout button--> 
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

</div>
</div>
 <div style="background-color: #B6AAAA; height: 700px; position: relative;">
  <div id="box">
      <p class="text1" style="text-align:center ;">UPDATE PROFILE</p>
      <!--form to update admin-->
      <form class="form" action="manage-admins.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
          <br>
          <label for="firstname">First Name</label><br>
          <input type="text" id="firstname" name="firstname" value="<?php echo $firstName ?>" required><br><br>
          <label for="lastname">Last Name</label><br>
          <input type="text" id="lastname" name="lastname"value="<?php echo $lastName ?>" required><br><br>
          <label for="email">Email Address</label><br>
          <input type="text" id="email" name="email" value="<?php echo $email?>" required><br><br>                    
          <input type="submit" value="Update" class="registerbtn" name="update">
      </form>
  </div>


       
</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
</body></html>