<?php
// SMTP contact-form endpoint for a local PHP/Apache server.
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

$configFile = __DIR__ . '/smtp-config.php';
if (!file_exists($configFile)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'SMTP is not configured. Create smtp-config.php from smtp-config.example.php.']);
    exit;
}
require $configFile;

$autoload = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoload)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'PHPMailer is missing. Run composer install in the website folder.']);
    exit;
}
require $autoload;

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$service = trim($_POST['service'] ?? 'Not specified');
$message = trim($_POST['message'] ?? '');

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Please enter your name, a valid email address and a message.']);
    exit;
}
if (strlen($name) > 150 || strlen($email) > 254 || strlen($phone) > 40 || strlen($service) > 120 || strlen($message) > 10000) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'One or more fields are too long.']);
    exit;
}

$mail = new PHPMailer\PHPMailer\PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_APP_PASSWORD;
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = SMTP_PORT;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom(SMTP_USERNAME, 'Nexora Website');
    $mail->addAddress(RECIPIENT_EMAIL);
    $mail->addReplyTo($email, $name);
    $mail->Subject = 'New website enquiry: ' . $service;
    $mail->isHTML(true);
    $safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $safePhone = htmlspecialchars($phone ?: 'Not provided', ENT_QUOTES, 'UTF-8');
    $safeService = htmlspecialchars($service, ENT_QUOTES, 'UTF-8');
    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
    $mail->Body = "<h2>New website enquiry</h2><p><b>Name:</b> {$safeName}</p><p><b>Email:</b> {$safeEmail}</p><p><b>Phone:</b> {$safePhone}</p><p><b>Service:</b> {$safeService}</p><p><b>Message:</b><br>{$safeMessage}</p>";
    $mail->AltBody = "New website enquiry\nName: $name\nEmail: $email\nPhone: $phone\nService: $service\nMessage: $message";
    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Message sent.']);
} catch (Throwable $e) {
    error_log('SMTP contact form error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Email could not be sent. Check the SMTP settings and PHP error log.']);
}
