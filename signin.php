<?php
require 'config/constants.php';
$username_email= $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog Escolar</title>

        <link rel="stylesheet" href="css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital@1&display=swap" rel="stylesheet">

    </head>
    <body>

        <section class="form_section">
            <div class="container form_section-container">
                <h2>Iniciar Sesion</h2>
                <?php if(isset($_SESSION['signup-success'])):?>
                    <div class="alert_message success">
                        <p>
                            <?= $_SESSION['signup-success'];
                            unset($_SESSION['signup-success']);
                            ?>
                        </p>
                    </div>
                <?php elseif(isset($_SESSION['signin'])) : ?>
                    <div class="alert_message error">
                        <p>
                            <?= $_SESSION['signin'];
                            unset($_SESSION['signin']);
                            ?>
                        </p>
                    </div>
                <?php endif?>
                <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                    <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Usuario o contraseña">
                    <input type="password" name="password" value="<?= $password ?>" placeholder="Contraseña">
                    <button type="submit" name="submit" class="btn">Iniciar Sesion</button>

                <!--    <small>Don't have account? <a href="./signup.php">Sign Up</a></small> -->
                </form>
            </div>
        </section>

        
    </body>
</html>