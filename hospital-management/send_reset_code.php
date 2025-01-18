<?php
// Database connection
include("config.php");

// Function to generate a random 6-digit code
function generateResetCode() {
    return sprintf("%06d", mt_rand(1, 999999));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: Forgotpassword.php?error=invalid_email");
        exit();
    }

    try {
        // Check if email exists in database
        $stmt = $conn->prepare("SELECT adminid FROM admin WHERE email = ?");
        $stmt->bind_param("sss", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email exists - generate and send reset code
            $reset_code = generateResetCode();
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Update database with reset code and expiry
            $update_stmt = $conn->prepare("UPDATE admin SET reset_token = ?, reset_token_expiry= ? WHERE email = ?");
            $update_stmt->bind_param("sss", $reset_code, $expiry, $email);
            $update_stmt->execute();

            // Prepare email content
            $to = $email;
            $subject = "Réinitialisation de mot de passe";
            $message = "Votre code de réinitialisation est : " . $reset_code . "\n";
            $message .= "Ce code expirera dans 1 heure.\n";
            $message .= "Si vous n'avez pas demandé de réinitialisation, ignorez ce message.";

            // Email headers
            $headers = "From: noreply@votresite.com\r\n";
            $headers .= "Reply-To: noreply@votresite.com\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            // Send email
            $mail_sent = mail($to, $subject, $message, $headers);

            if ($mail_sent) {
                // Redirect to verification page
                header("Location: verify_reset_code.php?email=" . urlencode($email));
                exit();
            } else {
                // Email sending failed
                header("Location: Forgotpassword.php?error=email_failed");
                exit();
            }
        } else {
            // Email not found
            header("Location: Forgotpassword.php?error=email_not_found");
            exit();
        }
    } catch (Exception $e) {
        // Database error
        header("Location: Forgotpassword.php?error=database_error");
        exit();
    } finally {
        // Close statements
        if (isset($stmt)) $stmt->close();
        if (isset($update_stmt)) $update_stmt->close();
    }
}
?>