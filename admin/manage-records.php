<?php
include 'partials/header.php';
//fetch users from database but not current user
$current_admin_id =$_SESSION['user-id'];
$query = "SELECT * FROM records";
$records = mysqli_query($connection, $query);
?>

    <section class="dashboard">
        

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
                            <a href="manage-users.php" ><i class='bx bxs-user-detail' ></i>
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
                            <a href="manage-records.php" class="active"><i class='bx bxs-user-detail' ></i>
                                <h5>Solicitudes de Constancia</h5>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Administrar usuarios</h2>
                <?php if(mysqli_num_rows($records)>0) : ?>
                <table class="table table-bordered" id="myTable">
                    <thead class="head-table">
                        <tr>
                            <th>Nombre Completo</th>
                            
                            <th>Curso</th>
                            
                            <th>Modalidad</th>
                            <th>Turno</th>
                            <th>Correo electronico</th>
                            <th>Motivo</th>
                            <th>Fecha de solicitud</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while($record = mysqli_fetch_assoc($records)) : ?>

                            <tr>
                                <td><?= "{$record['firstname']} {$record['lastname']}" ?></td>
                                <td><?= "{$record['course']} {$record['division']}" ?></td>
                                
                                <td><?= $record['modality'] ?></td>
                                <td><?= $record['shift'] ?></td>
                                <td><?= $record['email'] ?></td>
                                <td><?= $record['reason'] ?></td>
                                <td><?= $record['order_date'] ?></td>
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/">
        
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
<?php
include '../partials/footer.php';
?>