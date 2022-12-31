<?php
	
	if( empty( $_POST['token'] ) ){
		echo '<span class="notice">Error!</span>';
		exit;
	}
	if( $_POST['token'] != 'FsWga4&@f6aw' ){
		echo '<span class="notice">Error!</span>';
		exit;
	}
	
	$name = $_POST['name'];
	$from = $_POST['email'];
	$phone = $_POST['phone'];
	$subject = stripslashes( nl2br( $_POST['subject'] ) );
	$message = stripslashes( nl2br( $_POST['message'] ) );
	
	$headers ="From: Form Contact <$from>\n";
	$headers.="MIME-Version: 1.0\n";
	$headers.="Content-type: text/html; charset=iso 8859-1";
	
	ob_start();
	?>
		Hola soy MindHowl!<br /><br />
		<?php echo ucfirst( $name ); ?>  te ha enviado un mensaje a traves del sitio web!
		<br /><br />
		
		Nombre: <?php echo ucfirst( $name ); ?><br />
		Email: <?php echo $from; ?><br />
		Telefono: <?php echo $phone; ?><br />
		Tema: <?php echo $subject; ?><br />
		Mensaje: <br /><br />
		<?php echo $message; ?>
		<br />
		<br />
		============================================================
	<?php
	$body = ob_get_contents();
	ob_end_clean();
	
	$to = 'support@fruitkha.com';

	$s = mail($to,$subject,$body,$headers,"-t -i -f $from");

	if( $s == 1 ){
		echo '<div class="success"><i class="fas fa-check-circle"></i><h3>Gracias!</h3>Tu mensaje ha sido enviado!.</div>';
	}else{
		echo '<div>Tu mensaje no ha podido ser enviado!</div>';
	}

	
?>
