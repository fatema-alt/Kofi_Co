document.addEventListener('DOMContentLoaded', function () {
    const userBtn = document.getElementById('userBtn');
    const dropdown = document.getElementById('dropdownMenu');

    if (!userBtn || !dropdown) return;

    // Toggle dropdown
    userBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.style.display =
            dropdown.style.display === 'block' ? 'none' : 'block';
    });

    // Close when clicking outside
    document.addEventListener('click', function () {
        dropdown.style.display = 'none';
    });
});