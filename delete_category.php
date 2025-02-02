<?php
include 'config.php';

// Leer el cuerpo de la solicitud (en formato JSON)
$data = json_decode(file_get_contents("php://input"), true);

// Obtener el ID de la categoría a eliminar
$category_id = $data['id'];

// Eliminar la categoría de la base de datos
$stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
$stmt->execute([$category_id]);

// Devolver una respuesta exitosa
echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully!']);
?>
