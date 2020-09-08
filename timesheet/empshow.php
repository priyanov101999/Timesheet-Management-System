<!DOCTYPE html>
<!--employee display page-->

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="basic.css">
<style>
      h1{
    display: inline;
  }
  a{
    margin-left: 10px;
  }
  input,textarea,select {
      width: 500px;
      height: 25px
    }
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 20px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 45%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.edit{
      background-color: white;
      border: none;
    }
    #box{
      height:200px;
    }
 #sub,#mail{
      width:100px;
    }

</style>
</head>
<body>
<div id="header">

<div id="actinact">

<h2 style="display: inline">Employees</h2>

</div>

<!--employee add button-->

<!-- Trigger/Open The Modal -->


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
  <span class="close">&times;</span>
<form name="empinfo" action="employeeaddphp.php" method="post">
<fieldset>
    <legend><h2 style="margin-top: -13px;">Employee information:</h2></legend>
    UserName:<br>
    <input type="text" name="username"><br><br>
    Password:<br>
    <input type="Password" name="pswd"><br><br>
    Name:<br>
    <input type="text" name="name"><br><br>
    Telephone:<br>
    <input type="tel" name="phno"><br><br>
    Email Address:<br>
    <input type="email" name="email"><br><br>
    Role:<br>
    <select name="role">
      <option>----</option>
      <option>Administrator</option>
         <option>Employee</option>    
    </select><br><br>
  <!--  Send Mail Notification<input id=mail type="checkbox" name="mailnotif" value="jjj"><br><br> -->

    <input id="sub" type="submit" value="Add employee" style="color : #ffffff;
  background-color:#7CCF17;
  height: 30px;
  width:100px;
  padding: 5px;">
 </fieldset>
</form>
  </div>

</div>




<!--employee search-->
<div id="addsear">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" style="display: inline;">
  <div bgcolor="#f7f7f7" style="display:inline;  height:30px;background-color:#f7f7f7;">
    <input type="search" name="search" style="width:140px;background-color:#f7f7f7;  height:30px; border:none; outline :none" placeholder=" search">
  <button type="submit" style="background-color:#f7f7f7;height:30px;margin-left:-4px; color: grey;"><i class="fas fa-search"></i></button></div>
  </form>

<button id="myBtn" style="width: 150px">ADD EMPLOYEE</button>
<button type="button" onclick="refresh()"><i class="fas fa-redo"></i></button>
</div>
</div>
<br>
<br>



<!--employee display page-->

  <form action="empeditphp.php" method="post">
    <center>
<table>
<?php
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}


$search=NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $search=$_POST["search"];
}
if (isset($search)) {
  $sql = "SELECT username,name,telephone,email,role FROM employee_information WHERE username='$search'||name='$search'||telephone='$search'||email='$search'||role='$search'";
}
else{
$sql = "SELECT username,name,telephone,email,role FROM employee_information";
}


$result = $conn->query($sql);
$i=1;
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      //gets rowds
        echo "<tr><td><button><i class=\"fas fa-user-circle\"></i></button></td><td class=\"".$i."\">".$row["username"]."</td><td class=\"".$i."\">".$row["name"]."</td><td class=\"".$i."\">".$row["telephone"]."</td><td class=\"".$i."\">".$row["email"]."</td><td class=\"".$i."\">".$row["role"]."</td><td class=\"".$i."\" >"."<button type=\"button\" class=\"".$i."\" onClick=\"edit_click(this.className)\"><i class=\"fas fa-pen\"></i></button>"."</td><td class=\"".$i."\" >"."<button type=\"button\" class=\"".$i."\" onClick=\"delete_click(this.className)\"><i class=\"fas fa-trash\"></i></button>"."</td></tr>";
       $i++;

    }
     echo "</table>";

} else {
    echo "0 results";
}
$conn->close();
?>
</center>
</form>



<script>
function refresh(){
    window.location.href="empshow.php";
}

function delete_click(bid) //on clicking edit button
{
    var y;
    var x=document.getElementsByClassName(bid);
    y=x[0].innerHTML;
    window.location.href="empdeletephp.php?uid="+y;
}

function edit_click(bid) //on clicking edit button
{
    var y;
    var x=document.getElementsByClassName(bid);
    y=x[0].innerHTML;
    x[0].innerHTML='<input type="text" name="uname" style="width:100px; height:10px;" id="fix" readonly>';
    document.getElementById("fix").defaultValue = y;
    y=x[1].innerHTML;
    x[1].innerHTML='<input type="text" name="name" id="name" style="width:100px; height:10px;">';
    document.getElementById("name").defaultValue = y;
    y=x[2].innerHTML;
    x[2].innerHTML='<input type="text" name="contact" id="contact" style="width:100px; height:10px;">';
    document.getElementById("contact").defaultValue = y;
    y=x[3].innerHTML;
    x[3].innerHTML='<input type="text" name="email" id="email" style="width:100px; height:10px;">';
    document.getElementById("email").defaultValue = y;
    y=x[4].innerHTML;
    x[4].innerHTML='<select name="role" id="role" style="width:100px; height:20px;"><option>----</option><option>Administrator</option><option>Employee</option></select>';
     document.getElementById("role").defaultValue = y;
    x[5].innerHTML='<input type="submit" value="submit" style="width:50px; height:20px;">';

}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
