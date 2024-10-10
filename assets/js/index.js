// Asegurarse de que el DOM esté cargado antes de ejecutar el script
document.addEventListener('DOMContentLoaded', function () {

    // Seleccionamos las cartas
    const cartas = document.querySelectorAll('.carta');
    cartas.forEach(carta => {
        // Añadir transiciones para una animación más fluida
        carta.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';

        // Agregar efectos de hover usando eventos 'mouseenter' y 'mouseleave'
        carta.addEventListener('mouseenter', () => {
            carta.style.transform = 'translateY(-5px)';
            carta.style.boxShadow = '0px 4px 15px rgba(0, 123, 255, 0.4)';
        });

        carta.addEventListener('mouseleave', () => {
            carta.style.transform = 'translateY(0)';
            carta.style.boxShadow = '0px 2px 10px rgba(0, 123, 255, 0.2)';
        });
    });
    cartas.forEach(boton => {
        boton.addEventListener('click', function (event) {
            event.preventDefault(); // Evita el envío por defecto del formulario

            // Obtener el ID de la carta
            const idCarta = boton.closest('form').querySelector('input[name="idCarta"]').value;

            // Enviar la ID al servidor mediante AJAX
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'idCarta': idCarta
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log('Añadido al carrito ID:', data.idCarta);
                        // Aquí puedes actualizar la interfaz del usuario si es necesario
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
    // Botones de "Añadir a carrito"
    const botones = document.querySelectorAll('#grid button');
    botones.forEach(boton => {
        // Añadir transiciones para una animación más fluida
        boton.style.transition = 'background-color 0.3s ease, box-shadow 0.3s ease';

        // Efecto de hover en los botones
        boton.addEventListener('mouseenter', () => {
            boton.style.backgroundColor = '#0056b3';
            boton.style.boxShadow = '0px 4px 12px rgba(0, 123, 255, 0.4)';
        });

        boton.addEventListener('mouseleave', () => {
            boton.style.backgroundColor = '#007bff';
            boton.style.boxShadow = 'none';
        });

        // Todos los botones estarán siempre habilitados
        boton.disabled = false;
    });
});



