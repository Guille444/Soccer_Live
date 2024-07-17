DROP DATABASE IF EXISTS db_soccer_live;

CREATE DATABASE db_soccer_live;

USE db_soccer_live;

CREATE TABLE empleados(
id_empleado INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_empleado VARCHAR(50) NOT NULL,
apellido_empleado VARCHAR(50) NOT NULL,
telefono_empleado VARCHAR(9) NOT NULL,
dui_empleado VARCHAR(10) NOT NULL,
correo_empleado VARCHAR(100) NOT NULL,
clave_empleado VARCHAR(64) NOT NULL
);

DESCRIBE empleados;

ALTER TABLE empleados
ADD CONSTRAINT chk_telefono_empleado CHECK (telefono_empleado REGEXP '^[0-9]{4}-[0-9]{4}$');

ALTER TABLE empleados
ADD CONSTRAINT chk_correo_empleado CHECK (correo_empleado REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$');

CREATE TABLE categorias(
id_categoria INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_categoria VARCHAR(50) NOT NULL,
descripcion_categoria VARCHAR(150) NOT NULL,
imagen_categoria VARCHAR(25) NOT NULL
);

DESCRIBE categorias;

CREATE TABLE marcas(
id_marca INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_marca VARCHAR(50) NOT NULL,
correo_marca VARCHAR(100) NOT NULL,
imagen_marca VARCHAR(25) NOT NULL
);

DESCRIBE marcas;

ALTER TABLE marcas
ADD CONSTRAINT chk_correo_marca CHECK (correo_marca REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$');

CREATE TABLE productos(
id_producto INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_producto VARCHAR(50) NOT NULL,
descripcion_producto VARCHAR(150),
precio_producto NUMERIC(5,2) NOT NULL,
existencias_producto INT UNSIGNED NOT NULL,
imagen_producto VARCHAR(25) NOT NULL,
estado_producto BOOLEAN NOT NULL,
id_categoria INT NOT NULL,
CONSTRAINT fk_producto_categoria
FOREIGN KEY (id_categoria)
REFERENCES categorias (id_categoria),
id_marca INT NOT NULL,
CONSTRAINT fk_producto_marca
FOREIGN KEY (id_marca)
REFERENCES marcas (id_marca),
id_empleado INT NOT NULL,
CONSTRAINT fk_producto_empleado
FOREIGN KEY (id_empleado)
REFERENCES empleados (id_empleado)
);

DESCRIBE productos;

ALTER TABLE productos
ADD CONSTRAINT chk_precio_positivo CHECK (precio_producto > 0);

CREATE TABLE clientes(
id_cliente INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
nombre_cliente VARCHAR(50) NOT NULL,
apellido_cliente VARCHAR(50) NOT NULL,
direccion_cliente VARCHAR(250) NOT NULL,
telefono_cliente VARCHAR(10) NOT NULL,
correo_cliente VARCHAR(100) NOT NULL,
clave_cliente VARCHAR(64) NOT NULL,
estado_cliente BOOLEAN NOT NULL
);

DESCRIBE clientes;

ALTER TABLE clientes
ADD CONSTRAINT chk_telefono_cliente CHECK (telefono_cliente REGEXP '^[0-9]{4}-[0-9]{4}$');

ALTER TABLE clientes
ADD CONSTRAINT chk_correo_cliente CHECK (correo_cliente REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$');

ALTER TABLE clientes
ALTER COLUMN estado_cliente SET DEFAULT 1;

CREATE TABLE pedidos(
id_pedido INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
direccion_pedido VARCHAR(250) NOT NULL,
estado_pedido ENUM('Pendiente','Finalizado','Entregado') NOT NULL,
fecha_registro DATE DEFAULT current_timestamp(),
id_cliente INT NOT NULL,
CONSTRAINT fk_pedido_cliente
FOREIGN KEY (id_cliente)
REFERENCES clientes (id_cliente)
);

DESCRIBE pedidos;

CREATE TABLE detalle_pedidos(
id_detalle INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
id_producto INT NOT NULL,
CONSTRAINT fk_detalle_producto
FOREIGN KEY (id_producto)
REFERENCES productos (id_producto),
cantidad_producto INT UNSIGNED NOT NULL,
precio_producto DECIMAL(5,2) NOT NULL,
id_pedido INT NOT NULL,
CONSTRAINT fk_detalle_pedido
FOREIGN KEY (id_pedido)
REFERENCES pedidos (id_pedido)
);

DESCRIBE detalle_pedidos;

ALTER TABLE detalle_pedidos
ADD CONSTRAINT chk_cantidad_positiva CHECK (cantidad_producto >= 0);

ALTER TABLE detalle_pedidos
ADD CONSTRAINT chk_precio_unitario_positivo CHECK (precio_producto > 0);

CREATE TABLE comentarios(
id_comentario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
contenido_comentario VARCHAR(250) NOT NULL,
puntuacion_comentario INT UNSIGNED NOT NULL,
fecha_comentario DATE DEFAULT current_timestamp(),
estado_comentario BOOLEAN NOT NULL,
id_detalle INT NOT NULL,
CONSTRAINT fk_comentario_detalle
FOREIGN KEY (id_detalle)
REFERENCES detalle_pedidos (id_detalle)
);
        
DESCRIBE comentarios;

-- Insertar registros en la tabla empleados
INSERT INTO empleados (nombre_empleado, apellido_empleado, telefono_empleado, dui_empleado, correo_empleado, clave_empleado) VALUES
('Carlos', 'Lopez', '1234-5678', '12345678-9', 'carlos.lopez@example.com', 'clave1'),
('Ana', 'Perez', '2345-6789', '23456789-0', 'ana.perez@example.com', 'clave2'),
('Luis', 'Martinez', '3456-7890', '34567890-1', 'luis.martinez@example.com', 'clave3'),
('Marta', 'Garcia', '4567-8901', '45678901-2', 'marta.garcia@example.com', 'clave4'),
('Jose', 'Rodriguez', '5678-9012', '56789012-3', 'jose.rodriguez@example.com', 'clave5'),
('Elena', 'Hernandez', '6789-0123', '67890123-4', 'elena.hernandez@example.com', 'clave6'),
('Sergio', 'Gonzalez', '7890-1234', '78901234-5', 'sergio.gonzalez@example.com', 'clave7'),
('Laura', 'Ramirez', '8901-2345', '89012345-6', 'laura.ramirez@example.com', 'clave8'),
('Pedro', 'Sanchez', '9012-3456', '90123456-7', 'pedro.sanchez@example.com', 'clave9'),
('Lucia', 'Torres', '0123-4567', '01234567-8', 'lucia.torres@example.com', 'clave10'),
('Juan', 'Vargas', '1234-5678', '12345678-9', 'juan.vargas@example.com', 'clave11'),
('Isabel', 'Cruz', '2345-6789', '23456789-0', 'isabel.cruz@example.com', 'clave12'),
('David', 'Ortiz', '3456-7890', '34567890-1', 'david.ortiz@example.com', 'clave13'),
('Valeria', 'Gutierrez', '4567-8901', '45678901-2', 'valeria.gutierrez@example.com', 'clave14'),
('Jorge', 'Jimenez', '5678-9012', '56789012-3', 'jorge.jimenez@example.com', 'clave15'),
('Paula', 'Morales', '6789-0123', '67890123-4', 'paula.morales@example.com', 'clave16'),
('Andres', 'Ramos', '7890-1234', '78901234-5', 'andres.ramos@example.com', 'clave17'),
('Natalia', 'Reyes', '8901-2345', '89012345-6', 'natalia.reyes@example.com', 'clave18'),
('Antonio', 'Castro', '9012-3456', '90123456-7', 'antonio.castro@example.com', 'clave19'),
('Camila', 'Mendoza', '0123-4567', '01234567-8', 'camila.mendoza@example.com', 'clave20');

-- Insertar registros en la tabla categorias
INSERT INTO categorias (nombre_categoria, descripcion_categoria, imagen_categoria) VALUES
('Balones', 'Balones de fútbol de diferentes marcas y tamaños', 'default.png'),
('Camisetas', 'Camisetas de equipos de fútbol', 'default.png'),
('Zapatos', 'Zapatos de fútbol para todas las superficies', 'default.png'),
('Accesorios', 'Accesorios y equipamiento para fútbol', 'default.png'),
('Protecciones', 'Protecciones para jugadores de fútbol', 'default.png'),
('Entrenamiento', 'Equipamiento para entrenamiento de fútbol', 'default.png'),
('Porteros', 'Equipamiento específico para porteros', 'default.png'),
('Uniformes', 'Uniformes completos para equipos de fútbol', 'default.png'),
('Medias', 'Medias deportivas para fútbol', 'default.png'),
('Guantes', 'Guantes para porteros', 'default.png'),
('Balones de entrenamiento', 'Balones específicos para entrenamiento', 'default.png'),
('Conos y marcadores', 'Conos y marcadores para entrenamientos', 'default.png'),
('Botellas de agua', 'Botellas de agua deportivas', 'default.png'),
('Mochilas', 'Mochilas para equipamiento de fútbol', 'default.png'),
('Chalecos de entrenamiento', 'Chalecos diferenciadores para entrenamientos', 'default.png'),
('Silbatos', 'Silbatos para árbitros y entrenadores', 'default.png'),
('Tarjetas', 'Tarjetas rojas y amarillas para árbitros', 'default.png'),
('Banderines', 'Banderines de línea para árbitros', 'default.png'),
('Balones de playa', 'Balones específicos para fútbol de playa', 'default.png'),
('Otros', 'Otros productos relacionados con el fútbol', 'default.png');

-- Insertar registros en la tabla marcas
INSERT INTO marcas (nombre_marca, correo_marca, imagen_marca) VALUES
('Nike', 'contacto@nike.com', 'default.png'),
('Adidas', 'contacto@adidas.com', 'default.png'),
('Puma', 'contacto@puma.com', 'default.png'),
('Under Armour', 'contacto@underarmour.com', 'default.png'),
('Reebok', 'contacto@reebok.com', 'default.png'),
('New Balance', 'contacto@newbalance.com', 'default.png'),
('Mizuno', 'contacto@mizuno.com', 'default.png'),
('Asics', 'contacto@asics.com', 'default.png'),
('Joma', 'contacto@joma.com', 'default.png'),
('Kelme', 'contacto@kelme.com', 'default.png'),
('Umbro', 'contacto@umbro.com', 'default.png'),
('Lotto', 'contacto@lotto.com', 'default.png'),
('Diadora', 'contacto@diadora.com', 'default.png'),
('Kappa', 'contacto@kappa.com', 'default.png'),
('Hummel', 'contacto@hummel.com', 'default.png'),
('Le Coq Sportif', 'contacto@lecoqsportif.com', 'default.png'),
('Macron', 'contacto@macron.com', 'default.png'),
('Errea', 'contacto@errea.com', 'default.png'),
('Givova', 'contacto@givova.com', 'default.png'),
('Patrick', 'contacto@patrick.com', 'default.png');

-- Insertar registros en la tabla productos
INSERT INTO productos (nombre_producto, descripcion_producto, precio_producto, existencias_producto, imagen_producto, estado_producto, id_categoria, id_marca, id_empleado) VALUES
 ('Balón Nike Strike', 'Balón de fútbol Nike para entrenamiento', 29.99, 100, 'default.png', 1, 1, 1, 1),
 ('Camiseta Adidas Real Madrid', 'Camiseta oficial del Real Madrid temporada 2024', 89.99, 50, 'default.png', 1, 2, 2, 2),
 ('Zapatos Puma Future', 'Zapatos de fútbol Puma para terrenos blandos', 120.00, 75, 'default.png', 1, 3, 3, 3),
 ('Espinilleras Under Armour', 'Espinilleras ligeras y resistentes', 15.99, 200, 'default.png', 1, 4, 4, 4),
 ('Botella de agua Reebok', 'Botella deportiva de 750ml', 9.99, 150, 'default.png', 1, 5, 5, 5),
 ('Mochila New Balance', 'Mochila para equipamiento deportivo', 49.99, 80, 'default.png', 1, 6, 6, 6),
 ('Guantes de portero Mizuno', 'Guantes de portero de alta calidad', 70.00, 60, 'default.png', 1, 7, 7, 7),
 ('Chaleco de entrenamiento Asics', 'Chaleco diferenciador para entrenamientos', 12.99, 100, 'default.png', 1, 8, 8, 8),
 ('Silbato Joma', 'Silbato para árbitros y entrenadores', 4.99, 250, 'default.png', 1, 9, 9, 9),
 ('Tarjetas de árbitro Kelme', 'Juego de tarjetas roja y amarilla', 6.99, 200, 'default.png', 1, 10, 10, 10),
 ('Balón de playa Umbro', 'Balón específico para fútbol de playa', 24.99, 90, 'default.png', 1, 11, 11, 11),
 ('Conos de entrenamiento Lotto', 'Conos de entrenamiento de diferentes colores', 19.99, 300, 'default.png', 1, 12, 12, 12),
 ('Medias Diadora', 'Medias deportivas para fútbol', 7.99, 500, 'default.png', 1, 13, 13, 13),
 ('Zapatos Kappa', 'Zapatos de fútbol para terrenos firmes', 100.00, 120, 'default.png', 1, 14, 14, 14),
 ('Camiseta Hummel', 'Camiseta de entrenamiento', 29.99, 70, 'default.png', 1, 15, 15, 15),
 ('Guantes Le Coq Sportif', 'Guantes de entrenamiento', 19.99, 80, 'default.png', 1, 16, 16, 16),
 ('Balón Macron', 'Balón de fútbol para partidos', 34.99, 110, 'default.png', 1, 17, 17, 17),
 ('Espinilleras Errea', 'Espinilleras ergonómicas', 14.99, 130, 'default.png', 1, 18, 18, 18),
 ('Botella de agua Givova', 'Botella deportiva con boquilla', 8.99, 160, 'default.png', 1, 19, 19, 19),
 ('Chaleco de entrenamiento Patrick', 'Chaleco para entrenamientos', 13.99, 90, 'default.png', 1, 20, 20, 20);

-- Insertar registros en la tabla clientes
INSERT INTO clientes (nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, correo_cliente, clave_cliente, estado_cliente) VALUES
('Juan', 'Perez', 'Calle 1, Ciudad', '1234-5678', 'juan.perez@example.com', 'clave1', 1),
('Maria', 'Gomez', 'Calle 2, Ciudad', '2345-6789', 'maria.gomez@example.com', 'clave2', 1),
('Carlos', 'Lopez', 'Calle 3, Ciudad', '3456-7890', 'carlos.lopez@example.com', 'clave3', 1),
('Ana', 'Martinez', 'Calle 4, Ciudad', '4567-8901', 'ana.martinez@example.com', 'clave4', 1),
('Luis', 'Rodriguez', 'Calle 5, Ciudad', '5678-9012', 'luis.rodriguez@example.com', 'clave5', 1),
('Marta', 'Garcia', 'Calle 6, Ciudad', '6789-0123', 'marta.garcia@example.com', 'clave6', 1),
('Jose', 'Hernandez', 'Calle 7, Ciudad', '7890-1234', 'jose.hernandez@example.com', 'clave7', 1),
('Elena', 'Gonzalez', 'Calle 8, Ciudad', '8901-2345', 'elena.gonzalez@example.com', 'clave8', 1),
('Sergio', 'Ramirez', 'Calle 9, Ciudad', '9012-3456', 'sergio.ramirez@example.com', 'clave9', 1),
('Laura', 'Torres', 'Calle 10, Ciudad', '0123-4567', 'laura.torres@example.com', 'clave10', 1),
('Pedro', 'Sanchez', 'Calle 11, Ciudad', '1234-5678', 'pedro.sanchez@example.com', 'clave11', 1),
('Lucia', 'Vargas', 'Calle 12, Ciudad', '2345-6789', 'lucia.vargas@example.com', 'clave12', 1),
('Juan', 'Cruz', 'Calle 13, Ciudad', '3456-7890', 'juan.cruz@example.com', 'clave13', 1),
('Isabel', 'Ortiz', 'Calle 14, Ciudad', '4567-8901', 'isabel.ortiz@example.com', 'clave14', 1),
('David', 'Gutierrez', 'Calle 15, Ciudad', '5678-9012', 'david.gutierrez@example.com', 'clave15', 1),
('Valeria', 'Jimenez', 'Calle 16, Ciudad', '6789-0123', 'valeria.jimenez@example.com', 'clave16', 1),
('Jorge', 'Morales', 'Calle 17, Ciudad', '7890-1234', 'jorge.morales@example.com', 'clave17', 1),
('Paula', 'Ramos', 'Calle 18, Ciudad', '8901-2345', 'paula.ramos@example.com', 'clave18', 1),
('Andres', 'Reyes', 'Calle 19, Ciudad', '9012-3456', 'andres.reyes@example.com', 'clave19', 1),
('Natalia', 'Castro', 'Calle 20, Ciudad', '0123-4567', 'natalia.castro@example.com', 'clave20', 1);

-- Insertar registros en la tabla pedidos
INSERT INTO pedidos (direccion_pedido, estado_pedido, fecha_registro, id_cliente) VALUES
('Calle 1, Ciudad', 'Pendiente', '2024-01-01', 1),
('Calle 2, Ciudad', 'Pendiente', '2024-01-02', 2),
('Calle 3, Ciudad', 'Pendiente', '2024-01-03', 3),
('Calle 4, Ciudad', 'Pendiente', '2024-01-04', 4),
('Calle 5, Ciudad', 'Pendiente', '2024-01-05', 5),
('Calle 6, Ciudad', 'Pendiente', '2024-01-06', 6),
('Calle 7, Ciudad', 'Pendiente', '2024-01-07', 7),
('Calle 8, Ciudad', 'Pendiente', '2024-01-08', 8),
('Calle 9, Ciudad', 'Pendiente', '2024-01-09', 9),
('Calle 10, Ciudad', 'Pendiente', '2024-01-10', 10),
('Calle 11, Ciudad', 'Pendiente', '2024-01-11', 11),
('Calle 12, Ciudad', 'Pendiente', '2024-01-12', 12),
('Calle 13, Ciudad', 'Pendiente', '2024-01-13', 13),
('Calle 14, Ciudad', 'Pendiente', '2024-01-14', 14),
('Calle 15, Ciudad', 'Pendiente', '2024-01-15', 15),
('Calle 16, Ciudad', 'Pendiente', '2024-01-16', 16),
('Calle 17, Ciudad', 'Pendiente', '2024-01-17', 17),
('Calle 18, Ciudad', 'Pendiente', '2024-01-18', 18),
('Calle 19, Ciudad', 'Pendiente', '2024-01-19', 19),
('Calle 20, Ciudad', 'Pendiente', '2024-01-20', 20);

-- Insertar registros en la tabla detalle_pedidos
INSERT INTO detalle_pedidos (id_producto, cantidad_producto, precio_producto, id_pedido) VALUES
(1, 2, 29.99, 1),
(2, 1, 89.99, 2),
(3, 3, 120.00, 3),
(4, 4, 15.99, 4),
(5, 1, 9.99, 5),
(6, 2, 49.99, 6),
(7, 1, 70.00, 7),
(8, 3, 12.99, 8),
(9, 4, 4.99, 9),
(10, 2, 6.99, 10),
(11, 1, 24.99, 11),
(12, 3, 19.99, 12),
(13, 5, 7.99, 13),
(14, 2, 100.00, 14),
(15, 1, 29.99, 15),
(16, 2, 19.99, 16),
(17, 1, 34.99, 17),
(18, 3, 14.99, 18),
(19, 2, 8.99, 19),
(20, 1, 13.99, 20);

-- Insertar registros en la tabla comentarios
INSERT INTO comentarios (contenido_comentario, puntuacion_comentario, fecha_comentario, estado_comentario, id_detalle) VALUES
('Excelente producto, muy satisfecho', 5, '2024-01-01', 1, 1),
('Buena calidad, recomendado', 4, '2024-01-02', 1, 2),
('Regular, esperaba más', 3, '2024-01-03', 1, 3),
('Muy malo, no lo recomiendo', 1, '2024-01-04', 1, 4),
('Cumple con lo prometido', 4, '2024-01-05', 1, 5),
('Gran calidad, volveré a comprar', 5, '2024-01-06', 1, 6),
('No me gustó', 2, '2024-01-07', 1, 7),
('Perfecto para lo que necesitaba', 5, '2024-01-08', 1, 8),
('Está bien, sin más', 3, '2024-01-09', 1, 9),
('Muy buen producto', 4, '2024-01-10', 1, 10),
('Excelente servicio y calidad', 5, '2024-01-11', 1, 11),
('Podría ser mejor', 3, '2024-01-12', 1, 12),
('No lo recomiendo', 1, '2024-01-13', 1, 13),
('Muy buena compra', 5, '2024-01-14', 1, 14),
('Recomendado al 100%', 5, '2024-01-15', 1, 15),
('No volveré a comprar', 1, '2024-01-16', 1, 16),
('Producto aceptable', 3, '2024-01-17', 1, 17),
('Gran calidad y precio', 5, '2024-01-18', 1, 18),
('Está bien, podría mejorar', 3, '2024-01-19', 1, 19),
('Perfecto para mi uso', 4, '2024-01-20', 1, 20);