<?php
include 'config.php';

// Include the navbar
include 'navbar.php';


// Obtener todas las categorías para el menú desplegable
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    if (!empty($title) && !empty($content) && !empty($category_id)) {
        $stmt = $pdo->prepare("INSERT INTO entries (title, content, category_id) VALUES (?, ?, ?)");
        $stmt->execute([$title, $content, $category_id]);
        echo "<script>window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Word</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Formulario -->
    <div class="container mx-auto mt-6 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-3xl font-bold mb-4">Add a New Word</h2>

        <form method="POST" action="add.php">
            <label class="block font-semibold mb-1">Word Title:</label>
            <input type="text" name="title" class="w-full p-2 border rounded-lg mb-4" required>

            <label class="block font-semibold mb-1">Definition:</label>
            <textarea name="content" id="editor" class="w-full p-2 border rounded-lg mb-4"></textarea>

            <label class="block font-semibold mb-1">Category:</label>
            <select name="category_id" class="w-full p-2 border rounded-lg mb-4" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-lg">Add Word</button>
        </form>
    </div>

    <script>
        CKEDITOR.replace('editor');
    </script>

</body>
</html>
