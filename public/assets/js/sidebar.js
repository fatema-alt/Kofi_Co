document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const menuSubmenu = document.getElementById('menuSubmenu');

    if (!menuToggle || !menuSubmenu) return;

    const dropdown = menuToggle.closest('.nav-dropdown');

    menuToggle.addEventListener('click', function () {
        dropdown.classList.toggle('open');
    });

    const currentUrl = window.location.href;

    if (
        currentUrl.includes('/admin/menu/categories') ||
        currentUrl.includes('/admin/menu/items')
    ) {
        dropdown.classList.add('open');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const inventoryToggle = document.getElementById('inventoryToggle');

    if (inventoryToggle) {
        const inventoryDropdown = inventoryToggle.closest('.nav-dropdown');

        inventoryToggle.addEventListener('click', function () {
            inventoryDropdown.classList.toggle('open');
        });

        if (
            window.location.href.includes('/admin/ingredients') ||
            window.location.href.includes('/admin/stock-movements')
        ) {
            inventoryDropdown.classList.add('open');
        }
    }
});