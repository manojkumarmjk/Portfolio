<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "manojkumarmjk111@gmail.com";
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $headers = "From: " . $_POST["name"] . "<" . $_POST["email"] . ">";

    $email_subject = "New Message from Contact Form: ". $subject;
    $email_template = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Contact Form Submission</title>
        </head>
        <body>
            <div style="background-color: #f8f9fa; padding: 20px;">
                <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    <h2>Contact Form Submission</h2>
                    <p><strong>Name:</strong> '.$name.'</p>
                    <p><strong>Email:</strong> '.$email.'</p>
                    <p><strong>Subject:</strong> '.$subject.'</p>
                    <p><strong>Message:</strong></p>
                    <p>'.$message.'</p>
                </div>
            </div>
        </body>
        </html>
        ';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $name . "<" . $email . ">";
    
    if (mail($to, $email_subject, $email_template, $headers)) {
        $response_message = '<div style="background-color: #d4edda; color: #155724; padding: 10px; margin: 20px 0;">
        Hi '. $_POST["name"]. ', <br/>
        <h3>Thank you for contacting us!</h3>
        <p>We have received your message and will get back to you shortly.</p>
    </div>';
        $response_status = "success";
    } else {
        $response_message = '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin: 20px 0;">
        Hi '. $_POST["name"]. ', <br/>
        <h2>Oops! Something went wrong.</h2>
        <p>Sorry, we were unable to send your message. Please try again later.</p>
    </div>';
        $response_status = "error";
    }

    echo $response_message;

    json_encode(array("message" => $response_message, "status" => $response_status));
} else {
    echo json_encode(array("message" => "Method not allowed", "status" => "error"));
}
?>
