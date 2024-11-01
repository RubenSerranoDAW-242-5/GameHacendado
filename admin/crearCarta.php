<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Carta y Categoría</title>
    <link rel="stylesheet" href="../assets/css/crearCarta.css">



    <?php include '../includes/header.php'; ?>


    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $metodo = $_POST['metodo'];

        switch ($metodo) {
            case "crear-carta":

                include "../includes/creacionCarta.php";

                exit;

            case "crear-categoria":

                $bd->conectar();

                $categoria = $_POST['categoria'];

                $query = "INSERT INTO Categorias(categoria) VALUES ('$categoria')";
                $bd->queryInsert($query);

                $bd->desconectar();

                break;
        }
    }

    ?>

</head>

<body>
    <h2>Crear Carta</h2>
    <div class="form-container">

        <div class="form-section-cartas">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
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

                <div class="file-upload-container">
                    <label for="img" class="custom-file-upload">Seleccionar imagen</label>
                    <input type="file" id="img" name="img" onchange="mostrarNombreArchivo()">
                    <span id="nombre-archivo"></span>
                </div>

                <?php
                $bd->conectar();

                $query = "SELECT * FROM Categorias;";
                $resultado = $bd->querySelectMuchos($query);

                $bd->desconectar();
                ?>

                <label for="categorias">Categorías:</label>
                <select id="categorias" name="categorias[]" multiple>
                    <?php foreach ($resultado as $categoria): ?>
                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" required>


                <input type="hidden" name="metodo" value="crear-carta">
                <button type="submit" class="añadir-carta">Crear Carta</button>
            </form>
        </div>

        <div class="form-section-categoria">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="categoria">Nombre Categoria:</label>
                <input type="text" id="categoria" name="categoria" required>
                <input type="hidden" name="metodo" value="crear-categoria">
                <button type="submit" class="añadir-categoria">Crear Categoria</button>
            </form>
        </div>
    </div>

</body>

<script>
    function mostrarNombreArchivo() {
        const inputFile = document.getElementById('img');
        const nombreArchivo = document.getElementById('nombre-archivo');
        if (inputFile.files.length > 0) {
            nombreArchivo.textContent = `Archivo seleccionado: ${inputFile.files[0].name}`;
        } else {
            nombreArchivo.textContent = '';
        }
    }

    $(document).ready(function() {
        $('#categorias').select2({
            placeholder: "Selecciona una o más categorías",
            width: '100%',
            tags: true
        });
    });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<?php include '../includes/footer.php'; ?>

</html>