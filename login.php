<?php

	$dbhost="localhost";
	$dbuser="root";
     $dbpass="";
	$dbname="entiende.me";

     $conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

     if (!$conn) {
          die ("No hay conexion: ".mysqli_connect_error());
     }
	
     $email= $_POST["emailUsuario"];
	$pass=$_POST["passwordUsuario"];

     $query=mysqli_query($conn, "SELECT * FROM persona WHERE email='$email' and password='$pass'");
     $nr= mysqli_num_rows($query);

     if ($nr==1) {
         header("location:perfil.html");

     }
	elseif ($nr==0) {
         echo "No ingreso";
     }
	
?>