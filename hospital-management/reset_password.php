<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $reset_code = $_POST['reset_token'];
    $new_password = $_POST['new_password'];

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: verify_reset_code.php?email=" . urlencode($email) . "&error=invalid_email");
        exit();
    }

    // Verify reset code
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("ss", $email, $reset_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Code is valid, update password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_stmt = $conn->prepare("UPDATE admin SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?");
        $update_stmt->bind_param("ss", $hashed_password, $email);
        $update_stmt->execute();

        // Redirect to login with success message
        header("Location: adminlogin.php?success=password_reset");
        exit();
    } else {
        // Invalid or expired code
        header("Location: verify_reset_code.php?email=" . urlencode($email) . "&error=invalid_code");
        exit();
    }
}
?>

<div class="wrapper col4">
    <div id="container">
        <h1>Réinitialiser le mot de passe</h1>

        <form method="POST">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <table width="100%">
                <tr>
                    <td>Nouveau mot de passe :</td>
                    <td>
                        <input
                                type="password"
                                name="new_password"
                                required
                                placeholder="Entrez votre nouveau mot de passe"
                        />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Réinitialiser le mot de passe">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>