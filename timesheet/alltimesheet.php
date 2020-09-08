<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="basic.css">
	<title></title>
	<style type="text/css">

		input,select{
			width: 200px;
			height: 20px;
			border: none;
			outline: none;
		}
		fieldset{
			width:350;
            display:inline;
            height: 30px;
		}
   th{      font-weight: normal;
          font-size: 12px;
          border: none;
          background-color: #f7f7f7;
        }
        td{
      text-align: center;
     }

     
	</style>
</head>
<body>

<?php

   $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
     }


    $sql = "SELECT username FROM employee_information LIMIT 1";//sets default loading of the first page
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

   isset($_GET["pname"])?$name=$_GET["pname"]:$name=$row["username"];


echo "<div id='header'>";
//echo "Employee: <input type='text' id='uname' class='heading' value='".$name."' readonly>";
echo '<i class="fas fa-users" style="margin:3px;color:#7CCF17"></i>Employee:<select name="pname" id="pname" class="pname" onchange="dateselect(this.id)" style="width:140px; margin:30px; margin-left:10px;margin-top:10px;background-color:#f7f7f7;  height:30px; border:none; outline :none">';
   //creating a dropdown  
    
    $sql ="SELECT username FROM employee_information";
      $result = $conn->query($sql);
     if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
            echo "<option id=\"".$row['username']."\">".$row['username']."</option>";
    }
    } else {
    echo "0 results";
     }
     echo "</select>";

 echo "<script>document.getElementById(\"".$name."\").selected =\"true\"</script>";

$today=date("Y-m-d");
$after7=date('Y-m-d',strtotime('-7 days'));
isset($_GET["start"])?$start=$_GET["start"]:$start=$after7;
isset($_GET["end"])?$end=$_GET["end"]:$end=$today;

echo "From:<input type='date' style='width:140px;background-color:#f7f7f7; margin:30px; margin-left:10px;margin-top:10px; height:30px; border:none; outline :none;' class=\"pname\" id='from' value='".$start."' onchange=\"dateselect(this.className)\"> To:<input type='date' style='width:140px; margin:30px; margin-top:10px; margin-left:10px; background-color:#f7f7f7;  height:30px; border:none; outline :none'  value='".$end."' class=\"pname\" id='to' onchange=\"dateselect(this.className)\">";

echo "</div><br><br>";
///HEADER TILL HERE
 echo '<center>' ;
echo '<table width=80% border=1px><tr bgcolor=" #d9b3ff"><th>DATE</th><th>PROJECT</th><th>TASK</th><th>HOUR</th><th>DESCRIPTION</th></tr>';
$sql = "SELECT * FROM $name WHERE Date BETWEEN '$start' AND '$end'";
$result = $conn->query($sql);
$i=1;
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      //displays client list table using select and adds edit,delete button
        echo "<tr><td class=\"".$i."\">".$row["Date"]."</td><td class=\"".$i."\">".$row["project"]."</td><td class=\"".$i."\">".$row["task"]."</td><td class=\"".$i."\">".$row["hour"]."</td><td class=\"".$i."\">".$row["description"]."</td></tr>";
       $i++;//class names give the row number to determine which edit was clicked
    }
     

} else {
    echo "O results";
}
echo "</table>";

$conn->close();


?>
</center>
<script type="text/javascript">

	function dateselect(bid){
    var selected=document.getElementById(bid);
    var x=selected.value;
    var start=document.getElementById("from").value;
    var end=document.getElementById("to").value;
    window.location.href="alltimesheet.php?start="+start+"&end="+end+"&pname="+x;
    }
   

</script>
</body>
</html>