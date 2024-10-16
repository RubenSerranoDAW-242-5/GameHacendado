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
        fecha DATETIME ,
        precioTotal DECIMAL(10,2) ,
        direccionEnvio VARCHAR(800) ,
        estado ENUM('en-proceso','terminado') DEFAULT 'en-proceso',
        idUsuario BIGINT NOT NULL,
        FOREIGN KEY (idUsuario) REFERENCES Usuario (id)
    );
INSERT INTO Pedidos (fecha, precioTotal, direccionEnvio, estado, idUsuario)
VALUES
(NOW(), 300.00, 'Av. Siempreviva 456, Barcelona', 'en-proceso', 2);
SELECT * FROM pedidos;

DROP TABLE IF EXISTS LineaPedidos;

CREATE TABLE
    LineaPedidos (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        cantidad INT ,
        precioTotalLinea DECIMAL(10,2) ,
        idPedido BIGINT NOT NULL,
        FOREIGN KEY (idPedido) REFERENCES Pedidos (id),
        idCarta BIGINT NOT NULL,
        FOREIGN KEY (idCarta) REFERENCES Carta (id)
    );



INSERT INTO LineaPedidos (cantidad, precioTotalLinea, idPedido, idCarta)
VALUES
    (2, 374.00, 1, 1),
     (1, 159.00, 1, 2),
     (10,159.50,1,3);
SELECT * FROM lineapedidos;

DROP TABLE IF EXISTS Carta;

CREATE TABLE
    Carta (
        id BIGINT AUTO_INCREMENT PRIMARY KEY,
        nombreCarta VARCHAR(255) NOT NULL UNIQUE,
        tipoCarta VARCHAR(50) NOT NULL,
        costeCarta VARCHAR(20),
        color VARCHAR(50) NOT NULL,
        codigoCarta VARCHAR(50) NOT NULL UNIQUE,
        precioCarta DECIMAL(10,2) NOT NULL,
        img VARCHAR(750),
        cantidad INT NOT NULL
    );
-- cambiar url imagen por una url global(de htcdocs a la carpeta images) y en la  bd poner solo nombre imagen
INSERT INTO Carta(nombreCarta, tipoCarta, costeCarta, color, codigoCarta, precioCarta, img, cantidad) VALUES 
    ("Buu, Unlimited Majin", "Battle Card", "8", "Azul", "BT25-146", 187.00, "buuazul.png", 10),
("Android 21, Transcendental Predator", "Battle Card", "4", "Azul/Verde", "BT20-149", 159.00, "21.png", 10),
("SS4: The Vermilion Saiyans", "Extra Card", "1", "Negro", "BT15-152", 101.00, "vermilion.png", 10),
("Vegito, Warrior From Another Dimension", "Unison Card", "X", "Negro", "BT11-154", 199.00, "vegitounison.png", 10),
("Power of Potara - Vegito, Kefla & Zamasu", "Battle Card", "8", "Azul/Amarillo", "BT7-131", 142.00, "vegitobi.png", 10),
("Vegeta, Awakened Feelings", "Leader Card", "", "Rojo", "BT24-001", 72.00, "vegetarojolider.png", 10),
("Perfected Ultra Instinct Son Goku, Transcendence", "Battle Card", "10", "Negro", "BT26-140", 146.00, "ultradistintonegro.png", 10),
("SS Trunks, Tournament Battle to the Death", "Leader Card", "", "Verde", "BT25-070", 186.00, "trankaslider.png", 10),
("Tapion, Hero Revived in the Present", "Leader Card", "", "Azul", "BT24-025", 138.00, "tapionetalider.png", 10),
("SS Son Goku, Beginning of a Legend", "Leader Card", "", "Verde", "BT24-055", 134.00, "superkokunlider.png", 10),
("King Piccolo, Final Stage of Conquest", "Leader Card", "", "Rojo", "BT25-002", 195.00, "piccolodaimaolider.png", 10),
("Super Mira, Diabolical Fusion", "Unison Card", "X", "Amarillo", "BT16-002", 54.00, "miraunison.png", 10),
("SS4 Vegito, Sparking Potara Warrior", "Leader Card", "", "Negro", "BT24-112", 70.00, "lidervegito4.png", 10),
("Cell Xeno, Unspeakable Abomination", "Battle Card", "12", "Amarillo/Verde", "BT9-137", 198.00, "kuka.png", 10),
("Son Goku, Face-Off With the Great Demon king", "Leader Card", "", "Rojo", "BT25-001", 96.00, "kokunkidlider.png", 10),
("Son Goku, Apex of the Origin", "Battle Card", "7", "Negro", "BT25-148", 85.00, "kokunfrezernegro.png", 10),
("Son Goku, Fist of Fate", "Battle Card", "8", "Rojo", "BT25-145", 162.00, "kidkurojo.png", 10),
("Supreme Kai of Time, Brainwashed", "Battle Card", "8", "Negro", "BT16-149", 175.00, "kailavado.png", 10),
("Heroines' Lineage", "Extra Card", "1", "Negro", "EB1-68", 132.00, "Heroines.png", 10),
("SS3 Gohanks, Interdimensional Warrior", "Unison Card", "X", "Rojo", "BT13-153", 184.00, "gohanksunison.png", 10),
("Bursting Rage", "Extra Card", "0", "Rojo", "BT22-138", 113.00, "gohanextra.png", 10),
("SS4 Gogeta, Strongest Fusion Explosion", "Leader Card", "", "Amarillo", "BT25-098", 171.00, "gogetalider.png", 10),
("Frieza, Scourge of Saiyans", "Leader Card", "", "Verde", "BT24-056", 117.00, "freezerlider.png", 10),
("Metamorphic Android Cell", "Battle Card", "10", "Verde", "BT26-139", 193.00, "cellverde.png", 10),
("Majin Buu, Shape-Shifter", "Leader Card", "", "Azul", "BT25-037", 164.00, "buulider.png", 10),
("Boujack, Crashing the Tournament", "Leader Card", "", "Verde", "BT25-071", 89.00, "bojaklider.png", 10),
("Son Gohan, Beyond the Ultimate", "Battle Card", "8", "Azul", "BT19-152", 63.00, "bestia.png", 10),
("SS Gogeta, Fusion Reborn", "Battle Card", "8", "Azul/Amarillo", "BT22-140", 103.00, "gogetabi.png", 10),
("SSB Gogeta, Shining Blue Strongest Warrior", "Battle Card", "8", "Azul", "BT26-138", 156.00, "gogetablue.png", 10),
("SS4 Gogeta, Unrivaled Sparking", "Battle Card", "8", "Amarillo", "BT25-147", 53.00, "gogetass4ama.png", 10),
("Ultra Instinct Son Goku, State of the Gods", "Battle Card", "8", "Amarillo", "BT23-140", 90.00, "ultradistinto.png", 10),
("SSB Kaio-Ken Vegito, Blue Potara-Fusion Warrior Champion", "Battle Card", "8", "Negro", "BT24-139", 130.00, "vegitobluexeno.png", 10),
("SS4 Vegito, A Light in the Dark", "Battle Card", "8", "Roja", "BT18-139", 48.00, "vegitoss4rojo.png", 10);

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
            ("Victory Strike"),
            ("Earthling"),
            ("Blocker"),
            ("Defelct"),
            ("Energy-Exhaust"),
            ("Double Strike"),
            ("Triple Strike"),
            ("Activate"),
            ("Permanent");

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
            (3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(10,1),(13,1),(15,1),(16,1),(17,1),(20,1),(22,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),
            -- Categoria 2(Gogeta)
            (22,2),(28,2),(29,2),(30,2),
            -- Categoria 3(Vegito)
            (4,3),(5,3),(13,3),(32,3),(33,3),
            -- Categoria 4(Majin)
            (1,4),(25,4),
            -- Categoria 5(Dual Attack)
            (2,5),(1,5),(20,5),(14,5),(12,5),
            -- Categoria 6(Quadruple Strike)
			(33,6),(14,6),(30,6),
            -- Categoria 7(Barrier)
            (2,7),(27,7),(29,7),(30,7),(20,7),(12,7),(3,7),
            -- Categoria 8(Victory Strike)
			(31,8),(7,8),
            -- Categoria 9(Earthling)
            (20,9),(27,9),
            -- Categoria 10(Blocker)
            (2,10),(28,10),(20,10),(12,10),
            -- Categoria 11(Deflect)
            (2,11),(16,11),(14,11),(32,11),(33,11),
            -- Categoria 12(Energy-Exhaust)
            (2,12),(5,12),(14,12),(28,12),
            -- Categoria 13(Double Strike)
            (18,13),(4,13),
            -- Categoria 14(Triple Strike)
            (17,14),(5,14),(32,14),
            -- Categoria 15(Activate)
            (27,15),(26,15),(1,15),(24,15),(23,15),(29,15),(30,15),(3,15),(21,15),(20,15),(19,15),(9,15),(4,15),(32,15),(18,15),(15,15),(17,15),(16,15),(13,15),(12,15),
            (11,15),(10,15),(8,15),(31,15),(7,15),(6,15),
            -- Categoria 16(Permanent)
            (2,16),(23,16),(28,16),(22,16),(4,16),(32,16),(31,16),(13,16),(16,16),(17,16);
            
SELECT c.nombreCarta, cat.categoria
FROM Carta c
JOIN CategoriasCartas cc ON c.id = cc.idCarta
JOIN Categorias cat ON cc.idCategoria = cat.id;

SELECT DISTINCT Carta.id,carta.nombreCarta, Categorias.id,Categorias.categoria FROM Categorias LEFT JOIN Carta ON Categorias.id = Carta.id order by categorias.id;

SELECT 
    p.id AS pedido_id, 
    p.fecha, 
    p.precioTotal, 
    p.direccionEnvio, 
    lp.id AS linea_pedido_id, 
    lp.cantidad, 
    lp.precioTotalLinea, 
    c.nombreCarta, 
    c.precioCarta,
    c.codigoCarta,
    c.img
FROM 
    Pedidos p 
JOIN 
    LineaPedidos lp ON p.id = lp.idPedido 
JOIN 
    LineaPedido_Carta lpc ON lp.id = lpc.idLineaPedido 
JOIN 
    Carta c ON lpc.idCarta = c.id;