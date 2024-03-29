<?php
session_start();
require('../connection.php');
//This check whether your session is valid, if not asks you to login
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
} 
//Get all the voters from the voters table
$result=mysqli_query($con,"SELECT * FROM tbmembers");
if (mysqli_num_rows($result)<1){
    $result = null;
}
?>

<?php
// This is to get the details of the voter we are going to edit from voters.php page.
$id=$_GET['id'];
?>
<?php

//This is to show the data in the update form
$result=mysqli_query($con, "SELECT * FROM tbmembers WHERE member_id = '$id'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from database
 $votId = $row['member_id'];
 $votFirstName = $row['first_name'];
 $votLastName = $row['last_name'];
 $votEmail = $row['email'];
 $votPassword = $row['password'];

 }

//getting the data from the edit voter form
if (isset($_GET['id']) && isset($_POST['update']))
{
$myId = addslashes( $_GET['id']);
$voterFirstName = addslashes( $_POST['f_name'] ); //prevents types of SQL injection
$voterLastName = addslashes( $_POST['l_name'] ); //prevents types of SQL injection
$voterEmail = addslashes( $_POST['eml'] ); //prevents types of SQL injection
$voterPassword = addslashes( $_POST['psw'] ); //prevents types of SQL injection
$emailCheckQuery = "SELECT COUNT(*) as count FROM tbmembers WHERE email = '$voterEmail' AND member_id <> '$myId'";//Check uniqueness of email
$emailCheckResult = mysqli_query($con, $emailCheckQuery);
$emailCount = mysqli_fetch_assoc($emailCheckResult)['count'];
if ($emailCount > 0) {
  // Email is not unique      
  echo "<script>alert('Email address is not unique. Please choose a different email.');</script>"; 
}else{   

//Updating the tbmembers table with the new details received from the edit voter form  
$sql = mysqli_query($con, "UPDATE tbmembers SET first_name='$voterFirstName', last_name='$voterLastName', email='$voterEmail', password='$voterPassword' WHERE member_id = '$myId'" );
header("Location: voters.php");
}
}

?>

 <html><head>
 <title>Electoral Poll: Edit Voter</title>
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
    #buttons {
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
<body >
<div style="background-color: #0C0C1C;">
<!--Side navigation bar-->
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
 //fetching the details of the admin who is logged in 
	echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  ?>
<!--logout button--> 
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

</div>
</div>
 <div style="background-color: #B6AAAA; height: 700px; position: relative;">
    <div id="box">
        <p class="text1" style="text-align:center ;">UPDATE PROFILE</p>
        <!--from to edit voter-->
        <form class="form" action="" method="post" >
            <br>
            <label for="firstname">Voter First Name</label><br>
            <input type="text" id="f_name" name="f_name" value="<?php echo $votFirstName?>" required><br><br>
            <label for="lastname">Voter Last Name</label>
            <input type="text" id="l_name" name="l_name" value="<?php echo $votLastName?>" required><br><br>
            <label for="lastname">Email</label>
            <input type="text" id="eml" name="eml" value="<?php echo $votEmail?>" required><br><br>
            <label for="lastname">Password</label>
            <input type="text" id="psw" name="psw" value="<?php echo $votPassword?>" required><br><br>                    
            <br><br>                                
             <a href="edit-voter.php" style='text-decoration:none; color:#0C0C1C;' ><input type="submit" value="Edit" class="registerbtn" name="update"></a>
        </form>
    </div>
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