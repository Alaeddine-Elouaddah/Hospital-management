
    <style>
        body {
            background-image:url("assets/images/bg-3.png");
            background-size: cover; /* L'image couvre tout l'écran */
            background-position: center; /* Centre l'image */
        }
        .wrapper.col2 #breadcrumb {
            background-color: #f8f9fa;
            padding: 15px 0;
            margin-bottom: 20px;
        }

        .wrapper.col2 #breadcrumb ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .wrapper.col2 #breadcrumb ul li.first {
            color: #333;
            font-weight: bold;
        }

        .wrapper.col4 #container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .wrapper.col4 #container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .wrapper.col4 #container table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .wrapper.col4 #container table td {
            padding: 5px;
        }

        .wrapper.col4 #container table input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .wrapper.col4 #container table input[type="email"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.2);
        }

        .wrapper.col4 #container table input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .wrapper.col4 #container table input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .wrapper.col4 #container {
                padding: 20px;
                margin: 0 15px;
            }
        }
    </style>


<div style="height: 100px"></div>
    <div class="wrapper col4">
        <div id="container">

            <h1 >Réinitialisation de mot de passe</h1>

            <?php
            if(isset($_GET['error'])) {
                echo '<div style="color: red; text-align: center; margin-bottom: 15px;">Erreur : Email invalide ou non trouvé</div>';
            }
            if(isset($_GET['success'])) {
                echo '<div style="color: green; text-align: center; margin-bottom: 15px;">Code de réinitialisation envoyé</div>';
            }
            ?>

            <form action="send_reset_code.php" method="POST">
                <table>
                    <tr>
                        <td>Email :</td>
                        <td>
                            <input type="email" name="email" required placeholder="Entrez votre email" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Envoyer le code de réinitialisation" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

