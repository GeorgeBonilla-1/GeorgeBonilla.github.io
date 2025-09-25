<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload Composer dependencies
require '../vendor/autoload.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
  $email = isset($_POST['email']) ? trim($_POST['email']) : '';
  $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

  // Validate inputs
  if (empty($name)) {
    $errors[] = 'Name is empty';
  }
  if (empty($email)) {
    $errors[] = 'Email is empty';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email is invalid';
  }
  if (empty($message)) {
    $errors[] = 'Message is empty';
  }

  if (empty($errors)) {
    $mail = new PHPMailer(true);

    try {
      // Server settings
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'georgebonillla@gmail.com';// Here put your own email
      $mail->Password = 'placeholder';// Create app password through the security tab in gmail
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      // Recipients
      $mail->setFrom('your_gmail@gmail.com', 'George Bonilla');// put your own info in these lines
      $mail->addAddress('georgebonillla@gmail.com');
      $mail ->addReplyTo($email, $name);
      // Recipient

      // Content
      $mail->isHTML(false);
      $mail->Subject = 'New Contact Form Message';
      $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

      $mail->send();
      echo "Message sent successfully!";
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  } else {
    echo "<div style='color:red;'>Form contains the following errors:<br>";
    foreach ($errors as $error) {
      echo "- $error<br>";
    }
    echo "</div>";
  }
} else {
  http_response_code(403);
  echo "You are not allowed to access this page directly.";
}
