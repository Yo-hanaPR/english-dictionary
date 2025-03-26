<?php 
include '../config.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = trim($_POST['category_name']);
    $subcategories = $_POST['subcategories'] ?? []; 

    
    if (!empty($category_name)) {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$category_name]);
        $category_id = $pdo->lastInsertId();
        
        if (!empty($subcategories)) {
            
            $stmt = $pdo->prepare("INSERT INTO subcategories (id_category, name) VALUES (?, ?)");
            foreach ($subcategories as $subcategory) {
                if (!empty($subcategory)) {
                    $stmt->execute([$category_id, $subcategory]);
                }
            }
        }
        echo "<script>window.location.href='../add_category.php';</script>";
        
    }
}
?>