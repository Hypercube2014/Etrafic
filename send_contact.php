<?php
use PHPMailer\PHPMailer\PHPMailer;
require __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = 'Adresse e-mail invalide.';
        } else {
            $mail = new PHPMailer();
            $mail->setFrom($email, $name);
            $mail->addAddress('ayanleh.abdisalam@hypercube.dj');
            $mail->Subject = 'Nouveau message de contact';
            $mail->Body = "Nom: $name\nEmail: $email\n\n$message";
            if ($mail->send()) {
                $response = 'Votre message a été envoyé.';
            } else {
                $response = "Une erreur s'est produite lors de l'envoi.";
            }
        }
    } else {
        $response = 'Tous les champs sont requis.';
    }
} else {
    $response = 'Méthode non autorisée.';
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Contact - Réponse</title>
</head>
<body>
<p><?php echo htmlspecialchars($response, ENT_QUOTES, 'UTF-8'); ?></p>
<p><a href="contact.html">Retour au formulaire</a></p>
</body>
</html>
