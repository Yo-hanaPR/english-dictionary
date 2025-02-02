<?php
include 'config.php';

// Obtener todas las categorías de la base de datos
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados en formato JSON
echo json_encode($categories);
?>
