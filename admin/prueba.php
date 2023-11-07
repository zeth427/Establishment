<?php
require 'config/database.php';

// fetch current user from database
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}


//fetch users from database but not current user

$query = "SELECT * FROM records";
$records = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Escolar</title>

    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital@1&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>
<body>
    <section class="dashboard">
        

            <main>
                <h2>Solicitudes de constancias</h2>
                <?php if(mysqli_num_rows($records)>0) : ?>
                <table id="example" class="table is-striped" style="width:100%">
                    <thead>
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
        
    </section>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/">
        
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
        });
    </script>
<?php
include '../partials/footer.php';
?>