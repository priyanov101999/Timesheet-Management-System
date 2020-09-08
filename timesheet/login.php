<!DOCTYPE html>
<!-- login page gest username and password and feeds it to loginpro.php -->
<html>
<head>
  <title>TimeSheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<style type="text/css">
 #logo{
  background-image: url('logo.png');
  height :60px;
  width :60px;
  margin-top: 70px;


 }
    input{
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
        height :40px;
        width :320px;
        outline:none;
        border: none;
   }
   .btn{
        background-color: #ffffff;
        height :42px;
        width :40px;
        outline:none;
        border: none;
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;

   }
   #form{
     margin-top: 110px;

   }
   #submit{
     background-color: #ff3333;
     color:white;
     width :360px;
     border-top-left-radius: 3px;
     border-bottom-left-radius: 3px;

   }
    </style>


</head>
<body bgcolor=" #0a1429">
        <center>
          <div id="logo"></div>
          <div id="form">
    	  <form action="loginpro.php" method="POST">

         <button class="btn"><i class="fas fa-user"></i></button><input type="text" name="username" placeholder="Username" required id="username"><br><br><br>

         <button class="btn"><i class="fas fa-key"></i></button><input type="password" name="pswd" placeholder="Password" required><br><br><br><br>
         <input type="submit" value="Sign In" id="submit">
    	 </form> 	 
       <div>
         <?php 
         if(isset($_GET["err"])){
            echo "<script> alert(\"login unsucessful\"); </script>";
         } 
 
          ?>
          </center>
</body>
</html>