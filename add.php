<?php
session_start();
include 'config.php';
include 'navbar.php';
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

    <div class="container mx-auto mt-6 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-3xl font-bold mb-4">Add a New Word</h2>

        <form method="POST" action="controllers/entryController.php" enctype="multipart/form-data">
            <label class="block font-semibold mb-1">Word Title:</label>
            <input type="text" name="title" class="w-full p-2 border rounded-lg mb-4" required>

            <label class="block font-semibold mb-1">Definition:</label>
            <textarea name="content" id="editor" class="w-full p-2 border rounded-lg mb-4"></textarea>

            <label class="block font-semibold mb-1">Category:</label>
            <select name="category_id" id="category" class="w-full p-2 border rounded-lg mb-4" required></select>

            <div id="subcategory-container" style="display: none;">
                <label class="block font-semibold mb-1">Subcategory:</label>
                <select name="subcategory_id" id="subcategory" class="w-full p-2 border rounded-lg mb-4">
                    <option value="">Select a subcategory</option>
                </select>
            </div>

            <label class="block font-semibold mb-1">Upload Image:</label>
            <input type="file" name="image" accept="image/*" class="w-full p-2 border rounded-lg mb-4">

            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-lg">Add Word</button>
        </form>
    </div>

    <script src="assets/js/add_entry.js"></script>
</body>
</html>

                <!--
Ejecitar las siguientes consuñtas tambien

ALTER TABLE entries ADD COLUMN id_subcategory INT NULL;
ALTER TABLE entries ADD FOREIGN KEY (id_subcategory) REFERENCES subcategories(id);

ALTER TABLE entries MODIFY category_id INT NULL;
ALTER TABLE entries MODIFY id_subcategory INT NULL;

                -->