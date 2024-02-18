<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    $to = 'manojkumarmjk111@gmail.com'; // Your email
    $email_subject = 'New message from ' . $name;
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($to, $email_subject, $email_content, $email_headers)) {
        $response_message = "Thank you for contacting. Manoj will respond to you soon by email.";
    } else {
        $response_message = "Message could not be sent. Please try again later.";
    }

    $response = json_encode(array('message' => $response_message));
    header('Content-Type: application/json');
    echo $response;
}
?>
