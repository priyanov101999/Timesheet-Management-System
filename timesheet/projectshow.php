<!DOCTYPE html>
<!--DISPLAYS PROJECTS PAGE -->
<html>
<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="projectdesign.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>display project</title>
	<style type="text/css">
    body{
  font-family: Arial, Helvetica, sans-serif;
  font-size: 14px;
  color:#404040;
  overflow-x:hidden;
   }

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 30px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  /*background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;

  padding: 20px;
  padding-bottom: 40px;
  border: 1px solid #888;
  width: 75%;
}

/* The Close Button in modal*/
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

  .myBtn{
  color : #ffffff;
  background-color:#7CCF17;
  height: 30px;
  width:100px;
  padding: 5px;
  padding: 10px;
  
 }
.estim{
  
  border-radius: 5px;
  border: none; 
  outline: none;
  background-color: #EA202C; 
  max-width: 200px; 
  min-height: 50px;
  margin: 5px;
  padding: 10px;
  display: inline;
  

}

</style>
</head>
<body>





<!--SIDEBAR -->

<div class="sidebar">
 <div style="background-color: #ffffff;"><hr><h4><center>PROJECTS</center> </h4><hr></div><br>
<?php
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name,end,est_hours FROM project_info";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

    	$name=$row["name"];
    	$end=$row["end"];
    	$est=$row["est_hours"];
      echo " <button type=\"button\" id='".$name."' onClick=\"edit_click(this.id)\">".$name."<br><br>".$end."(".$est."hrs)</button><br>";
    }
}
$conn->close();
?>

<!-- Trigger/Open The Modal -->
<button id="myBtn">+ New Project</button>
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span><!--CLOSE ICON  -->
     <h3>Project Form</h3>
<hr>

<!--form feilds -->

<form name="Project" action="projectaddphp.php" method="POST">
<div id="newlink">
<div>
<fieldset> 
    <legend>Project Name</legend>
    <input type="text" name="pname" class='proform'>
</fieldset>
<fieldset>
    <legend>Client Name</legend>
    <select name="clientdropdown" class='proform'>
     <?php //creating a dropdown
    $conn = new mysqli("localhost","root","","timesheet");
    if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
    }
    $sql ="SELECT client_name FROM client_information";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    echo '<option>----</option>';
    while($row = $result->fetch_assoc()) {
       echo '<option value="'.$row['client_name'].'">'.$row['client_name'].'</option>';   
    }
    } else {
    echo "0 results";
     }
   $conn->close();
    ?>
     </select>
 </fieldset>
<fieldset>
    <legend>Organisation Name</legend>
     <select name="orgdropdown" class='proform'>
         <?php //creating a dropdown
    $conn = new mysqli("localhost","root","","timesheet");
    if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
    }
    $sql ="SELECT org_name FROM client_information";
      $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    echo '<option>----</option>';
    while($row = $result->fetch_assoc()) {
       echo '<option value="'.$row['org_name'].'">'.$row['org_name'].'</option>';
       
    }
    } else {
    echo "0 results";
     }
   $conn->close();
    ?>
 
  </select>
 </fieldset>
 <br><br>


  <fieldset>
    <legend>Mail</legend>
    <input type="email" name="mail" class='proform'>
 </fieldset>
 <fieldset>
    <legend>Contact:</legend>
    <input type="text" name="phone" class='proform'>
 </fieldset>
 <fieldset>
    <legend>Status</legend>
    <select name="status" class='proform'>
        <option>----</option>
        <option>Active</option>
         <option>Completed</option>    
    </select>
</fieldset>
 <br><br>
<fieldset>
    <legend>Start Date</legend>
    <input type="date" name="stadate" class='proform'>
 </fieldset>
  <fieldset>
    <legend>Target Date</legend>
    <input type="date" name="tardate" class='proform'>
 </fieldset>
   <fieldset>
    <legend>Estimated Hours</legend>
    <input type="number" name="esth" class='proform'>
 </fieldset>

 <fieldset id="des">
    <legend>Description</legend>
    <textarea name="desc"></textarea>
   </fieldset>
<br>
<fieldset>
    <legend>Assigning to:</legend>
    <select name="assn[]">
         <?php //creating a dropdown
    $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
     }
    $sql ="SELECT name FROM employee_information";

      $result = $conn->query($sql);
     if ($result->num_rows > 0) {
    echo '<option>----</option>';
    while($row = $result->fetch_assoc()) {
       echo '<option>'.$row['name'].'</option>';
       
    }

     } else {
    echo "0 results";
     }
$conn->close();
?>
</select>
 </fieldset>
 <fieldset>
     <legend>Task Name:</legend>
    <input type="text" name="task[]">
    </fieldset>
    <fieldset>
    <legend>Estimate hours:</legend>
    <input type="number" name="estimate[]">
    </fieldset>
     <fieldset>
    <legend>From Date:</legend>
    <input type="date" name="frodate[]">
    </fieldset>
    <fieldset>
    <legend>To Date:</legend>
    <input type="date" name="todate[]">
    </fieldset>
     <fieldset>
    <legend>Status:</legend>
     <select name="stat[]">
        <option>----</option>
        <option>Active</option>
         <option>Inactive</option>    
    </select>
 </fieldset>
 <br>
 </div>
</div>
<button class="sub" id="add" type="button" onclick="new_link()" style="display: inline;color : #ffffff;
  background-color:#7CCF17;
  height: 30px;
  border-radius: 0px;
  width:100px;
  padding: 5px;
  padding: 10px;" class="myBtn">add</button>
<input class="sub" type="submit" value="Submit" id="submit" class="myBtn" style="display: inline;color : #ffffff;
  background-color:#7CCF17;
  height: 30px;
  width:100px;
  padding: 5px;
  padding: 10px;">
</form>






<!-- Template  for dynamically adding input boxes -->
<div id="newlinktpl" style="display:none">
<div>
  
<fieldset>
    <legend>Assigning to:</legend>
    <select name="assn[]">
         <?php //creating a dropdown
    $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
     }
    $sql ="SELECT name FROM employee_information";

      $result = $conn->query($sql);
     if ($result->num_rows > 0) {
    echo '<option>----</option>';
    while($row = $result->fetch_assoc()) {
       echo '<option>'.$row['name'].'</option>';
       
    }

     } else {
    echo "0 results";
     }
$conn->close();
?>
</select>
 </fieldset>
 <fieldset>
    <legend>Task Name:</legend>
    <input type="text" name="task[]">
 </fieldset>
  <fieldset>
    <legend>Estimate hours:</legend>
    <input type="number" name="estimate[]">
 </fieldset>
 <fieldset>
 <legend>From Date:</legend>
    <input type="date" name="frodate[]">
    </fieldset>
  <fieldset>
    <legend>To Date:</legend>
    <input type="date" name="todate[]">
 </fieldset>
 <fieldset>
    <legend>Status:</legend>
     <select name="stat[]">
        <option>----</option>
        <option>Active</option>
         <option>Inactive</option>    
    </select>
 </fieldset>
 <br>
</div>
</div>

  </div>
</div>
</div>


<!--MAIN CONTENT -->

<div id="content" >



<?php
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM project_info LIMIT 1";//sets default loading of the first page
$result = $conn->query($sql);
$row = $result->fetch_assoc();

isset($_GET['name'])?$i=$_GET['name']:$i=$row["name"];
//title
echo "<h2 style='display:inline; margin-top:15px;'>$i</h2><a href='' style='display:inline;'><i class=\"fas fa-pen\"></i></a><a href='' style='display:inline; float:right; width:30px;height30px;'><i class=\"fas fa-trash\"></i></a><br><br><hr><br>";

$sql = "SELECT * FROM project_info WHERE name='$i'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $name=$row["name"];
    	$end=$row["end"];
    	$est=$row["est_hours"];    
        $client_name=$row["client_name"];
        $org_name=$row["org_name"];
        $mail=$row["mail"];
        $contact=$row["contact"];
        $status=$row["status"];
        $start=$row["start"];
        $description=$row["description"];
       echo "<table><tr><th>Duration:</th><th>Start date:</th><th>Due date:</th><th>Status:</th></tr><tr><td>$est</td><td>$start</td><td>$end</td><td>$status</td></tr></table>";
       echo "<br><div><b>Description:</b><p>$description</p></div><br>";
       echo "<b>Client Details:</b>";
       echo "<div id='cusdeet'><br>$client_name<br>$org_name<br>$mail<br>$contact</div>";   
    }

} else {
    echo "0 results";
}


$sql = "SELECT task,estimated FROM assignment WHERE project_name='$i'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

      echo "<br><br><div><b>Estimation Details:</b><br><div>";
       $sum=0;
      while($row = $result->fetch_assoc()) {
        $task=$row["task"];
        $estimated=$row["estimated"];    //estimation for each employee
       $sum+=$estimated;
       echo "<button class='estim'>$task($estimated hrs)</button>";
      }
  
      echo "</div><br><p style='color:grey; margin-left:20px; margin-top:0px'>Detailed Estimation Total:".$sum." hrs</p>";
      echo "</div><br>";

} else {
    echo "0 results";
}


$sql = "SELECT emp_name,estimated FROM assignment WHERE project_name='$i'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

      echo "<div>";
       $sum=0;
      while($row = $result->fetch_assoc()) {
        $emp_name=$row["emp_name"];
        $estimated=$row["estimated"];    //estimation for each employee
       $sum+=$estimated;

       echo "<button class='estim'>$emp_name($estimated hrs)</button>";
      }
  
      echo "</div><br><p style='color: grey; margin-left:20px; margin-top:0px'>People Estimation Total:".$sum." hrs</p>";

} else {
    echo "0 results";
}

$conn->close();

?>


</div>

<script type="text/javascript">

var ct = 1;
function new_link()// creates new assigning content
{
  ct++;
  var div1 = document.createElement('div');
  div1.id = ct;
  // link to delete extended form elements
  var delLink = '<div style="text-align:right; margin-right:65px"><a href="javascript:delIt('+ ct +')"><i class="fas fa-user-minus"></a></div>';
  div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
  document.getElementById('newlink').appendChild(div1);
}
// function to delete the newly added set of elements
function delIt(eleId)//deletes added
{
  d = document;
  var ele = d.getElementById(eleId);
  var parentEle = d.getElementById('newlink');
  parentEle.removeChild(ele);
}

function edit_click(bid){
window.location.href="projectshow.php?name="+bid;
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