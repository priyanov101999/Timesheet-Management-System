<!DOCTYPE html>
<!-- displays client information -->
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="basic.css">
<style>


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 3; /* Sit on top */
  padding-top: 40px; /* Location of the box */
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
  padding: 10px;
  border: 1px solid #888;
  width: 45%;
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

.edit{
      background-color: white;
      border: none;
    }

 
 #sub{
      width:80px;
    }
     input,textarea,select {
      width: 500px;
      height: 25px
    }

</style>
</head>
<body>



<div id="header">

<div id="actinact">
<?php
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "SELECT COUNT(client_name) AS count FROM client_information WHERE status='Active'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
         $active=$row["count"];
      }
    echo " Active Clients <span style='color: #33cc00;'> $active </span> |";
} else {
    echo "0 results";
}
$sql = "SELECT COUNT(client_name) AS count FROM client_information WHERE status='Inactive'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
         $inactive=$row["count"];
      }
    echo "  Inactive Clients <span style='color: #0066ff;'> $inactive </span> |";
} else {
    echo "0 results";
}
?>

</div>


<!--ADDS CLIENTS  -->


<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span><!--CLOSE ICON  -->
     <form name="clientinfo" action="clientaddphp.php" method="POST" >
      <fieldset>
      <legend><h1 style="margin-top: -13px;">Client information:</h1></legend>
    Name:<br>
    <input type="text" name="name"><br><br>
    Organisation Name:<br>
    <input type="text" name="orgname"><br><br>
    Telephone:<br>
    <input type="text" name="phno"><br><br>
    Address:<br>
    <textarea name="address"></textarea><br><br>
    Status:<br>
    <select name="status">
      <option>----</option>
      <option>Active</option>
         <option>Inactive</option>    
    </select><br><br>
    <input id="sub" type="submit" value="add client" style="color : #ffffff;
  background-color:#7CCF17;
  height: 30px;
  width:100px;
  padding: 5px;">
 </fieldset>
</form>
  </div>
</div>


<!--DISPLAYS CLIENT INFORMATION  -->

<!--search option -->
<div id="addsear">
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" style="display: inline;">
  <div bgcolor="#f7f7f7" style="display:inline;  height:30px;background-color:#f7f7f7;"><input type="search" name="search" style="width:140px;background-color:#f7f7f7;  height:30px; border:none; outline :none" placeholder=" search">
  <button type="submit" style="background-color:#f7f7f7;height:30px;margin-left:-4px; color: grey;"><i class="fas fa-search"></i></button></div>
  
</form>
<!-- Trigger/Open The Modal -->
<button id="myBtn">ADD CLIENT</button>
<button type="button" onclick="refresh()"><i class="fas fa-redo"></i></button>
</div>
</div>

<br>
<br>


<form action="clienteditphp.php" method="post"><!--FORM USED HERE SO THAT EDIT COULD HAPPEN  -->
<center>
  <table>

<?php
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
//chooses whether to use search or not and changes sql statement
$search=NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $search=$_POST["search"];
}
if (isset($search)) {
  $sql = "SELECT * FROM client_information WHERE client_name='$search'||status='$search'||org_name='$search'||telephone='$search'||address='$search'";
}
else{
$sql = "SELECT * FROM client_information";
}
$result = $conn->query($sql);
$i=1;
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      //displays client list table using select and adds edit,delete button
        echo "<tr><td><button><i class=\"fas fa-user-circle\"></i></button></td><td class=\"".$i."\">".$row["client_name"]."</td><td class=\"".$i."\" id=\"org\">".$row["org_name"]."</td><td class=\"".$i."\">".$row["telephone"]."</td><td class=\"".$i."\">".$row["address"]."</td><td class=\"".$i."\">".$row["status"]."</td><td class=\"".$i."\" >"."<button type=\"button\" class=\"".$i."\" onClick=\"edit_click(this.className)\"><i class=\"fas fa-pen\"></i></button>"."</td> <td class=\"".$i."\">"."<button type=\"button\" class=\"".$i."\" onClick=\"delete_click(this.className)\"><i class=\"fas fa-trash\"></i></button>"."</td></tr>";
       $i++;//class names give the row number to determine which edit was clicked  
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
    window.location.href="clientshow.php";
}
function delete_click(bid) //on clicking delete button
{
    var y;
    var x=document.getElementsByClassName(bid);
    y=x[0].innerHTML;
   
 window.location.href="clientdeletephp.php?uid="+y;
}

function edit_click(bid) //on clicking edit button
{
     var y;
    var x=document.getElementsByClassName(bid);
    y=x[0].innerHTML;
    x[0].innerHTML='<input type="text" name="name" style="width:100px; height:10px;" id="fix" readonly>';
    document.getElementById("fix").defaultValue = y;
    y=x[1].innerHTML;
    x[1].innerHTML='<input type="text" name="oname" id="oname" style="width:100px; height:10px;">';
    document.getElementById("oname").defaultValue = y;
    y=x[2].innerHTML;
    x[2].innerHTML='<input type="text" name="contact" id="contact" style="width:100px; height:10px;">';
    document.getElementById("contact").defaultValue = y;
    y=x[3].innerHTML;
    x[3].innerHTML='<input type="text" name="address" id="address" style="width:100px; height:10px;">';
    document.getElementById("address").defaultValue = y;
    y=x[4].innerHTML;
    x[4].innerHTML='<select name="status" id="status" style="width:100px; height:20px;"><option>----</option><option>Active</option><option>Inactive</option></select>';
     document.getElementById("status").defaultValue = y;
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
