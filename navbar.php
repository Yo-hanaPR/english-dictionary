
    <?php 
        $search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
            <!-- Incluye Vue (si usas CDN) -->
            <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
            <!-- O si usas módulos, compila tu JS con un bundler como Vite o Webpack -->
            <script src="components/app.js" type="module"></script>
            <link rel="stylesheet" href="assets/css/navbar.css">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <div id="app">
            <!-- Aquí se montará el componente de Vue -->
            
        </div>

        <!-- navbar.php -->
        <nav class="bg-indigo-500 p-4">
            <div class="ham-menu">
                <span>
                </span>
                <span>
                </span>
                <span>
                </span>
            </div>
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold"><a href="index.php">English Dictionary</a></h1>
                <form action="index.php" method="GET" class="flex items-center bg-white rounded-lg px-3 py-2 shadow">
                    <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search_query) ?>" class="outline-none px-2 text-gray-700" />
                    <button type="submit">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A8.5 8.5 0 1010.5 19a8.5 8.5 0 006.15-2.85z"></path>
                        </svg>
                    </button>
                </form>
                <div class="off-screen-menu">
                    <a href="add_category.php" class="px-4 text-yellow-300 font-bold">ADD CATEGORY</a>
                    <a href="add.php" class="px-4 text-yellow-300 font-bold">ADD NEW WORD</a>
                    <?php
                    // Obtener todas las categorías de la base de datos para el navbar
                    include 'config.php';
                    $stmt = $pdo->query("SELECT * FROM categories");
                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $category): ?>
                        <a href="index.php?category=<?= urlencode($category['name']) ?>" class="px-4"><?= htmlspecialchars($category['name']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </body>
    </html>

