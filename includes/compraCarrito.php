<?php
//controlar la fecha de compra

// $bd->conectar();
// $query = "";
// $bd->queryUpdate($query);//hacer el update de pedido terminado y poner contador a cero
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Compra Hecha</h1>
</body>
</html> -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Compra</title>
    
    <?php
    include '../config/ConexionBD.php';
    include '../includes/header.php'; 
    ?>
    <link rel="stylesheet" href="../assets/css/compraCarrito.css">
</head>

<body>

    <div class="receipt-container">
        <h1>Recibo de Compra</h1>
        <div class="receipt-header">
            <p><strong>Pedido No:</strong> 123456</p>
            <p><strong>Fecha:</strong> 21 de Octubre de 2024</p>
            <p><strong>Cliente:</strong> Juan Pérez</p>
            <p><strong>Dirección de envío:</strong> Calle Falsa 123, Ciudad</p>
        </div>

        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Producto A</td>
                    <td>2</td>
                    <td>$10.00</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td>Producto B</td>
                    <td>1</td>
                    <td>$15.00</td>
                    <td>$15.00</td>
                </tr>
                <tr>
                    <td>Producto C</td>
                    <td>3</td>
                    <td>$7.50</td>
                    <td>$22.50</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Subtotal</strong></td>
                    <td>$57.50</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Envío</strong></td>
                    <td>$5.00</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td>$62.50</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php include "../includes/footer.php"; ?>
    <!-- <footer id="pie">
        <div class="footer-container">
            <div class="footer-section">
                <h2>Contacto</h2>
                <p>Email: contacto@tienda.com</p>
                <p>Teléfono: +34 123 456 789</p>
            </div>
            <div class="footer-section">
                <h2>Síguenos</h2>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h2>Ayuda</h2>
                <ul>
                    <li><a href="#">Política de Devoluciones</a></li>
                    <li><a href="#">Términos y Condiciones</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Tienda Online. Todos los derechos reservados.</p>
        </div>
    </footer> -->

</body>

</html>