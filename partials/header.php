<?php
require 'config/database.php';

// fetch current user from database
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establishment</title>

    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital@1&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>
    <nav>
        <div class="container nav_container">
            <a href="<?= ROOT_URL ?>index.php">
                <img href="<?= ROOT_URL ?>index.php" class="icono" src="Images/ifts.png" >
            
            </a>
            <ul class="nav_items">
                <li><a href="<?= ROOT_URL ?>index.php">Inicio</a></li>
                <li><a href="<?= ROOT_URL ?>advertisements.php">Anuncios</a></li>
                <li><a href="<?= ROOT_URL ?>subjects.php">Carreras</a></li>
                <li><a href="<?= ROOT_URL ?>inscription.php">Inscripciones</a></li>
                <?php if(isset($_SESSION['user-id'])): ?>
                                    
                <?php else: ?>
                    <li><a href="<?= ROOT_URL ?>records.php">Constancias</a></li>
                <?php endif ?>

                
                
                
                <?php if(isset($_SESSION['user-id'])): ?>
                    <li class="nav_profile">
                        <div class="avatar">
                            <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?> ">
                        </div>
                        <ul>
                            <li><a href="<?= ROOT_URL ?>admin/index.php">Panel de control</a></li>
                        
                            <li><a href="<?= ROOT_URL ?>logout.php">Cerrar sesion</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="<?= ROOT_URL ?>signin.php">Iniciar sesion</a></li> 
                <?php endif ?>
            </ul>

            <button  id="open_nav-btn"><i class="bx bx-menu-alt-left"></i></button>
            <button  id="close_nav-btn"><i class="bx bx-x"></i></button>
        </div>
    </nav>
<!--============================= End of nav===============================================-->

