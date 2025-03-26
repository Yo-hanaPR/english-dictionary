document.addEventListener("DOMContentLoaded", async function () {
    CKEDITOR.replace("editor");

    const categorySelect = document.getElementById("category");
    const subcategoryContainer = document.getElementById("subcategory-container");
    const subcategorySelect = document.getElementById("subcategory");

    try {
        const response = await fetch("controllers/entryController.php");
        const data = await response.json();

        // Poblar categorías
        data.categories.forEach(category => {
            let option = new Option(category.name, category.id);
            option.setAttribute("data-has-sub", data.subcategoriesByCategory[category.id] ? "1" : "0");
            categorySelect.appendChild(option);
        });

        // Manejar cambio de categoría
        categorySelect.addEventListener("change", function () {
            let categoryId = this.value;
            let hasSub = this.options[this.selectedIndex].getAttribute("data-has-sub") === "1";

            if (hasSub) {
                subcategoryContainer.style.display = "block";
                subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';

                data.subcategoriesByCategory[categoryId].forEach(sub => {
                    let option = new Option(sub.name, sub.id);
                    subcategorySelect.appendChild(option);
                });
            } else {
                subcategoryContainer.style.display = "none";
                subcategorySelect.innerHTML = "";
            }
        });

    } catch (error) {
        console.error("Error fetching categories:", error);
    }
});
