<div class="space-y-4">
    <h2 class="text-xl font-semibold">Categorías Existentes</h2>
    <div v-for="category in categories" :key="category.id" class="flex items-center space-x-4 bg-gray-200 p-4 rounded-lg shadow">
        <span>{{ category.name }}</span>
        <button @click="editCategory(category)" class="bg-blue-500 text-white px-4 py-2 rounded">Editar</button>
        <button @click="confirmDelete(category.id)" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
    </div>
</div>
