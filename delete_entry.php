<?php
// delete_entry.php
require 'config.php'; // Asegúrate de tener este archivo para la conexión

if (isset($_GET['id'])) {
    $entry_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM entries WHERE id = ?");
    $stmt->execute([$entry_id]);

    if ($stmt->execute()) {
        header("Location: index.php?msg=deleted"); // Redirige a la página principal tras eliminar
        exit();
    } else {
        echo "Error al eliminar la entrada.";
    }

} else {
    echo "ID de entrada no proporcionado.";
}

?>
