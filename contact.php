<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST["NomorHP"]), FILTER_SANITIZE_STRING);
    $datetime = filter_var(trim($_POST["datetime-local"]), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

   
    if (empty($name) || empty($phone) || empty($datetime) || empty($email) || empty($message)) {
        http_response_code(400);
        echo "Please fill in all fields.";
        exit;
    }

    
    $to = "https://formspree.io/f/xgegqaeq";
    $subject = "New Contact Form Submission";
    $body = "Name: $name\n";
    $body .= "Phone: $phone\n";
    $body .= "Date and Time: $datetime\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";
    
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    echo "There was a problem with your submission, please try again.";
}
?>
