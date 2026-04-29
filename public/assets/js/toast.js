function showToast(message = "Success!") {
    const toast = document.getElementById('toast');
    toast.querySelector('span').innerText = message;

    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}