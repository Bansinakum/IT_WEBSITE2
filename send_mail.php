<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request");
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$message) {
    exit("Please fill all fields correctly.");
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'bansinakum2@gmail.com';
    $mail->Password = 'ovcz mpjm nhgo kjcu';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('bansinakum2@gmail.com', 'IT Website');
    $mail->addAddress('bansinakum2@gmail.com');

    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'New Website Contact Message';

    $mail->Body = "
        <h2>New Contact Message</h2>
        <p><b>Name:</b> " . htmlspecialchars($name) . "</p>
        <p><b>Email:</b> " . htmlspecialchars($email) . "</p>
        <p><b>Message:</b><br>" .
        nl2br(htmlspecialchars($message)) . "</p>
    ";

    $mail->send();

    echo "Message sent successfully!";

} catch (Exception $e) {
    error_log($mail->ErrorInfo);
    http_response_code(500);
    echo "Message could not be sent. Please try again.";
}
?>