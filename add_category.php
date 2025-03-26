<?php
include 'config.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.47/dist/vue.global.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100 text-gray-900">

<div id="add_category" class="p-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <?php include 'components/category_list.php'; ?>
        <?php include 'components/category_form.php'; ?>
    </div>
</div>
<script src="assets/js/categories.js"></script>

</body>
</html>
