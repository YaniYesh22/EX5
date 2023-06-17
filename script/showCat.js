function showCategory(data) {
    const selectElement = document.getElementById('category_ch');
    for (const category of data.category) {
        const optionElement = document.createElement('option');
        optionElement.value = category;
        optionElement.textContent = category;
        selectElement.appendChild(optionElement);
    }
}



fetch("data/category.json")
    .then(response => response.json())
    .then(data => showCategory(data));
