<link rel="stylesheet" href="../assets/css/header.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<?php

$ruta = $_SERVER['REQUEST_URI'];
$rutaSeparada = explode('/', trim($ruta, '/'));


?>
<script>
    function redirigir() {

        const baseUrl = window.location.origin + '/GameHacendado/public/index.php';

        window.location.href = baseUrl;
    }
</script>
<header id="cabezera">
    <div class="logo">
        <img src="../assets/images/logo.webp" onclick="redirigir()">
        <h1>GameHacendado</h1>
    </div>
    <?php if (str_contains($rutaSeparada[count($rutaSeparada) - 1], 'carrito.php')): ?>

        <?php if (isset($_SESSION['email'])): ?>
            <div class="icons">
                <a href="../public/perfil.php" class="iconoUsuario">
                    <img src="../assets/images/iconoUsuario.webp">
                </a>
                <button class="cerrarSesion" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
            </div>
        <?php endif; ?>

    <?php elseif (str_contains($rutaSeparada[count($rutaSeparada) - 1], 'index.php')): ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="formBusqueda">
            <div class="search-bar">
                <input type="hidden" value="busqueda" name="metodoPost">
                <input type="text" placeholder="Buscar productos..." name="textoBusqueda">
                <button type="submit">Buscar</button>
            </div>
        </form>

        <?php if (isset($_SESSION['email'])): ?>
            <div class="icons">
                <a href="../public/perfil.php" class="iconoUsuario">
                    <img src="../assets/images/iconoUsuario.webp">
                </a>
                <a href="../public/carrito.php" class="iconoCarrito">
                    <img src="../assets/images/carrito.webp">
                    <span id="contador-carro"><?php echo $_SESSION['carrito-contador']; ?></span>
                </a>
                <button class="cerrarSesion" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
            </div>
        <?php else: ?>
            <div class="boton-login">
                <button class="botonInicioSesion" onclick="window.location.href='login.php'">Iniciar Sesión</button>
                <button class="botonRegistro" onclick="window.location.href='registro.php'">Registrate</button>
            </div>

        <?php endif; ?>

    <?php elseif (str_contains($rutaSeparada[count($rutaSeparada) - 1], 'perfil.php')): ?>

        <?php if (isset($_SESSION['email'])): ?>
            <div class="icons">
                <a href="../public/carrito.php" class="iconoCarrito">
                    <img src="../assets/images/carrito.webp" onclick="window.location.href='index.php'">
                    <span id="contador-carro"><?php echo $_SESSION['carrito-contador']; ?></span>
                </a>
                <button class="cerrarSesion" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</header>