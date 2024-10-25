document.addEventListener('DOMContentLoaded', function () {
    // Seleccionar todos los botones de incremento y decremento
    const botonesMas = document.querySelectorAll('.btn-mas');
    const botonesMenos = document.querySelectorAll('.btn-menos');

    // Añadir evento de clic para incrementar
    botonesMas.forEach(boton => {
        boton.addEventListener('click', function () {
            const idCarta = this.getAttribute('data-id');
            const inputCantidad = document.getElementById(`cantidad-${idCarta}-añadir`);
            let cantidadActual = parseInt(inputCantidad.value);

            // Incrementar la cantidad
            cantidadActual++;
            inputCantidad.value = cantidadActual;
        });
    });

    // Añadir evento de clic para decrementar
    botonesMenos.forEach(boton => {
        boton.addEventListener('click', function () {
            const idCarta = this.getAttribute('data-id');
            const inputCantidad = document.getElementById(`cantidad-${idCarta}-añadir`);
            let cantidadActual = parseInt(inputCantidad.value);

            // Decrementar la cantidad sin bajar de 1
            if (cantidadActual > 1) {
                cantidadActual--;
                inputCantidad.value = cantidadActual;
            }
        });
    });
});
