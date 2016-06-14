<?php

if(isset($_POST['submit'])){

	// Inclui o arquivo class.phpmailer.php localizado no diretório principal
	require 'PHPMailer/PHPMailerAutoload.php';
	
	$name = $_POST["name"]; 
	$email = $_POST["email"];
	$message = $_POST["message"];

	$headers  = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

	/*abaixo contém os dados que serão enviados para o email
	cadastrado para receber o formulário*/

	$subject = "Formulário de Contato";
	
	$corpo = "Formulário enviado\n\n";
	$corpo .= "Nome: " . $name . "\n";
	$corpo .= "Email: " . $email . "\n";
	$corpo .= "Mensagem: " . $message . "\n";

	$email_to = 'marcio@novajornada.org.br'; 
	//não esqueça de substituir este email pelo seu.


	$status = mail($email_to, $subject, $corpo, $headers); 
	//enviando o email.


	if($status) {
		//mensagem de form enviado com sucesso.
		echo "<script>alert('Sua mensagem foi enviada!')</script>";
		echo "<script>location.href='fale-conosco.php'</script>"; // Página que será redirecionada
	}
	else {
		//mensagem de erro no envio.
		echo "<script>alert('Erro ao enviar sua mensagem.')</script>"; // Mensagem de erro se não conseguir enviar o e-mail
		echo "<script>location.href='fale-conosco.php'</script>"; // Página que será redirecionada
	}
}
?>