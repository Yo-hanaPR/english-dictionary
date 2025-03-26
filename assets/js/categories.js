const app = Vue.createApp({
    data() {
        return {
            categories: [],       
            categoryName: '',     
            isEditing: false,     
            currentCategoryId: null,  
            enableSubcategories: false, 
            subcategories: [], 
        };
    },
    mounted() {
        this.fetchCategories();
    },
    methods: {
        async fetchCategories() {
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
                subcategories: this.subcategories.filter(sub => sub.trim() !== '')
            };

            if (this.isEditing) {
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
                await fetch('add_category.php', {
                    method: 'POST',
                    body: JSON.stringify(categoryData),
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });
            }

            this.fetchCategories();
            this.categoryName = '';
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
            await fetch('delete_category.php', {
                method: 'POST',
                body: JSON.stringify({ id: categoryId }),
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            this.fetchCategories();
        }
    }
});

app.mount('#add_category');
