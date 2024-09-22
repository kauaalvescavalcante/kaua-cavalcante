<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mensagem = htmlspecialchars(trim($_POST['mensagem']));

    // Validação básica para garantir que os campos não estão vazios
    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        // Configurações do email
        $para = "contato@minhaempresa.com";  // Substitua pelo seu endereço de email
        $assunto = "Novo contato de " . $nome;

        // Cabeçalhos do email
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Corpo do email
        $corpo = "
        <html>
        <body>
            <h2>Você recebeu uma nova mensagem de contato</h2>
            <p><strong>Nome:</strong> {$nome}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Mensagem:</strong></p>
            <p>{$mensagem}</p>
        </body>
        </html>";

        // Envia o email
        if (mail($para, $assunto, $corpo, $headers)) {
            echo "<script>alert('Sua mensagem foi enviada com sucesso!');</script>";
        } else {
            echo "<script>alert('Desculpe, ocorreu um erro ao enviar sua mensagem.');</script>";
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    }
}
?>
