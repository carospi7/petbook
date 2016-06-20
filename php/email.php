<?php class email {

  private $id;
  private $destinatario;
  private $asunto;
  private $contenido;
  private $password;
  private $fechaCreacion;

  public function __construct ($destinatario, $asunto, $contenido)
  {
    $this->destinatario = $destinatario;
    $this->asunto = $asunto;

    if ($contenido === 'emailPassword')
    {
      include 'html/email_recuperar_password.php';

      $this->password = $this-generarPasswordAleatoria();
      $password = $this->getPassword();

      $contenidoEmail = str_replace("{{enlaceWeb}}", 'http://localhost/php/GitHub/seteoPass.php?nuevoPassword='.$password, $contenidoEmail);
      $contenidoEmail = str_replace("{{nombre}}",  $destinatario->getNombre(), $contenidoEmail);
      
      $this->contenido = $contenidoEmail;
    }
  }

  public function getDestinatario()
  {
    return $this->destinatario;
  }

  public function getAsunto()
  {
    return $this->asunto;
  }

  public function getContenido()
  {
    return $this->contenido;
  }

  public function getPassword()
  {
    return $this->password;
  }  

  public function generarPasswordAleatoria()
  {
    $cadena = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $longitudCadena=strlen($cadena)-1;
    $contraseña = '';

    for ($i=0 ; $i < 15 ; $i++)
    {
        $caracter = rand (0,$longitudCadena);
        $contraseña = $contraseña.substr($cadena,$caracter,1);
    }
    
    $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
    
    return $contraseña;
  }

  public function enviarEmail()
  {
    $destinatario = $this->getDestinatario();
    $asunto = $this->getAsunto();
    $contenido = $this->getContenido();

    $headers = "From: Petbook <'password@petbook.com.ar'>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $registro = $repositorio->getRepositorioEmail()->guardarRegistroEmail($destinatario, $asunto, $contenido);

    mail ($destinatario, $asunto, $contenido, $headers);
  }

} ?>