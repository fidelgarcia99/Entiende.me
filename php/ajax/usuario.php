<?php 
session_start();

require_once "../../clases/Usuario.php";

$usuario = new Usuario ();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$nickname=isset($_POST["nickname"])? limpiarCadena($_POST["nickname"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";



switch ($_GET["op"]){
    case 'guardaryeditar':
        
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
			}
        }
        

        $clavehash=hash("SHA256",$clave);
        
		if (empty($idusuario)){
			$rspta=$usuario->insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$nickname,$clavehash,
			$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario registrada" : "Usuario no se pudo registrar";
		}	
		else {
			$rspta=$usuario->editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$nickname,$clavehash,
			$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario actualizada" : "Usuario no se pudo actualizar";
		}
    break;
    case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivada" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
 		echo $rspta ? "Usuario activada" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-primary" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-primary" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':
				'<button class="btn btn-primary" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->tipo_documento,
                "3"=>$reg->num_documento,
                "4"=>$reg->telefono,
                "5"=>$reg->email,
                "6"=>$reg->nickname,
                "7"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
 				"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
         }
         
         
 		$results = array(
 			"sEcho"=>1, //Informaci??n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

    break;
		 
	case 'permiso':
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);

		$valores=array();

		while ($per = $marcados->fetch_object())
		{
			array_push($valores, $per->idpermiso);
		}

		while ($reg = $rspta->fetch_object())
			{
				
				$sw=in_array($reg->idpermiso,$valores)?'checked': '';
				
				echo '<li> <input type="checkbox"'.$sw.' name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
			}
	break;
	
	
	case 'verificar':

		$logina=$_POST['logina'];
		$clavea=$_POST['clavea'];


// Hash SHA256 en el password

		$clavehash = hash("SHA256",$clavea);
		$rspta = $usuario->verificar($logina,$clavehash);
		$fetch = $rspta->fetch_object(); //esta es la linea que no anda

		if (isset($fetch)) {

		//declaramos las variables de sesion

		//$_SESSION['nombre']=$fetch->nombre;
		$_SESSION['idusuario']=$fetch->idusuario;
		$_SESSION['nombre']=$fetch->nombre;
		$_SESSION['imagen']=$fetch->imagen;	
		$_SESSION['nickname']=$fetch->nickname;

		$marcados = $usuario-> listarmarcados($fetch->idusuario);

		$valores = array();

		while ($per = $marcados->fetch_object())
		{
			array_push($valores, $per->idpermiso);
		}

		in_array(1,$valores)?$_SESSION['administrador']=1:$_SESSION['administrador']=0;
		in_array(2,$valores)?$_SESSION['otros']=1:$_SESSION['otros']=0;
		

	
	}

		echo json_encode($fetch);

	break;

	case 'salir':
		
		session_unset();
		session_destroy();
		header("Location: ../../page-login.html");
	
	
	break;

	

    
}
?>