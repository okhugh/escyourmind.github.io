<?php
/**
 * ESCAPE YOUR MIND - Login Handler & Email Notification
 * * This script processes the login form submission and can send email alerts
 * to the administrator when a login attempt occurs.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize Inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // In a real app, use password_verify()

    // 2. Logic Placeholder (Replace with your database verification)
    $login_success = true; 

    if ($login_success) {
        // 3. Email Functionality (The "PHP Emails" part)
        $to = "admin@onyxamber.com"; // Your email
        $subject = "Collective Access: Login Alert";
        $message = "A member has signed into the collective.\n\n";
        $message .= "User Email: " . $email . "\n";
        $message .= "Timestamp: " . date("Y-m-d H:i:s") . "\n";
        $message .= "IP Address: " . $_SERVER['REMOTE_ADDR'];
        
        $headers = "From: no-reply@onyxamber.com" . "\r\n" .
                   "Reply-To: no-reply@onyxamber.com" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Send email notification
        @mail($to, $subject, $message, $headers);

        // 4. Redirect to Dashboard or Home
        header("Location: index.html?status=success");
        exit();
    } else {
        // Redirect back on failure
        header("Location: index.html?status=error");
        exit();
    }
} else {
    // Block direct access
    header("Location: index.html");
    exit();
}
?>
