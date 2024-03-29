<?php
session_start();
require('../connection.php');
//This checks whether your session is valid, if not it asks to login
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
} 
//query to retrive candidates from the tbcandidates table
$result=mysqli_query($con,"SELECT * FROM tbCandidates");
if (mysqli_num_rows($result)<1){
    $result = null;
}

// query to get all positions from tbpositions table
$positions_retrieved=mysqli_query($con, "SELECT * FROM tbPositions");


// This is to get the details of the candidate we are going to edit from the candidates.php.
$id=$_GET['id'];
?>
<?php


//Get the relevant candidate data of the candidate which we need to edit
$result=mysqli_query($con, "SELECT * FROM tbcandidates WHERE candidate_id = '$id'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);//Get the result rows as array
if($row)
 {
 // get data from candidate table of the particular candidate
 $canId = $row['candidate_id'];
 $canName = $row['candidate_name'];
 $canPosition = $row['candidate_position'];

 }

//Get the information from the from and assign them to variables if id parameter is set in the url and update button is submitted
if (isset($_GET['id']) && isset($_POST['update']))
{
$myId = addslashes( $_GET['id']);
$CandName = addslashes( $_POST['cname'] ); 
$CandPosition = addslashes( $_POST['cposition'] ); 

//Update the candidate details with the newly updated information taken from the form
$sql = mysqli_query($con, "UPDATE tbcandidates SET candidate_name='$CandName', candidate_position='$CandPosition' WHERE candidate_id = '$myId'" );
header("Location: candidates.php");
}
?>

<html>
  <head>
  <title>Electoral Poll: Edit Candidate</title>
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
 //fetching the details of the admin who is logged in 
	echo "<h1 style='margin-left:500px;' class='line'> Welcome,&nbsp&nbsp <h1 class='line'>".$fetch['first_name']."</h1><h1 class='line'>!</h1></h1>";
  ?>
 <!--logout button-->
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

</div>

</div>
 <div style="background-color: #B6AAAA; height: 700px; position: relative;">
   <div id="box">
    <!--form to update profile-->
    <p class="text1" style="text-align:center ;">UPDATE PROFILE</p>
      <form class="form" action="" method="post" >
          <br>
          <label for="firstname">Candidate Name</label><br>
          <input type="text" id="cname" name="cname" value="<?php echo $canName?>" required><br><br>
          <label for="lastname">Candidate Position</label>
          <SELECT name="cposition" id="cposition">
            <OPTION VALUE="<?php echo $canPosition?>" selected><?php echo $canPosition?>
            <?php
            //loop through all the positions available
            while ($row=mysqli_fetch_array($positions_retrieved)){
            echo "<OPTION VALUE=$row[position_name]>$row[position_name]";            
            }
            ?>
          </SELECT> 
          <br><br>                                
          <a href="edit-candidate.php" style='text-decoration:none; color:#0C0C1C;' ><input type="submit" value="Edit" class="registerbtn" name="update"></a>
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
</body>
</html>