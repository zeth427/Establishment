<?php
include 'partials/header.php';
// get back form data if there was an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Agregar Usuario</h2>

            <?php if(isset($_SESSION['add-user'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['add-user'];
                        unset($_SESSION['add-user']);
                        ?>
                    </p>
                </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>admin/add-user-logic.php " enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="Nombre">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Apellido">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Nombre de Usuario">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Correo electronico">
                <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Crear contraseña">
                <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirmar contraseña">
                <select name="userrole">
                    <option value="0">No administrador</option>
                    <option value="1">Administrador</option>
                </select>
                <div class="form_control" >
                    <label form="avatar">Avatar de usuario</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Agregar Usuario</button>
            </form>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>