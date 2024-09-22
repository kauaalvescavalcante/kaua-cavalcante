<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carregar o autoloader do Composer
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mensagem = htmlspecialchars(trim($_POST['mensagem']));

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.exemplo.com';  // Substitua pelo servidor SMTP do seu provedor
            $mail->SMTPAuth = true;
            $mail->Username = 'seu-email@exemplo.com';
            $mail->Password = 'sua-senha';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinatários
            $mail->setFrom($email, $nome);
            $mail->addAddress('contato@minhaempresa.com', 'Minha Empresa');

            // Conteúdo do email
            $mail->isHTML(true);
            $mail->Subject = "Novo contato de " . $nome;
            $mail->Body    = "<p>Nome: {$nome}</p><p>Email: {$email}</p><p>Mensagem: {$mensagem}</p>";

            // Envia o email
            $mail->send();
            echo 'Mensagem enviada com sucesso!';
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    }
}
?>
