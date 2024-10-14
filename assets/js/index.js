document.addEventListener('DOMContentLoaded', function () {
    // Seleccionamos todos los botones de más y menos
    const botonesMas = document.querySelectorAll('.btn-mas');
    const botonesMenos = document.querySelectorAll('.btn-menos');

    botonesMas.forEach(boton => {
        boton.addEventListener('click', function () {
            const idCarta = this.getAttribute('data-id');
            const inputCantidad = document.getElementById(`cantidad-${idCarta}`);
            let cantidadActual = parseInt(inputCantidad.value);
            const cantidadMax = inputCantidad.max;

            // Incrementar la cantidad pero no sobrepasar el máximo
            if (cantidadActual < cantidadMax) {
                cantidadActual++;
                inputCantidad.value = cantidadActual;
                document.getElementById(`cantidadSeleccionada-${idCarta}`).value = cantidadActual;
            }
        });
    });

    botonesMenos.forEach(boton => {
        boton.addEventListener('click', function () {
            const idCarta = this.getAttribute('data-id');
            const inputCantidad = document.getElementById(`cantidad-${idCarta}`);
            let cantidadActual = parseInt(inputCantidad.value);

            // Decrementar la cantidad pero no bajar de 1
            if (cantidadActual > 1) {
                cantidadActual--;
                inputCantidad.value = cantidadActual;
                document.getElementById(`cantidadSeleccionada-${idCarta}`).value = cantidadActual;
            }
        });
    });
});
