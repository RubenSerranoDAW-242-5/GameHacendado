<link rel="stylesheet" href="../assets/css/header.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<header id="cabezera">
    <div class="logo">
        <img src="../assets/images/logo.webp">
        <h1>GameHacendado</h1>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Buscar productos...">
        <button type="submit">Buscar</button>
    </div>

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
</header>