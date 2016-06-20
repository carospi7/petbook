<?php require_once 'soporte.php'; 

	$usuarioSesion = $_SESSION['usuarioLogueado'];

	$id = $usuarioSesion->getid();

	$usuarioModificado = $repositorio->getRepositorioUsuario()->buscarUsuarioId($id);

	$errores = [];

	if ($_POST)
	{
		if ($_POST['nuevoNombre'])
		{
			$validacion = $validar->validarNombre($_POST['nuevoNombre']);

			if ($validacion === null)
			{
				$usuarioSesion->setNombre($_POST['nuevoNombre']);
				$usuarioModificado->setNombre($_POST['nuevoNombre']);	
			}
			else
			{
				$errores[] = $validacion;
			}
		}
		elseif ($_POST['nuevoApellido'])
		{
			$validacion = $validar->validarApellido($_POST['nuevoApellido']);

			if ($validacion === null)
			{
				$usuarioSesion->setApellido($_POST['nuevoApellido']);
				$usuarioModificado->setApellido($_POST['nuevoApellido']);	
			}
			else
			{
				$errores[] = $validacion;
			}
		}
		elseif ($_POST['nuevoPassword'] && $_POST['nuevoPasswordConfirm'])
		{
			$validacion = $validar->validarPassword($_POST['nuevoPassword']);

			if ($validacion === null)
			{
				$validacion = $validar->validarPasswordConfirm($_POST['nuevoPassword'], $_POST['nuevoPasswordConfirm']);

				if ($validacion === null)
				{
					$usuarioSesion->setPassword($_POST['nuevoPassword']);
					$usuarioModificado->setPassword($_POST['nuevoPassword']);	
				}
				else
				{
					$errores[] = $validacion;		
				}
			}
			else
			{
				$errores[] = $validacion;
			}	
		}
		elseif ($_POST['nuevoEmail'])
		{
			$validacion = $validar->validarEmail($_POST['nuevoEmail']);

			if ($validacion === null)
			{
				$usuarioSesion->setEmail($_POST['nuevoEmail']);
				$usuarioModificado->setEmail($_POST['nuevoEmail']);	
			}
			else
			{
				$errores[] = $validacion;
			}	
		}
		elseif ($_POST['nuevaFechaNacimiento'])
		{
			$validacion = $validar->validarFechaNacimiento($_POST['nuevaFechaNacimiento']);

			if ($validacion === null)
			{
				$usuarioSesion->setFechaNacimiento($_POST['nuevaFechaNacimiento']);
				$usuarioModificado->setFechaNacimiento($_POST['nuevaFechaNacimiento']);	
			}
			else
			{
				$errores[] = $validacion;
			}	
		}

		$repositorio->getRepositorioUsuario()->guardarUsuario($usuarioModificado);
	}

?>

<html>
	
	<head>
	
	    <title>PETBOOK | Perfil</title>
	    
	    <style type="text/css">

	    	.botonModificar
	    	{
	    		left: 400px;
	    		position: absolute;
	    	}

			.botonCancelar
	    	{
	    		left: 400px;
	    		position: absolute;
	    	}

	    	.botonAceptar
	    	{
	    		left: 475px;
	    		position: absolute;
	    	}

	    </style>

  	</head>
	<body>
	
	<h1>Este es mi perfil</h1>

	<div>
		<p>
			<?php 
				foreach ($errores as $key => $value)
				{
					echo $value;
				}
			?>
		</p>
	</div>
		
		<!-- Informacion Nombre -->	
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Nombre: <?php echo $usuarioModificado->getNombre(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>
			
			<div class="informacionUsuarioModificar">
				<label>Nombre: <input name="nuevoNombre" type='text' placeholder='Ingresa tu nombre' /></label>			
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>
		
		<br />

		<!-- Informacion Apellido -->	
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Apellido: <?php echo $usuarioModificado->getApellido(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
				<label>Apellido: <input name="nuevoApellido" type='text' placeholder='Ingresa tu apellido' /></label>	
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>
		
		<br />
			
		<!-- Informacion Password -->
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Contraseña: ********</label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
				<label>Contraseña: <input name="nuevoPassword" type='text' placeholder='Ingresa tu contraseña' /></label>
				<input name="nuevoPasswordConfirm" type='text' placeholder='Confirma tu contraseña' />
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>

		<br />
		
		<!-- Informacion Email -->			
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Email: <?php echo $usuarioModificado->getEmail(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
					<label>Email: <input name="nuevoEmail" type='text' placeholder='Ingresa tu email' /></label>
					<button class="botonCancelar">Cancelar</button>
					<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>

		<br />

		<!-- Informacion Fecha de nacimiento -->
		<form action="perfilUsuario.php" method="POST">
			<div class="informacionUsuario">
				<label>Fecha de nacimiento: <?php echo $usuarioModificado->getFechaNacimiento(); ?></label>
				<button class="botonModificar">Modificar</button>
			</div>

			<div class="informacionUsuarioModificar">
				<label>Fecha de nacimiento: <input name="nuevaFechaNacimiento" type='text' placeholder='Ingresa tu fecha de nacimiento' /></label>
				<button class="botonCancelar">Cancelar</button>
				<button type="submit" class="botonAceptar">Aceptar</button>
			</div>
		</form>

		<a href="index.php"><button>Volver Inicio</button></a>

	</body>

</html>



