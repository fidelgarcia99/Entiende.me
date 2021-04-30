<?php
session_start();
include_once("../../clases/class_conexion.php");
include_once("../../clases/class_usuario.php");
$conexion = new Conexion();

switch ($_GET['accion']) {
    case '1':
        $usuario = $_POST['usuario'];
        $pass = sha1($_POST['pass']);

        $resultado = Usuarios::verificarUsuario($conexion, $usuario, $pass);

        if ($resultado){
            $respuesta = array(
                "idUsuario"=>$resultado['data'][0]['idUsuario'],
                "resultado"=>"OK",
                "token"=>sha1(uniqid(rand(),true))
            );
            $_SESSION["token"] = $respuesta['token'];
            setcookie("token",$respuesta['token'],time()+(60*60*24),"/");
            setcookie("nombre",$resultado['data'][0]['nombre'],time()+(60*60*24),"/");
            setcookie("apellido",$resultado['data'][0]['apellido'],time()+(60*60*24),"/");
            setcookie("id",$resultado['data'][0]['idUsuario'],time()+(60*60*24),"/");
            echo json_encode($respuesta);  
        }else{
            setcookie("token"," ",time()-1,"/");
            setcookie("nombre"," ",time()-1,"/");
            setcookie("apellido"," ",time()-1,"/");
            setcookie("id"," ",time()-1,"/");
            echo '{"mensaje":"Usuario/Pass inconrecto","resultado":"KO"}';  
        }    
        break;

    case '2':
        $pass = "zxcvbnm";
        echo sha1($pass);
        break;
}

?>