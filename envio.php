<?php
function check_email_address($email) 
{
	// Primero, checamos que solo haya un símbolo @, y que los largos sean correctos
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
	{
		// correo inválido por número incorrecto de caracteres en una parte, o número incorrecto de símbolos @
    return false;
  }
  // se divide en partes para hacerlo más sencillo
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) 
	{
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
		{
      return false;
    }
  } 
  // se revisa si el dominio es una IP. Si no, debe ser un nombre de dominio válido
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
	{ 
     $domain_array = explode(".", $email_array[1]);
     if (sizeof($domain_array) < 2) 
		 {
        return false; // No son suficientes partes o secciones para se un dominio
     }
     for ($i = 0; $i < sizeof($domain_array); $i++) 
		 {
        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
           return false;
        }
     }
  }
  return true;
}
$ban = check_email_address($_POST['mail'])."<br>";

      //echo $_POST['nombre']."<BR>"; echo $_POST['mail'];
      if($_POST['nombre']!='Nombre:' && $_POST['mail']!='Email:')
	  {  
	      if($ban==1)
		  {
		  $cabecera = "MIME-Version: 1.0\r\n";
		  $cabecera .= "Content-type: text/html; charset=iso-8859-1\r\n";
		  $cabecera .= "From: ".$_POST['mail']."\n";
		  $cabecera .= "X-Mailer: PHP/". phpversion();
		  $asunto = "Contacto Pagina Purificadores";
		  $mensaje = "<div>Nombre: ".$_POST['nombre']."</div>
					  <div>E.mail ".$_POST['mail']."</div>";
		  //$mailrecibe = "milenaamaya@gmail.com";
		  $mailrecibe = "nancyacos70@hotmail.com";
		  mail($mailrecibe, $asunto, $mensaje, $cabecera);
		  //Mensaje Gracias
		  $cabecera1 = "MIME-Version: 1.0\r\n";
		  $cabecera1 .= "Content-type: text/html; charset=iso-8859-1\r\n";
		  $cabecera1 .= "From: BlueStoneWaterColombia\n";
		  $cabecera1 .= "X-Mailer: PHP/" . phpversion();
		  $asunto = "Contacto Pagina Purificadores";
		  $mensaje1 = "<div>Pronto estaremos en contacto ofreciendole nuestro producto, por favor visite nuetra pagina 
					   <a href='http://www.bluestonewatercolombia.com'>bluestonewatercolombia.com</a><br>
					   LLama al celular 3013006602</div>";
		  mail($_POST['mail'],'Gracias por contactarnos Blue Stone Water Colombia', $mensaje1, $cabecera1);
	?>
	<form name="frm" action="index.html" method="post">
	<input type="hidden" name="dos">
	</form>
	<script>document.frm.submit()</script>
<?php }else{
echo "MAL MUY MAL";

}} else { ?>
<form name="frm" action="index.html" method="post">
	<input type="hidden" name="dos">
	</form>
<script>document.frm.submit()</script>
<? exit; } ?>