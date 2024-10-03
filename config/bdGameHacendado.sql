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
    SELECT * FROM Usuario;


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
        nombreCarta VARCHAR(255) NOT NULL UNIQUE,
        costeCarta INT NOT NULL,
        color VARCHAR(50) NOT NULL,
        codigoCarta VARCHAR(50) NOT NULL UNIQUE,
        precioCarta DECIMAL(10,2) NOT NULL,
        img VARCHAR(750),
        idLineaPedido BIGINT,
        FOREIGN KEY (idLineaPedido) REFERENCES LineaPedidos (id)
    );
-- cambiar url imagen por una url global(de htcdocs a la carpeta images) y en la  bd poner solo nombre imagen
INSERT INTO Carta(nombreCarta,costeCarta,color,codigoCarta,precioCarta,img) VALUES 
            ("Buu, Unlimited Majin",8,"Azul","BT25-146 SCR",110.00,"../images/buuazul.png"),
            ("SS Gogeta, Fusion Reborn",8,"Azul/Amarillo","BT22-140 SCR",60.00,"../images/gogetabi.png"),
            ("SSB Gogeta, Shining Blue Strongest Warrior",8,"Azul","BT26-138 SCR",170.00,"../images/gogetablue.png"),
            ("SS4 Gogeta, Unrivaled Sparking",8,"Amarillo","BT25-147 SCR",140.00,"../images/gogetass4ama.png"),
            ("Ultra Instinct Son Goku, State of the Gods",8,"Amarillo","BT23-140 SCR",115.00,"../images/ultradistinto.png"),
            ("SSB kaio-Ken Vegito,Blue Potara-Fusion Warrior Champion",8,"Negra","BT24-139 SCR",85.00,"../images/vegitobluexeno.png"),
            ("SS4 Vegito, A Light in the Dark",8,"Roja","BT18-139 SCR",100.00,"../images/vegitoss4rojo.png");

SELECT * FROM Carta;

DROP TABLE IF EXISTS Categorias;

CREATE TABLE
    Categorias (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        categoria VARCHAR(255) NOT NULL UNIQUE
    );

INSERT INTO Categorias(categoria) VALUES 
            ("Saiyan"),
            ("Gogeta"),
            ("Vegito"),
            ("Majin"),
            ("Dual Attack"),
            ("Quadruple Strike"),
            ("Barrier"),
            ("Victory Strike");

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
  INSERT INTO CategoriasCartas(idCarta,idCategoria) VALUES 
            -- Categoria 1(Saiyan)
            (2,1),(3,1),(4,1),(5,1),(6,1),(7,1),
            -- Categoria 2(Gogeta)
            (2,2),(3,2),(4,2),
            -- Categoria 3(Vegito)
            (6,3),(7,3),
            -- Categoria 4(Majin)
            (1,4),
            -- Categoria 5(Dual Attack)
            (1,5),
            -- Categoria 6(Quadruple Strike)
            (7,6),(4,6),
            -- Categoria 7(Barrier)
            (2,7),(3,7),
            -- Categoria 8(Victory Strike)
            (5,8);
            
SELECT c.nombreCarta, cat.categoria
FROM Carta c
JOIN CategoriasCartas cc ON c.id = cc.idCarta
JOIN Categorias cat ON cc.idCategoria = cat.id;

SELECT DISTINCT Carta.id,carta.nombreCarta, Categorias.id,Categorias.categoria FROM Categorias LEFT JOIN Carta ON Categorias.id = Carta.id order by categorias.id;