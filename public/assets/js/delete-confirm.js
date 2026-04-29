document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-user');

    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const url = this.getAttribute('href');

            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = url;
            }
        });
    });
});