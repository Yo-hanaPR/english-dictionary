<?php
// edit_entry.php
include 'config.php';
// Include the navbar
include 'navbar.php';

if (isset($_GET['id'])) {
    $entry_id = $_GET['id'];

    // Obtener los datos actuales
    $stmt = $pdo->prepare("SELECT * FROM entries WHERE id = ?");
    $stmt->execute([$entry_id]);

    $entry= $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$entry_id) {
        echo "Entrada no encontrada.";
        exit();
    }
} else {
    echo "ID de entrada no proporcionado.";
    exit();
}
// Actualizar entrada si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $updateStmt = $pdo->prepare("UPDATE entries SET title = ?, content = ? WHERE id = ?");
    

    if ($updateStmt->execute([$title, $content, $entry_id])) {
        header("Location: index.php?msg=updated");
        exit();
    } else {
        echo "Error al actualizar la entrada.";
    }

}

?>

<!-- Formulario para editar entrada con estilos y CKEditor -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto mt-6 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-3xl font-bold mb-4">Editar Entrada</h2>

        <form method="POST">
            <label class="block font-semibold mb-1">Título:</label>
            <input type="text" name="title" value="<?= htmlspecialchars($entry['title']) ?>" 
                   class="w-full p-2 border rounded-lg mb-4" required>

            <label class="block font-semibold mb-1">Contenido:</label>
            <textarea name="content" id="editor" class="w-full p-2 border rounded-lg mb-4" rows="5" required>
                <?= htmlspecialchars($entry['content']) ?>
            </textarea>

            <div class="flex justify-between">
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-lg">Actualizar</button>
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        CKEDITOR.replace('editor');
    </script>

</body>