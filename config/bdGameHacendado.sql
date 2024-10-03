DROP TABLE IF EXISTS Usuario;

CREATE TABLE
    Usuario (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        apellido VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        dni VARCHAR(255) NOT NULL UNIQUE,
        contraseña VARCHAR(255) NOT NULL,
        rol VARCHAR(50) NOT NULL,
        direccion VARCHAR(800) NOT NULL,
        telefono VARCHAR(50) NOT NULL
    );

INSERT INTO Usuario (nombre, apellido, email, dni, contraseña, rol, direccion, telefono)
VALUES
    ('Juan', 'Pérez', 'juan.perez@example.com', '12345678A', 'password123', 'admin', 'Calle Falsa 123, Madrid', '+34 600 123 456'),
    ('Ana', 'García', 'ana.garcia@example.com', '87654321B', 'anaSecure!1', 'usuario', 'Av. Siempreviva 456, Barcelona', '+34 600 654 321'),
    ('Carlos', 'Sánchez', 'carlos.sanchez@example.com', '34567890C', 'carlosPass!', 'usuario', 'Plaza Mayor 789, Sevilla', '+34 600 987 654'),
    ('Lucía', 'Fernández', 'lucia.fernandez@example.com', '23456789D', 'luciaPassword!', 'admin', 'Calle del Sol 987, Valencia', '+34 600 321 987'),
    ('Miguel', 'Torres', 'miguel.torres@example.com', '56789012E', 'miguel123', 'usuario', 'Paseo de la Castellana 654, Madrid', '+34 600 432 109'),
    ('Laura', 'López', 'laura.lopez@example.com', '09876543F', 'lauraSecure', 'usuario', 'Gran Vía 321, Málaga', '+34 600 543 210'),
    ('David', 'Martínez', 'david.martinez@example.com', '67890123G', 'davidPass!', 'admin', 'Calle Luna 101, Zaragoza', '+34 600 654 321');


DROP TABLE IF EXISTS Pedidos;

CREATE TABLE
    Pedidos (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        fecha DATETIME NOT NULL,
        precioTotal DECIMAL(10,2) NOT NULL,
        direccionEnvio VARCHAR(800) NOT NULL,
        idUsuario BIGINT NOT NULL,
        FOREIGN KEY (idUsuario) REFERENCES Usuario (id)
    );



DROP TABLE IF EXISTS LineaPedidos;

CREATE TABLE
    LineaPedidos (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        cantidad INT NOT NULL,
        precioTotalLinea DECIMAL(10,2) NOT NULL,
        idPedido BIGINT NOT NULL,
        FOREIGN KEY (idPedido) REFERENCES Pedidos (id)
    );

-- Tabla de las cartas con sus atributos 
DROP TABLE IF EXISTS Carta;

CREATE TABLE
    Carta (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        nombreCarta VARCHAR(255) NOT NULL,
        costeCarta INT NOT NULL,
        color VARCHAR(50) NOT NULL,
        caja VARCHAR(50) NOT NULL ,
        precioCarta DECIMAL(10,2) NOT NULL,
        img VARCHAR(750),
        idLineaPedido BIGINT NOT NULL,
        FOREIGN KEY (idLineaPedido) REFERENCES LineaPedidos (id)
    );

INSERT INTO Cartas(nombreCarta,costeCarta,color,caja,precioCarta,img) VALUES 
            ("",8,"","",00.00,"");


DROP TABLE IF EXISTS Categorias;

CREATE TABLE
    Categorias (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        categoria VARCHAR(255) NOT NULL
    );

-- Tabla de categoria mucho a muchos 
DROP TABLE IF EXISTS CategoriasCartas;

CREATE TABLE
    CategoriasCartas (
        PRIMARY KEY (idCarta, idCategoria),
        idCarta BIGINT NOT NULL,
        FOREIGN KEY (idCarta) REFERENCES Carta (id),
        idCategoria BIGINT NOT NULL,
        FOREIGN KEY (idCategoria) REFERENCES Categorias (id)
    );