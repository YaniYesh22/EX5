
$(document).ready(function () {
    $('#category_ch').on('change', function () {
        var selectedCategory = $(this).val();
        var url = 'index.php?category=' + selectedCategory;
        window.location.href = url;
    });
});


