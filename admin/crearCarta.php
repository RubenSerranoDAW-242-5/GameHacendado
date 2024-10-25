<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Carta y Categoría</title>
    <link rel="stylesheet" href="../assets/css/crearCarta.css">
</head>

<body>
    <div class="form-container">
        <h2>Crear Carta</h2>
        <form id="crear-carta-form">
            <label for="nombreCarta">Nombre de la Carta:</label>
            <input type="text" id="nombreCarta" name="nombreCarta" required>

            <label for="tipoCarta">Tipo de Carta:</label>
            <input type="text" id="tipoCarta" name="tipoCarta" required>

            <label for="costeCarta">Coste de Carta:</label>
            <input type="text" id="costeCarta" name="costeCarta">

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required>

            <label for="codigoCarta">Código de Carta:</label>
            <input type="text" id="codigoCarta" name="codigoCarta" required>

            <label for="precioCarta">Precio:</label>
            <input type="number" id="precioCarta" name="precioCarta" step="0.01" required>

            <label for="img">Imagen URL:</label>
            <input type="url" id="img" name="img">

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" required>

            <button type="submit" class="añadir-carta">Crear Carta</button>
        </form>
    </div>

    <div class="form-container">
        <h2>Crear Categoría</h2>
        <form id="crear-categoria-form">
            <label for="categoria">Nombre de la Categoría:</label>
            <input type="text" id="categoria" name="categoria" required>

            <button type="submit" class="añadir-carta">Crear Categoría</button>
        </form>
    </div>

</body>

</html>