<?php
include 'config.php';
include 'controllers/indexController.php';
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Dictionary</title>
    <script src="https://cdn.tailwindcss.com"></script>


<body class="bg-gray-100 text-gray-900">

<?php if (!empty($search_query)): ?>
            <h2 class="text-3xl text-center font-bold mb-4 italic text-gray-400">
                Results for <?= htmlspecialchars($search_query) ?>
            </h2>
            <div class="absolute right-0 mt-2 mr-4">
                <a href="index.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded flex items-center">
                    <i class="fa fa-trash mr-2"></i> Volver atrás
                </a>
            </div>
        <?php endif; ?>

    <!-- Main Content -->
    <div class="container mx-auto mt-6">
            <?php if ($selected_category): ?>
            <h2 class="text-3xl text-center font-bold mb-4"><?= $selected_category ? htmlspecialchars($selected_category) : 'Please select a category'; echo '  <span style="color:#aaa;"><i><small>('.count($entries).' palabras encontradas)</small></i></span>'; ?></h2>
            <div class="flex justify-center bg-gray-100">
            <?php if (!empty($subcategories)): ?>
                <div class="flex justify-center bg-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($subcategories as $subcategory): ?>
                            <div class="bg-blue-200 p-4 rounded-xl shadow-md">
                                <h3 class="text-xl font-bold"><?= htmlspecialchars($subcategory['name']) ?></h3>
                                <div class="mt-4 text-center">
                                    <a href="index.php?subcategory=<?= urlencode($subcategory['name']) ?>" class="bg-blue-500 text-white px-4 py-2 rounded">Ver entradas</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php elseif (!empty($entries)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($entries as $entry): ?>

                        <?php
                        if (!empty($search_query)) {
                            $highlighted_text = preg_replace("/(" . preg_quote($search_query, '/') . ")/i", "<span class='text-red-500 font-bold'>$1</span>", $entry['content']);
                        } else {
                            $highlighted_text = $entry['content'];
                        }
                        ?>
                        <div class="bg-blue-200 p-4 rounded-xl shadow-md">
                            <h3 class="text-xl font-bold"><?php echo $entry['title']; ?></h3>
                            <p class="text-gray-700 italic"><?php  echo 
                            isset($search_query) ? $highlighted_text : $entry['content']; ?></p>
                            
                            <?php if (!empty($entry['image'])): ?>
                                <img src="<?= htmlspecialchars($entry['image']) ?>" alt="Entry Image" class="mt-2 rounded-lg w-full max-w-md">
                                <?php endif; ?>
                                <?php if (!empty($search_query)): ?>
                                    <small class="block text-gray-500 mt-2">Category: <?php echo htmlspecialchars($entry['category_name']); ?></small>
                                <?php endif;?>
                                <div class="float-right text-white p-4 mt-5 rounded-lg">
                                    <a href="edit_entry.php?id=<?= $entry['id']; ?>" class="bg-blue-500 text-white px-4 py-2 rounded">Editar</a>
                                    <a href="delete_entry.php?id=<?= $entry['id']; ?>" class="bg-red-500 text-white px-4 py-2 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar esta entrada?');">Eliminar</a>
                                </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="mt-4 text-gray-500 text-center">No se encontraron entradas.</p>
            <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
<?php
include('footer.php');
?>
</html>
