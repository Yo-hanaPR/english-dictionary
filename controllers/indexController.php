<?php 

    
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Obtener la categoría seleccionada si es que se hace una solicitud
$selected_category = isset($_GET['category']) ? $_GET['category'] : 'WORDS';

$selected_subcategory = isset($_GET['subcategory']) ? $_GET['subcategory'] : null;

$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
    
$entries = [];
$subcategories = [];

if (!empty($search_query)) {
    // Si hay una búsqueda, filtramos por contenido
    $stmt = $pdo->prepare("SELECT entries.*, categories.name as category_name 
    FROM entries 
    JOIN categories 
    ON entries.category_id = categories.id 
    WHERE entries.content 
    LIKE ? 
    ORDER BY entries.id 
    DESC");

    $stmt->execute(["%$search_query%"]);
}
elseif ($selected_subcategory) {
    // Si se selecciona una subcategoría, mostrar sus entradas
    $stmt = $pdo->prepare("SELECT * FROM entries WHERE id_subcategory = 
                           (SELECT id FROM subcategories WHERE name = ?) ORDER BY id DESC");
    $stmt->execute([$selected_subcategory]);
}
elseif ($selected_category) {
    // Verificar si la categoría tiene subcategorías
    $stmt = $pdo->prepare("SELECT * FROM subcategories WHERE id_category = 
                           (SELECT id FROM categories WHERE name = ?) ORDER BY id ASC");
    $stmt->execute([$selected_category]);
    $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($subcategories)) {
        // Si no tiene subcategorías, mostrar las entradas de la categoría
        $stmt = $pdo->prepare("SELECT * FROM entries WHERE category_id = 
                               (SELECT id FROM categories WHERE name = ?) ORDER BY id DESC");
        $stmt->execute([$selected_category]);
    }
}
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>