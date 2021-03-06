<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="entiende.me";

$conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
     die ("No hay conexion: ".mysqli_connect_error());
} ?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>Entiende.me</title>
     <meta name="description" content="Ela Admin - HTML5 Admin Template">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" type="image/png" href="assets/img/favicon.png">

     <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
     <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
     <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
     <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
     <link rel="stylesheet" href="assets/css/style.css">
     <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
     <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">

     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300&display=swap" rel="stylesheet">

     <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
     <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
     <script src="https://kit.fontawesome.com/8fd95b6180.js" crossorigin="anonymous"></script>

     <style>
          #weatherWidget .currentDesc {
               color: #ffffff !important;
          }

          .traffic-chart {
               min-height: 335px;
          }

          #flotPie1 {
               height: 150px;
          }

          #flotPie1 td {
               padding: 3px;
          }

          #flotPie1 table {
               top: 20px !important;
               right: -10px !important;
          }

          .chart-container {
               display: table;
               min-width: 270px;
               text-align: left;
               padding-top: 10px;
               padding-bottom: 10px;
          }

          #flotLine5 {
               height: 105px;
          }

          #flotBarChart {
               height: 150px;
          }

          #cellPaiChart {
               height: 160px;
          }
     </style>
</head>

<body style="background-image:url('assets/img/background/background.png');">
     <div id="right-panel" class="right-panel">
          <!-- Header-->
          <header id="header" class="header">

               <div class="top-left">
                    <div class="navbar-header">
                         <a class="navbar-brand" href="./"><img src="assets/img/logo.png" alt="Logo"></a>
                    </div>
               </div>

               <div style="text-align: right;">
                    <button type="button" onclick="location.href='funcion.html'" style="display: inline;"
                         class="btn btn-outline-primary mt-2 fontwo">Como
                         funciona</button>
                    <button type="button" style="display: inline;" onclick="location.href='login.html'"
                         class="btn btn-outline-primary mt-2 fontwo">Iniciar
                         Sesion</button>
                    <button type="button" style="display: inline;"
                         class="btn btn-outline-primary mt-2 fontwo">Registrarse</button>
               </div>
          </header>

     </div>

     <h1 class="fontone mb-3" style="font-size: 5rem;margin-left: 3rem;">Proyectos</h1>
     <div class="row justify-content-center">

     <form action="" method="POST">
<textarea style="border-color: #0099d4; width: 80rem; height:10rem"   name="comentario" id="" cols="30" rows="10"></textarea>
<br>
<input type="submit" class="botonenviar" name="enviar" value="Postear">
</form>

<?php
     if (isset($_POST['enviar'])) {
          $comentario= utf8_decode(mysqli_real_escape_string($conn,$_POST['comentario']));
          $insertar = mysqli_query($conn, "Insert into post(idpost, comentario) values ('".$comentario."')");
          echo "Se envio correctamente.";
     }
?>

<br>

          <div class="container-fluid" style="margin-left: 3rem;margin-right: 3rem; margin-top: 4rem;">
               
               <?php
                   $consulta=mysqli_query($conn, "SELECT * FROM post");
                    while ($row = mysqli_fetch_assoc($consulta)) {
                         echo "
                         <div class='container-fluid' style='background-color: rgba(40,117,224,0.3); border-radius:0.4rem; height:8rem;'>
                         <p style=' padding: 20px; color:black'>".$row['comentario']."</p>
                         <input  style='' type='submit' class='boton' value='Me interesa'>
                         </div>
                         <br>
                         " ;
                    }
               ?>
</div>

<br>

</body>

</html>