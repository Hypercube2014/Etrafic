<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $to = 'ayanleh.abdisalam@hypercube.dj';
        $subject = 'Nouveau message de contact';
        $body = "Nom: $name\nEmail: $email\n\n$message";
        $headers = "From: $email\r\nReply-To: $email";
        if (mail($to, $subject, $body, $headers)) {
            $response = 'Votre message a été envoyé.';
        } else {
            $response = "Une erreur s'est produite lors de l'envoi.";
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
