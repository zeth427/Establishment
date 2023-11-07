<?php
require 'partials/header.php';

// get back form data if there was a registration error

    $firstname= $_SESSION['records-data']['firstname'] ?? null;
    $lastname= $_SESSION['records-data']['lastname'] ?? null;
    $course= $_SESSION['records-data']['course'] ?? null;
    $division= $_SESSION['records-data']['division'] ?? null;
    $modality= $_SESSION['records-data']['modality'] ?? null;
    $shift= $_SESSION['records-data']['shift'] ?? null;
    
    $email= $_SESSION['records-data']['email'] ?? null;
    $reason= $_SESSION['records-data']['reason'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $course = filter_var($_POST['course'], FILTER_SANITIZE_NUMBER_INT);
    $division = filter_var($_POST['division'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $modality = filter_var($_POST['modality'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $shift = filter_var($_POST['shift'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $reason = filter_var($_POST['reason'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    

    if (empty($firstname) || empty($lastname) || empty($course) || empty($division) || empty($modality) || empty($shift) || empty($email) || empty($reason)) {
        echo "<script>alert('Por favor, complete todos los campos');</script>";
    } else {
        // Los campos no están vacíos, continuar con el proceso de inserción en la base de datos

        // Obtener la fecha actual
        $creationDate = date('Y-m-d');

        // Insertar el registro en la base de datos
        $query = "INSERT INTO records (firstname, lastname, course, division, modality , shift, email,reason) VALUES ('$firstname','$lastname','$course','$division', '$modality', '$shift', '$email', '$reason'  )"; 
    

        if ($connection->query($query) === true) {
            echo "<script>alert('Datos agregados correctamente.');</script>";
            // Limpiar los datos del formulario después del registro exitoso
            $firstname = '';
            $lastname = '';
            $course = '';
            $division = '';
            $modality = '';
            $shift = '';
            $email = '';
            $reason = '';
        } else {
            echo "<script>alert('Error al registrar los datos: " . $connection->error . "');</script>";
        }
    }
    $connection->close();
}

?>



        <section class="form_section">
            <div class="container form_section-container">
                <h2>Ingresa los datos correctamente </h2>
                

                <form id="form" action="<?= ROOT_URL ?>records.php"  method="POST">
                    <input type="text" name="firstname" value="<?= $firstname?>" placeholder="Nombres">
                    <input type="text" name="lastname" value="<?= $lastname?>" placeholder="Apellidos">


                    <input type="number" name="course" value="<?= $course?>" placeholder="Curso">
                    <input type="text" name="division" value="<?= $division?>" placeholder="Division">
                    <input type="text" name="modality" value="<?= $modality?>" placeholder="Modalidad">
                    <input type="text" name="shift" value="<?= $shift?>" placeholder="Turno">

                    <input type="email" name="email" value="<?= $email ?>" placeholder="Correo electronico">
                    
                    <textarea rows="4" name="reason" placeholder="Motivo"><?= $reason ?></textarea>
                    

                    <button type="submit"  name="submit" class="btn">Aceptar</button>
                    
                </form>
            </div>
        </section>

        
<?php
include 'partials/footer.php'
?>

