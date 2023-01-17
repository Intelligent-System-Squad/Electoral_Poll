<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simple PHP Polling System Access Denied</title>
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
    #addbutton{
      background-color: #504F4F;
      border-radius: 5px;     
      padding: 6px 25px;
      font-weight: bold;
      font-size: 14px;
      color:#FFFF;
    }
    input{
      height:18px;
      width:240px;

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
.space {
            width: 20px;
            height: auto;
            display: inline-block;
        }
.container{
    position: absolute;
    
}
#logo{          
            position: absolute;
            margin-top: 100px; 
            margin-left:150px;      
           
        }
        #box{
            background-color: #D49FE7;
            height: 450px;
            width: 500px;            
            margin-left:700px;
            position:relative;
            margin-top:70px;              
        }
        .form{
            background-color: #0C0C1C;
            position:absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            margin:0;        
            height: 400px;
            width:450px;           
            color: #DDBEBE;
            text-align:center;
            font-size: 20px;                      
        }
        .box1{
          float:left;
        }
</style>
</head>
<body>
<div style="background-color: #0C0C1C;">

<div class="mainnav">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="admin.php">Home</a>
  <a href="positions.php">Manage Positions</a>
  <a href="candidates.php">Manage Candidates</a>
  <a href="refresh.php">Poll Results</a>
  <a href="manage-admins.php">Manage Account</a>
  <a href="change-pass.php">Change Password</a>
</div>
<span class="line" style="font-size:30px;cursor:pointer;color:#FFFF; margin-top:20px" onclick="openNav()">&#9776; </span>
<a href="logout.php"><button class="line" id="buttons" style="margin-left:300px ;margin-top:20px">Log Out</button></a>

</div>

<div style="background-color: #B6AAAA; height: 700px; position: relative;">
<div class="container" >
<div id="logo" class="box1">
                    
                    <img src="logoo.jpeg" width="300px" height="380px">
                    </div>
                    <div id="box" class="box1">                   
                    
                    
                    <div class="form">
                    <h2 style="margin-top:60px"> ACCESS DENIED!</h2><br>
                    <p>Dear Admin, <br><br>
                      You are not currently logged in.<br><br>
                      <a href="login.html">Click here </a> to login first<br><br>
                       to get access to the privileges<br><br>
                       of an admin.<br><br></p>

                    </div>
    </div>

                    
                      
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