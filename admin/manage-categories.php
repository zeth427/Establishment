<?php
include 'partials/header.php';
// fetch categories from database
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);

?>

    <section class="dashboard">

        <?php if(isset($_SESSION['add-category-success'])) ://shows if add category was successful ?>
            <div class="alert_message success container">
                <p>                           
                    <?= $_SESSION['add-category-success'];
                    unset($_SESSION['add-category-success']);
                    ?>
                </p>       
            </div>
        
        <?php elseif(isset($_SESSION['add-category'])) ://shows if add category was not successful ?>
            <div class="alert_message error container">
                <p>                           
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                    ?>
                </p>       
            </div>
        <?php elseif(isset($_SESSION['edit-category'])) ://shows if edit category was not successful ?>
            <div class="alert_message error container">
                <p>                           
                    <?= $_SESSION['edit-category'];
                    unset($_SESSION['edit-category']);
                    ?>
                </p>       
            </div>
        <?php elseif(isset($_SESSION['edit-category-success'])) ://shows if edit category was successful ?>
            <div class="alert_message success container">
                <p>                           
                    <?= $_SESSION['edit-category-success'];
                    unset($_SESSION['edit-category-success']);
                    ?>
                </p>       
            </div>
        <?php elseif(isset($_SESSION['delete-category-success'])) ://shows if delete category was not successful ?>
            <div class="alert_message success container">
                <p>                           
                    <?= $_SESSION['delete-category-success'];
                    unset($_SESSION['delete-category-success']);
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
                            <a href="manage-users.php"><i class='bx bxs-user-detail' ></i>
                                <h5>Administrar usuario</h5>
                            </a>
                        </li>
                        <li>
                            <a href="add-category.php"><i class='bx bxs-edit'></i>
                                <h5>Añadir categoría</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-categories.php" class="active"><i class='bx bx-list-ul' ></i>
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
                <h2>Administrar categorías</h2>
                <?php if(mysqli_num_rows($categories)>0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                            <tr>
                                <td><?= $category['title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Editar</a> </td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">Eliminar</a> </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert_message error"><?= "No se encontraron categorías" ?></div>
                <?php endif ?>

            </main>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>