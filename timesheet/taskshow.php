<!DOCTYPE html>
<!-- DISPLAYS TASKS OF EACH PROJECT -->

<html>
<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="basic.css">

<title></title>
</head>
<style type="text/css">


    fieldset{
      width:250;
           display:inline;
           height: 30px;
    }


 .modal-content .sub{ 
      display: inline;
      width:80px;
      border: 1px;
      height: 30px;
      background-color: #7CCF17; 
      outline: none;
      color: #ffffff;
      margin-top:5px;
     
    }
   a{
    color:#7CCF17;
   }

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
		.myBtn{
  color : #ffffff;
  background-color:#7CCF17;
  height: 30px;
  width:100px;
  padding: 5px;
  padding: 10px;
   float: right;
 }

    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 50px; /* Location of the box */
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
      overflow: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 70%;
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
    #header{  
  height :100px;
 }
 th{      font-weight: normal;
  font-size: 10px;
          border: none;
          background-color: #f7f7f7;
        }
     td{
      text-align: center;
     }
</style>
<body>

<div id="header">

<div>

  
    <!--Allows users to select the project -->
    <i class='fas fa-folder-open'  style="margin:3px;color:#7CCF17"></i> Project: 
    <select name="pname" id="pname" class="pname" onchange="selectproject(this.id)" style="background-color:#f7f7f7;  height:30px; border:none; outline :none">
    <?php //creating a dropdown  
    $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
     }
    $sql ="SELECT name FROM project_info";
      $result = $conn->query($sql);
     if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
            echo "<option id=\"".$row['name']."\">".$row['name']."</option>";
    }
    } else {
    echo "0 results";
     }
     echo "</select>";
   ?>






                         <!-- The Modal -->
                      <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                          <span class="close">&times;</span><!--CLOSE ICON  -->

                      <form name="tasks" action="taskaddphp.php" method="POST">


                      <input type='text' name='proname' id='proname' value=' ' readonly>



                      <hr>

                      <div id="newlink">
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
                      <button class="sub" id="add" type="button" onclick="new_link()">add</button>
                      <input class="sub" type="submit" value="Submit">
                      </form>

                      <!-- Template -->
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

















    <?php 
    $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
     }

    //displays project information based on chosen option
    $sql = "SELECT name FROM project_info LIMIT 1";//sets default loading of the first page
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    isset($_GET["pname"])?$name=$_GET["pname"]:$name=$row["name"];

    //addbutton
    echo "<button type=\"button\" style=\"display: inline\" id='".$name."' class=\"myBtn\" onclick=\"add_click(this.id)\">ADD TASK</button>";


     /*
     //search
    echo '<form action="taskshow.php?pname=\''.$name.'\'" method="GET" style="display: inline;"> <input type="search" name="search" style="width:100px; height:20px; border:1px solid black ; display: inline; "> <input type="submit" value="search" style=" width:80px; height:20px; border:1px solid black ; display:inline;"> </form>';*/



    echo "</div>";
    //sets the select box to the project name
    echo "<script>document.getElementById(\"".$name."\").selected =\"true\"</script>";
    $sql = "SELECT * FROM project_info WHERE name='$name'";
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
           echo "<br><table><tr><td>Duration: $est hrs </td><td> Started date : $start</td><td>Due date: $end</td><td color='#7CCF17'>Organisation: $org_name</td><td>Status: $status</td></tr></table>";

        }

    } else {
        echo "0 results";
    }


echo "</div>"; //header ends here




    //display tasks details
echo "<div>";
    echo "<form action=\"taskeditphp.php\" method=\"POST\">";
    echo '<input type = "hidden" name = "projname" id="projname" value = "'.$name.'"/>';
    echo"<center><br><br><table><tr bgcolor='#f7f7f7'><th>TASK</th><th>DURATION</th><th>ESTIMATE</th><th colspan=2>DATE</th><th>STATUS</th><th>EMPLOYEE</th></tr>";
     /*$search=NULL;
     if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $search=$_GET["search"];
      }
      if (isset($search)) {
      $sql = "SELECT task,emp_name,estimated,from_date,to_date,status,duration FROM assignment WHERE project_name='$name' && (task='$search'||emp_name='$search'||estimated='$search'||from_date='$search'||to_date='$search'||status='$search'||duration='$search')";
      }
      else{}*/
      $sql = "SELECT task,emp_name,estimated,from_date,to_date,status,duration FROM assignment WHERE project_name='$name'";
    $result = $conn->query($sql);
    $i=1;
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo "<tr><td class=\"".$i."\">".$row["task"]."</td><td class=\"".$i."\">".$row["duration"]."</td><td class=\"".$i."\">".$row["estimated"]."</td><td class=\"".$i."\">".$row["from_date"]."</td><td class=\"".$i."\">".$row["to_date"]."</td><td class=\"".$i."\">".$row["status"]."</td><td class=\"".$i."\">".$row["emp_name"]."</td><td class=\"".$i."\" >"."<button type=\"button\" class=\"".$i."\" onClick=\"edit_click(this.className)\"><i class=\"fas fa-pen\"></i></button>"."</td> <td class=\"".$i."\">"."<button type=\"button\" class=\"".$i."\" onClick=\"delete_click(this.className)\"><i class=\"fas fa-trash\"></i></button>"."</td></tr>";
           $i++;
        }
         echo "</table>";

    } else {
      
        echo "0 results";
    }

    echo "</table></center></form>";

    $conn->close();
?>


</div>




















 <script type="text/javascript">
function delete_click(bid) //on delete button
{
    var y;
    var x=document.getElementsByClassName(bid);
    y=x[0].innerHTML;
    var z=document.getElementById("projname").value;
 window.location.href="taskdelete.php?uid="+y+"&text2="+z;
}

function edit_click(bid) //on clicking edit button
{   //receiving class name in bid
    var y;
    var x=document.getElementsByClassName(bid);

    y=x[0].innerHTML;
    x[0].innerHTML='<input type="text" name="task" style="width:100px; height:10px;" id="fix" readonly>';
    document.getElementById("fix").defaultValue = y;

    y=x[1].innerHTML;
    x[1].innerHTML='<input type="text" name="duration" id="duration" style="width:100px; height:10px;">';
    document.getElementById("duration").defaultValue = y;

    y=x[2].innerHTML;
    x[2].innerHTML='<input type="text" name="estimate" id="estimate" style="width:100px; height:10px;">';
    document.getElementById("estimate").defaultValue = y;

    y=x[3].innerHTML;
    x[3].innerHTML='<input type="date" name="from" id="from" style="width:100px; height:10px;">';
    document.getElementById("from").defaultValue = y;

    y=x[4].innerHTML;
    x[4].innerHTML='<input type="date" name="to" id="to" style="width:100px; height:10px;">';
    document.getElementById("to").defaultValue = y;

    y=x[5].innerHTML;
    x[5].innerHTML='<select name="status" id="status" style="width:100px; height:20px;"><option>----</option><option>Active</option><option>Inactive</option></select>';
     document.getElementById("status").defaultValue = y;
     
    y=x[6].innerHTML;
    x[6].innerHTML='<input type="text" name="emp" id="emp" style="width:100px; height:10px;" readonly>';
    document.getElementById("emp").defaultValue = y;
     
    x[7].innerHTML='<input type="submit" value="save" style="width:50px; height:20px;">';
   

}
function add_click(bid){

modal.style.display = "block";
document.getElementById("proname").value=bid;


}

function selectproject(bid){
 
 var selected=document.getElementById(bid);
 var x=selected.value;
  window.location.href="taskshow.php?pname="+x;
}
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementsByClassName("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  
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
var ct = 1;
function new_link()// creates new assigning content
{
  ct++;
  var div1 = document.createElement('div');
  div1.id = ct;
  // link to delete extended form elements
  var delLink = '<div style="text-align:right; margin-right:65px"><a href="javascript:delIt('+ ct +')"><i class="fas fa-user-minus"></i></a></div>';
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

 </script>
</body>
</html>