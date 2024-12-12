document.addEventListener("DOMContentLoaded", function () {
    let mensajesDiv = document.getElementById('mensajes');
    mensajesDiv.scrollTop = mensajesDiv.scrollHeight;

    let timeout;
    const resetTimeout = () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            const inputField = document.getElementById('mensaje');
            const isScrolledToBottom = mensajesDiv.scrollHeight - mensajesDiv.scrollTop === mensajesDiv.clientHeight;
            if (!inputField.value.trim() && isScrolledToBottom) {
                location.reload();
            }
        }, 5000);
    };

    const inputField = document.getElementById('mensaje');
    inputField.addEventListener('input', resetTimeout);
    mensajesDiv.addEventListener('scroll', resetTimeout);
    resetTimeout();
});