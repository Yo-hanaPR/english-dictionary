<?php
include 'config.php';

// Verificar que la solicitud sea PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Leer el cuerpo de la solicitud (en formato JSON)
    $data = json_decode(file_get_contents("php://input"), true);

    // Obtener los datos enviados
    $category_name = trim($data['name']);
    $category_id = $data['id'];
    
    // Comprobar que el nombre de la categoría no esté vacío
    if (!empty($category_name)) {
        // Preparar y ejecutar la actualización de la categoría
        $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$category_name, $category_id]);

        // Devolver una respuesta exitosa
        echo json_encode(['status' => 'success', 'message' => 'Category updated successfully!']);
    } else {
        // Si el nombre de la categoría está vacío, devolver un error
        echo json_encode(['status' => 'error', 'message' => 'Category name cannot be empty.']);
    }
} else {
    // Si la solicitud no es PUT, devolver un error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
