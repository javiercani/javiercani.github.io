<?php
	if(!empty($_POST)) {
		if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"]) && isset($_POST["phone"]) && isset($_POST["subject"])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			$phone = $_POST['phone'];
			//$human = intval($_POST['human']);
			$from = 'Astratto Webpage'; 
			$to = 'javier.caniparoli@gmail.com'; 
			$subject = 'Mensaje de la web - '.$_POST["subject"];		
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
			$cabeceras .= 'To: Astratto <astratto.ays@gmail.com>' . "\r\n";
			$cabeceras .= 'From: Astratto Webpage <contacto@astratto.com.ar>' . "\r\n";
			/* $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
			$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n"; */
			//$body ="Desde: $name\n E-Mail: $email\n Telefono: $phone\n Message:\n $message";
			//$body = "<html><head><title>ASTRATTO desde la WEB</title><style>.contenedor{width: 660px;}.titulo{					color: #FFF; background: darkred ;font-family: 'Muli', sans-serif; font-size: 18px;					padding: 4px 10px;            		border-radius:3px;			}			.cabecera{					font-family: 'Muli', sans-serif; font-weight: normal; font-size: 16px;					 background:   #858688;  color: #FFF; line-height: 30px;					padding: 0px 10px;            		border-radius:3px;			}                 		</style>	</head>	<body>		<div class='contenedor'>			<div class='titulo'>Contacto desde la web - ASTRATTO </div>			<div class='cabecera'>				<p>	Para: $to <br>			</div>			<div>				<table>					<tr>						<td><b>Nombre:</b></td>						<td>$name</td>					</tr>					<tr>						<td><b>Email:</b></td>						<td>$email</td>					</tr>                    <tr>                        <td><b>Telefono:</b></td>                        <td>$phone</td>                    </tr>					<tr>						<td valign="top"><b>Consulta:</b></td>						<td>$message</td>					</tr>				</table>				<br>			</div>		</div>	</body></html>";
			$body = "<html><head><title>ASTRATTO desde la WEB</title><style>.contenedor{width: 660px;}.titulo{color: #FFF; background: darkred ;font-family: 'Muli', sans-serif; font-size: 18px;padding: 4px 10px;border-radius:3px;}.cabecera{font-family: 'Muli', sans-serif; font-weight: normal; font-size: 16px;background:#858688;color:#FFF;line-height: 30px;padding: 0px 10px;border-radius:3px;}</style></head><body><div class='contenedor'><div class='titulo'>Contacto desde la web - ASTRATTO </div><div class='cabecera'><p>Para: $to <br></div><div><table><tr><td><b>Nombre:</b></td><td>$name</td></tr><tr><td><b>Email:</b></td><td>$email</td></tr><tr><td><b>Telefono:</b></td><td>$phone</td></tr><tr><td valign='top'><b>Consulta:</b></td><td>$message</td></tr></table><br></div></div></body></html>";

			//echo $body;
			
			// Check if name has been entered
			if (!$_POST['name']) {
				$errName = 'Por favor ingrese su nombre';
			}
			
			// Check if email has been entered and is valid
			if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$errEmail = 'Por favor ingrese un email valido';
			}
			
			//Check if message has been entered
			if (!$_POST['message']) {
				$errMessage = 'Por favor ingrese un mensaje';
			}
			//Check if simple anti-bot test is correct
			/* if ($human !== 5) {
				$errHuman = 'Your anti-spam is incorrect';
			} */
			// If there are no errors, send the email
			if (!isset($errName) && !isset($errEmail) && !isset($errMessage)) {
				//if (mail($to, $subject, $body, $from)) {
				$success = mail($to, $subject, $body, $cabeceras);
				if ($success) {
					# Establece un código de respuesta 200 (correcto).
					http_response_code(200);
					//$result='<div class="alert alert-success">Gracias! Nos pondremos en contacto con usted...</div>';
					echo "¡Gracias! Tu mensaje ha sido enviado.";
				} else {
					# Establezce un código de respuesta 500 (error interno del servidor).
					http_response_code(500);
					//$result='<div class="alert alert-danger">Hubo un error en el envio del mail, por favor intente de nuevo mas tarde. Gracias!</div>';
					echo "Oops! Algo salió mal, no pudimos enviar tu mensaje.";
				}
			} else {
				http_response_code(400);
				$mensaje= isset($errName).isset($errEmail).isset($errMessage);
				echo $mensaje;
			}
		} else {
			# No es una solicitud POST, establezce un código de respuesta 403 (prohibido).
			http_response_code(202);
			echo "No completo todos los campos.";
		}
	} else {
		# No es una solicitud POST, establezce un código de respuesta 403 (prohibido).
        http_response_code(403);
        echo "Hay un problema con el formulario de contacto. Error en frontend";
	}
	
?>