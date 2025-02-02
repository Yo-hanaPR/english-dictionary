<!-- navbar.php -->
<nav class="bg-indigo-500 text-white p-4">
    <div class="container mx-auto flex justify-between">
        <h1 class="text-2xl font-bold"><a href="index.php">English Dictionary</a></h1>
        <div>
            <a href="add_category.php" class="px-4 text-yellow-300 font-bold">ADD CATEGORY</a>
            <a href="add.php" class="px-4 text-yellow-300 font-bold">ADD NEW WORD</a>
            <?php
            // Obtener todas las categorías de la base de datos
            include 'config.php';
            $stmt = $pdo->query("SELECT * FROM categories");
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $category): ?>
                <a href="index.php?category=<?= urlencode($category['name']) ?>" class="px-4"><?= htmlspecialchars($category['name']) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>
