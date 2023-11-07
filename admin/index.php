<?php
include 'partials/header.php';
// fetch current user's posts from database
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?>

    <section class="dashboard">
        <?php if(isset($_SESSION['add-post-success'])) : // shows if add post was successfull ?>
            <div class="alert_message success container">
                <p>
                    <?= $_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['edit-post-success'])) : // shows if edit post was successfull ?>
            <div class="alert_message success container">
                <p>
                    <?= $_SESSION['edit-post-success'];
                    unset($_SESSION['edit-post-success']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['edit-post'])) : // shows if edit post was not successfull ?>
            <div class="alert_message error container">
                <p>
                    <?= $_SESSION['edit-post'];
                    unset($_SESSION['edit-post']);
                    ?>
                </p>
            </div>
        <?php elseif(isset($_SESSION['delete-post-success'])) : // shows if delete post was successfull ?>
            <div class="alert_message success container">
                <p>
                    <?= $_SESSION['delete-post-success'];
                    unset($_SESSION['delete-post-success']);
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
                            <h5>Añadir Publicacion</h5>
                        </a>
                    </li>
                    <li>
                        <a href="index.php" class="active"><i class='bx bx-edit-alt'></i>
                            <h5>Administrar Publicacion</h5>
                        </a>
                    </li>

                    <?php if(isset($_SESSION['user_is_admin'])): ?>

                        <li>
                            <a href="add-user.php"><i class='bx bx-user-plus' ></i>
                                <h5>Agregar Usuario</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-users.php"><i class='bx bxs-user-detail' ></i>
                                <h5>Administrar Usuarios</h5>
                            </a>
                        </li>
                        <li>
                            <a href="add-category.php"><i class='bx bxs-edit'></i>
                                <h5>Agregar Categoria</h5>
                            </a>
                        </li>
                        <li>
                            <a href="manage-categories.php"><i class='bx bx-list-ul' ></i>
                                <h5>Administrar Categorias</h5>
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
                <h2>Administrar Publicaciones</h2>
                <?php if(mysqli_num_rows($posts)>0) : ?>

                <table>
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Categoria</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                            <!-- get category title of each post from categories table -->
                            <?php
                            $category_id = $post['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category= mysqli_fetch_assoc($category_result);

                            ?>
                            <tr>
                                <td><?= $post['title'] ?></td>
                                <td><?= $category['title']  ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id']?>" class="btn sm">Editar</a> </td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id']?>" class="btn sm danger">Borrar</a> </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>

                <?php else :?>
                    <div class="alert_message error"><?= "No se han encontrado publicaciones" ?></div>
                <?php endif ?>

            </main>
        </div>
    </section>

<?php
include '../partials/footer.php';
?>