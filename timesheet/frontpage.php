<!DOCTYPE html>
<!-- main page of the system providesz acces to all the features -->
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="basic.css">
	<title>TimeSheet</title>
</head>

<style type="text/css">
.sidebar {
  height: 100%;
  width: 60px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color:#0a1429;
  overflow-x: hidden;
  padding-top: 20px;
	}
 a{
   padding: 6px 8px 6px 16px;
  font-size: 17px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width:100%;
  text-align: left;
  cursor: pointer;
  outline: none;

}
.sidebar a:hover{
  color: #f1f1f1;
}
#iframe{ 
  background-color:#f7f7f7;
  overflow: hidden;
  border:none;
  margin-left:48px; 
  margin-top:-10px;
  margin-bottom:-20px;

}
#iframe::-webkit-scrollbar
 { display: none; }
 
#logo{
  background-image: url('logo1.png');
  height :30px;
  width :30px;
  margin-bottom: 40px;
 }

</style>


<body>
<div class="sidebar">
  <center>
    <div id="logo"></div>
       <!-- sidebar icons -->
       <a href="unfilled.php" target="contents"><i class="fas fa-chart-bar"></i></a><br>
      <a href="alltimesheet.php" target="contents"><i class="fas fa-business-time"></i></a><br>
      
      <a href="projectshow.php" target="contents"><i class="fas fa-folder-open"></i></a> <br>
      <a href="taskshow.php" target="contents"><i class="fas fa-tasks"></i></a><br>   
      <a href="clientshow.php" target="contents"><i class="fas fa-address-card"></i></a> <br>
      <a href="empshow.php" target="contents"><i class="fas fa-users"></i></a><br>
      
       <?php
    isset($_GET["pname"])?$uname=$_GET["pname"]:$uname=" "; //getting the username from login page form field
    echo '';
    echo '<a href="timesheetshow.php?pname='.$uname.'" target="contents"><i class="fas fa-clock"></i></a>'; //shows managers personel timesheet
    echo '<br><br><br><br><a id="log" href="login.php"><i class="fas fa-power-off"></i></a>'; //logout button
echo "</div>";
echo '<iframe height="780px" width="1224px" src="timesheetshow.php?pname='.$uname.'"  id="iframe" name="contents"></iframe>'; //default page is timesheet of manager 
// passing username through the url link pname to the next page
?>
</center>
</body>

</html>