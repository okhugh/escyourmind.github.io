<?php
/**
 * ESCAPE YOUR MIND - Authentication Handler (Login & Signup)
 * * Processes form submissions and sends email notifications.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize Inputs
    $action = $_POST['action']; // 'login' or 'signup'
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'N/A';

    // 2. Logic & Email Config
    $to = "admin@onyxamber.com"; // Your admin email
    $headers = "From: no-reply@onyxamber.com" . "\r\n" .
               "Reply-To: no-reply@onyxamber.com" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if ($action === 'signup') {
        // Handle Registration logic here (e.g. Save to DB)
        
        $subject = "Collective Access: New Registration";
        $message = "A new member has joined the collective.\n\n";
        $message .= "Full Name: " . $name . "\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Timestamp: " . date("Y-m-d H:i:s") . "\n";
        
        @mail($to, $subject, $message, $headers);
        
        // Success redirect
        header("Location: index.html?auth=registered");
        exit();

    } else if ($action === 'login') {
        // Handle Login logic here (e.g. Verify from DB)
        
        $subject = "Collective Access: Login Alert";
        $message = "A member has signed into the collective.\n\n";
        $message .= "User Email: " . $email . "\n";
        $message .= "Timestamp: " . date("Y-m-d H:i:s") . "\n";
        $message .= "IP Address: " . $_SERVER['REMOTE_ADDR'];
        
        @mail($to, $subject, $message, $headers);

        header("Location: index.html?auth=success");
        exit();
    }
} else {
    header("Location: index.html");
    exit();
}
?>
