<?php
include 'partials/header.php';
//fetch users from database but not current user
$current_admin_id =$_SESSION['user-id'];
$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


    <section class="dashboard">
        <?php if(isset($_SESSION['add-user-success'])) : //shows if add user was successful ?>
            <div class="alert_message success container">
                <p>                           
                    <?= $_SESSION['add-user-success'];
                    unset($_SESSION['add-user-success']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['edit-user-success'])) : //shows if edit user was successful ?>
            <div class="alert_message success container">
                <p>                           
                    <?= $_SESSION['edit-user-success'];
                    unset($_SESSION['edit-user-success']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['edit-user'])) : //shows if edit user was not successful ?>
            <div class="alert_message error container">
                <p>                           
                    <?= $_SESSION['edit-user'];
                    unset($_SESSION['edit-user']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['delete-user'])) : //shows if delete user was not successful ?>
            <div class="alert_message error container">
                <p>                           
                    <?= $_SESSION['delete-user'];
                    unset($_SESSION['delete-user']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['delete-user-success'])) : //shows if edit delete was successful ?>
            <div class="alert_message success container">
                <p>                           
                    <?= $_SESSION['delete-user-success'];
                    unset($_SESSION['delete-user-success']);
                    ?>
                </p>
            </div>
        <?php endif ?>

        <div class="container dashboard_container">
            <button id="show_sidebar-btn" class="sidebar_toggle"><i class='bx bxs-chevron-right'></i></button>
            <button id="hide_sidebar-btn" class="sidebar_toggle"><i class='bx bxs-chevron-left'></i></button>
            
            <aside>
                <ul>
                    <li>
                        <a href="add-post.php"><i class='bx bx-notepad'></i>
                            <h5>Añadir publicación</h5>
                        </a>
                    </li>
                    <li>
                        <a href="index.php"><i class='bx bx-edit-alt'></i>
                            <h5>Administrar publicaciones</h5>
                        </a>
                    </li>

                    <?php if(isset($_SESSION['user_is_admin'])): ?>

                        <li>
                            <a href="add-user.php"><i class='bx bx-user-plus' ></i>
                                <h5>Agregar usuario</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-users.php" class="active"><i class='bx bxs-user-detail' ></i>
                                <h5>Administrar usuario</h5>
                            </a>
                        </li>
                        <li>
                            <a href="add-category.php"><i class='bx bxs-edit'></i>
                                <h5>añadir categoría</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-categories.php"><i class='bx bx-list-ul' ></i>
                                <h5>Administrar categorías</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-records.php"><i class='bx bxs-user-detail' ></i>
                                <h5>Solicitudes de Constancia</h5>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Administrar usuarios</h2>
                <?php if(mysqli_num_rows($users)>0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                            <th>Administrador</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while($user = mysqli_fetch_assoc($users)) : ?>

                            <tr>
                                <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Editar</a> </td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Eliminar</a> </td>
                                <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                            </tr>
                        
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else :?>
                    <div class="alert_message error"><?= "No se encontraron usuarios" ?> </div>
                <?php endif ?>

            </main>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>