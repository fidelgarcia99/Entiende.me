<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
    public function insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$nickname,$clave,$imagen,$permiso)
	{
		$sql="INSERT INTO usuario (idusuario,nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,nickname,clave,imagen,
        condicion)
		VALUES (NULL,'$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$nickname','$clave','$imagen',
        '1')";
		//return ejecutarConsulta($sql);

		$idusuarionew=ejecutarConsulta_retornarID($sql);
		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permiso))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idpermiso,idusuario) VALUES ('$permiso[$num_elementos]', '$idusuarionew')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	//Implementamos un método para editar registros
    public function editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$nickname,$clave,$imagen,$permiso)
	{
		$sql="UPDATE usuario SET nombre='$nombre', tipo_documento='$tipo_documento', num_documento='$num_documento', direccion='$direccion', telefono='$telefono', 
        email='$email', cargo='$cargo', nickname='$nickname', clave='$clave', imagen='$imagen' 
        WHERE idusuario='$idusuario'";
		ejecutarConsulta($sql);

		$sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permiso))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idpermiso,idusuario) VALUES ('$permiso[$num_elementos]', '$idusuario')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}


	//Implementamos un método para desactivar 
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}
	

	//Implementamos un método para activar categorías
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
    public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}
	
	public function listarmarcados($idusuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}
	
	public function verificar($nickname,$clave)
	{
		$sql= "SELECT idusuario,nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,nickname,clave,imagen
		FROM usuario WHERE nickname='$nickname' AND clave='$clave' AND condicion='1'";
		return ejecutarConsulta($sql);
	}


	public function select()
	{
		$sql="SELECT * FROM usuario where condicion = 1 ";
		return ejecutarConsulta($sql);
	}
}

?>