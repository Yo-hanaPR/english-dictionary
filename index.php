<?php
include 'config.php';

// Obtener todas las categorías de la base de datos
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener la categoría seleccionada si es que se hace una solicitud
$selected_category = isset($_GET['category']) ? $_GET['category'] : 'WORDS';

// Obtener los elementos correspondientes a la categoría seleccionada
$entries = [];
if ($selected_category) {
    $stmt = $pdo->prepare("SELECT * FROM entries WHERE category_id = (SELECT id FROM categories WHERE name = ?)");
    $stmt->execute([$selected_category]);
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Dictionary</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-indigo-500 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-2xl font-bold"><a href="index.php">English Dictionary</a></h1>
            <div>
                <a href="add_category.php" class="px-4 text-yellow-300 font-bold">ADD CATEGORY</a>
                <a href="add.php" class="px-4 text-yellow-300 font-bold">ADD NEW</a>
                <?php foreach ($categories as $category): ?>
                    <a href="index.php?category=<?= urlencode($category['name']) ?>" class="px-4"><?= htmlspecialchars($category['name']) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-6">
        
        <?php if ($selected_category && !empty($entries)): ?>
            <h2 class="text-3xl text-center font-bold mb-4"><?= $selected_category ? htmlspecialchars($selected_category) : 'Please select a category' ?></h2>
            <div class="flex justify-center bg-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($entries as $entry): ?>
                        <div class="bg-blue-200 p-4 rounded-xl shadow-md">
                            <h3 class="text-xl font-bold"><?php echo $entry['title']; ?></h3>
                            <p class="text-gray-700 italic"><?php echo $entry['content']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php elseif ($selected_category): ?>
            <p class="mt-4 text-gray-500">No entries found in this category.</p>
        <?php else: ?>

            
        <?php endif; ?>
    </div>

</body>
</html>
