<?php class repositorioEmailSQL extends repositorioEmail
{
	private $conexion;

	public function __construct($conexion)
	{
		$this->conexion = $conexion;
	}

	public function guardarRegistroEmail($destinatario, $asunto, $contenido)
	{
		$usuario = $repositorio->getRepositorioUsuario()->buscarUsuarioEmail($destinatario);
		$idUsuario = $usuario->getId();

		$registro = $this->conexion->prepare("INSERT INTO email_recuperar_password VALUES (:destinatario, :asunto, :contenido, :password_automatica, :fecha_creacion)");

		$registro->bindValue(":destinatario", $destinatario);
		$registro->bindValue(":asunto", $asunto);
		$registro->bindValue(":contenido", $contenido);
		$registro->bindValue(":password_automatica", $this->getPassword());
		$registro->bindValue(":fecha_creacion", repositorioUsuarioSQL::fechaActual());

		$registro->execute();
	}

} ?>