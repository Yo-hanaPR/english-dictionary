<?php
session_start();
include '../config.php';

// Obtener todas las categorías
$stmt = $pdo->prepare("SELECT * FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las subcategorías
$stmt = $pdo->prepare("SELECT * FROM subcategories");
$stmt->execute();
$subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agrupar subcategorías por categoría
$subcategoriesByCategory = [];
foreach ($subcategories as $sub) {
    $subcategoriesByCategory[$sub['id_category']][] = $sub;
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category_id = $_POST['category_id'] ?? null;
    $subcategory_id = $_POST['subcategory_id'] ?? null;

    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $imagePath = null;
        }
    }

    if (!empty($title) && !empty($content) && !empty($category_id)) {
        $stmt = $pdo->prepare("INSERT INTO entries (title, content, category_id, id_subcategory, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $content, $subcategory_id ? null : $category_id, $subcategory_id, $imagePath]);

        header("Location: ../index.php");
        exit();
    }
}

// Devolver los datos a la vista
$data = [
    'categories' => $categories,
    'subcategoriesByCategory' => $subcategoriesByCategory
];

echo json_encode($data);
?>
