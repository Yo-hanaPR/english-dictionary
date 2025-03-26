<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-3xl font-bold mb-4">Agregar Nueva Categoría</h2>
    <form method="POST" action="controllers/categoryController.php">
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
    <button @click="saveCategory()" v-show="isEditing" class="bg-indigo-500 text-white px-4 py-2 rounded-lg">ACTUALIZAR</button>
</div>
