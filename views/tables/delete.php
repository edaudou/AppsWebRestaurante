<?php
// Assuming you have a function to get the reservation by ID and delete it
include_once '../../models/reserva.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reserva = getReservaById($id);

    if ($reserva) {
        if (isset($_POST['confirm'])) {
            deleteReserva($id);
            header('Location: /restaurante/views/reservas/index.php');
            exit();
        }
    } else {
        echo "Reserva not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Reserva</title>
</head>
<body>
    <h1>Delete Reserva</h1>
    <p>Are you sure you want to delete this reserva?</p>
    <form method="post">
        <button type="submit" name="confirm">Yes, delete it</button>
        <a href="/restaurante/views/reservas/index.php">Cancel</a>
    </form>
</body>
</html>