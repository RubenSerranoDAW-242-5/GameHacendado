window.onload = function() {
    const mensajeError = document.getElementById("mensajeError");
    if (mensajeError) {
        setTimeout(() => {
            mensajeError.style.display = "none"; // Oculta el mensaje automáticamente
        }, 5000); // 5000 ms = 5 segundos
    }

    const form = document.querySelector("form");
    form.addEventListener("submit", function() {
        if (mensajeError) {
            mensajeError.style.display = "none"; // Oculta el mensaje al enviar el formulario
        }
    });
};