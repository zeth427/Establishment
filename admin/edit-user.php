<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
}else{
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>

    <section class="form_section">
        <div class="container form_section-container">
            <h2>Editar Usuario</h2>
            
            <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
                <input type="hidden" value="<?= $user['id'] ?>" name="id">
                <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="Nombre">
                <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Apellido">
                
                <select name="userrole">
                    <option value="0">Profesor</option>
                    <option value="1">Administrador</option>
                </select>
                
                <button type="submit" name="submit" class="btn">Actualizar usuario</button>
            </form>
        </div>
    </section>


<?php
include '..partials/footer.php';
?>