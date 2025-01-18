<?php
include("header.php");
include("config.php");

// Check if email is provided
if (!isset($_GET['email']) || empty($_GET['email'])) {
    header("Location: Forgotpassword.php.php");
    exit();
}

$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
?>

    <div class="wrapper col4">
        <div id="container">
            <h1>Vérifier le code de réinitialisation</h1>

            <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                $error_messages = [
                    'invalid_code' => 'Code invalide ou expiré.',
                    'code_attempts' => 'Trop de tentatives. Veuillez recommencer.'
                ];
                echo '<div style="color: red; text-align: center; margin-bottom: 15px;">' .
                    (isset($error_messages[$error]) ? $error_messages[$error] : 'Une erreur est survenue') .
                    '</div>';
            }
            ?>

            <form action="reset_password.php" method="POST">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <table width="100%">
                    <tr>
                        <td>Code de réinitialisation :</td>
                        <td>
                            <input
                                    type="text"
                                    name="reset_token"
                                    required
                                    placeholder="Entrez le code à 6 chiffres"
                                    maxlength="6"
                                    pattern="\d{6}"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Vérifier le code" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php
include("footer.php");
?>