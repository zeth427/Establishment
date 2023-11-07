<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    // get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    // check for valid input
    if(!$firstname || !$lastname){
        $_SESSION['edit-user'] = "Entrada de formulario no válida en la página de edición.";
    }else{
        // update user
        $query = "UPDATE users SET firstname= '$firstname', lastname='$lastname', is_admin=$id_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['edit-user'] = "No se pudo actualizar el usuario.";
        }else{
        $_SESSION['edit-user-success'] = "Usuario $firstname $lastname actualizado con éxito";
        }
    }
}
header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();