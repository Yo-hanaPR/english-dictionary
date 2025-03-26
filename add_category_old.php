<?php
include 'config.php';
include 'navbar.php';

// Procesar el formulario si se envía
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
        echo "<script>window.location.href='add_category.php';</script>";
    }
}
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

    Aqui arriba pondre los componentes

    <?php include 'components/category_list.php'; ?>
        <?php include 'components/category_form.php'; ?>
        <!---------------------------------------------------- 

        A CONTINUACION VIENE EL QUE YA ESTABA ANTES:.
        -------------------------------------------------- 
         Lista de categorías -->
        <div class="space-y-4">
            <h2 class="text-xl font-semibold">Categorías Existentes</h2>
            <div v-for="category in categories" :key="category.id" class="flex items-center space-x-4 bg-gray-200 p-4 rounded-lg shadow">
                <span>{{ category.name }}</span>
                <button @click="editCategory(category)" class="bg-blue-500 text-white px-4 py-2 rounded">Editar</button>
                <button @click="confirmDelete(category.id)" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
            </div>
        </div>

        <!-- Formulario para agregar una categoría 
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-3xl font-bold mb-4">Agregar Nueva Categoría</h2>

            <form method="POST" action="add_category.php">
                <label class="block font-semibold mb-1">Nombre de la Categoría:</label>
                <input type="text" v-model="categoryName" name="category_name" class="w-full p-2 border rounded-lg mb-4" required>
                

                <!-- Checkbox para agregar subcategorías -->
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="enableSubcategories" v-model="enableSubcategories" class="mr-2">
                    <label for="enableSubcategories" class="font-semibold">Agregar Subcategorías</label>
                </div>

                <!-- Campos de subcategorías -->
                <div v-if="enableSubcategories" class="space-y-2">
                    <div v-for="(subcat, index) in subcategories" :key="index" class="flex items-center">
                        <input type="text" :name="'subcategories[]'" v-model="subcategories[index]" class="w-full p-2 border rounded-lg">
                        <button type="button" @click="removeSubcategory(index)" class="bg-red-500 text-white px-3 py-2 ml-2 rounded">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <button type="button" @click="addSubcategory" class="bg-green-500 text-white px-4 py-2 rounded mt-2">
                        <i class="fas fa-plus"></i> Agregar Subcategoría
                    </button>
                </div>

                <button type="submit" v-show="!isEditing" class="bg-lime-500 text-white px-4 py-2 rounded-lg">Agregar Categoría</button>
            </form>
            <button @click="saveCategory()" v-show="isEditing" class="bg-indigo-500 text-white px-4 py-2 rounded-lg">ACTUALIZAR </button>
        </div>
    </div>
</div>

<script>
const app = Vue.createApp({
    data() {
        return {
            categories: [],       // Lista de categorías
            categoryName: '',     // Nombre de la categoría (vinculado al formulario)
            isEditing: false,     // Indica si estamos editando una categoría
            currentCategoryId: null,  // ID de la categoría que estamos editando
            enableSubcategories: false, // Estado del checkbox
            subcategories: [], // Lista de subcategorías dinámicas
        };
    },
    mounted() {
        this.fetchCategories();  // Cargar las categorías al inicio
    },
    methods: {
        async fetchCategories() {
            // Obtén las categorías desde la base de datos
            const response = await fetch('fetch_categories.php');
            const data = await response.json();
            this.categories = data;
        },
        addSubcategory() {
            this.subcategories.push('');
        },
        removeSubcategory(index) {
            this.subcategories.splice(index, 1);
        },
        async saveCategory() {
            const categoryData = {
                name: this.categoryName,
                subcategories: this.subcategories.filter(sub => sub.trim() !== '') // Solo agregar subcategorías no vacías
            };

            if (this.isEditing) {
                // Si estamos editando, actualizamos la categoría
                categoryData.id = this.currentCategoryId;

                await fetch('update_category.php', {
                    method: 'PUT',
                    body: JSON.stringify(categoryData),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });
                this.isEditing = false;
            } else {
                // Si estamos agregando, insertamos una nueva categoría
                await fetch('add_category.php', {
                    method: 'POST',
                    body: JSON.stringify(categoryData),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });
            }

            this.fetchCategories();  // Volver a cargar las categorías
            this.categoryName = '';  // Limpiar el formulario
            this.subcategories = [];
            this.enableSubcategories = false;
        },
        editCategory(category) {
            this.isEditing = true;
            this.categoryName = category.name;
            this.currentCategoryId = category.id;
        },
        async confirmDelete(categoryId) {
            const result = await Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Eliminar',
            });

            if (result.isConfirmed) {
                await this.deleteCategory(categoryId);
            }
        },
        async deleteCategory(categoryId) {
            // Eliminar categoría de la base de datos
            await fetch('delete_category.php', {
                method: 'POST',
                body: JSON.stringify({ id: categoryId }),
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            this.fetchCategories();  // Volver a cargar las categorías
        }
    }
});

app.mount('#add_category');
</script>

</body>
</html>
