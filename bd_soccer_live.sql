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
existencias_producto VARCHAR(30) NOT NULL,
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
cantidad_producto VARCHAR(30) NOT NULL,
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
descripcion_comentario VARCHAR(250) NOT NULL,
fecha_comentario DATE DEFAULT current_timestamp(),
estado_comentario BOOLEAN NOT NULL,
id_cliente INT NOT NULL,
CONSTRAINT fk_valoracion_cliente
FOREIGN KEY (id_cliente)
REFERENCES clientes (id_cliente),
id_producto INT NOT NULL,
CONSTRAINT fk_valoracion_producto
FOREIGN KEY (id_producto)
REFERENCES productos (id_producto)
);

DESCRIBE comentarios;

INSERT INTO comentarios (descripcion_comentario, fecha_comentario, estado_comentario, id_cliente, id_producto) VALUES
('El balón tiene buen agarre, ideal para partidos.', '2024-01-15', TRUE, 1, 1),
('Los guantes ofrecen excelente protección.', '2024-02-10', TRUE, 1, 1),
('La botella se rompió fácilmente, no la recomiendo.', '2024-03-05', FALSE, 1, 1),
('Las zapatillas son muy cómodas para correr.', '2024-04-20', TRUE, 1, 1),
('El balón perdió aire rápido, muy decepcionado.', '2024-05-01', FALSE, 1, 1),
('Muy satisfecho con los guantes, buena calidad.', '2024-05-10', TRUE, 1, 1),
('La botella mantiene el agua fría por horas.', '2024-05-15', TRUE, 1, 1),
('Las zapatillas son más pequeñas de lo esperado.', '2024-05-17', FALSE, 1, 1),
('El balón es resistente, perfecto para entrenar.', '2024-05-18', TRUE, 1, 1),
('Los guantes se desgastaron rápido, no los recomiendo.', '2024-05-19', FALSE, 1, 1);


INSERT INTO pedidos (direccion_pedido, estado_pedido, id_cliente) VALUES
('123 Calle Principal', 'Pendiente', 1),
('456 Avenida Secundaria', 'Finalizado', 2),
('789 Boulevard Central', 'Entregado', 3),
('101 Calle Norte', 'Pendiente', 4),
('102 Calle Sur', 'Finalizado', 5),
('103 Avenida Este', 'Pendiente', 1),
('104 Avenida Oeste', 'Entregado', 2),
('105 Plaza Central', 'Finalizado', 3),
('106 Boulevard Norte', 'Pendiente', 4),
('107 Calle Secundaria', 'Entregado', 5);

INSERT INTO clientes (nombre_cliente, apellido_cliente, direccion_cliente, telefono_cliente, correo_cliente, clave_cliente, estado_cliente) VALUES
('Juan', 'Pérez', '123 Calle Principal', '6123-5678', 'juan.perez@example.com', SHA2('password1', 256), 1),
('María', 'González', '456 Avenida Secundaria', '7765-4321', 'maria.gonzalez@example.com', SHA2('password2', 256), 1),
('Carlos', 'López', '789 Boulevard Central', '7122-3344', 'carlos.lopez@example.com', SHA2('password3', 256), 0),
('Ana', 'Martínez', '101 Calle Norte', '7233-4455', 'ana.martinez@example.com', SHA2('password4', 256), 1),
('Luis', 'Rodríguez', '102 Calle Sur', '6344-5566', 'luis.rodriguez@example.com', SHA2('password5', 256), 1),
('Elena', 'García', '103 Avenida Este', '6455-6677', 'elena.garcia@example.com', SHA2('password6', 256), 0),
('Pedro', 'Fernández', '104 Avenida Oeste', '7566-7788', 'pedro.fernandez@example.com', SHA2('password7', 256), 1),
('Lucía', 'Sánchez', '105 Plaza Central', '6677-8899', 'lucia.sanchez@example.com', SHA2('password8', 256), 0),
('Miguel', 'Ramírez', '106 Boulevard Norte', '7788-9900', 'miguel.ramirez@example.com', SHA2('password9', 256), 1),
('Laura', 'Torres', '107 Calle Secundaria', '6899-0011', 'laura.torres@example.com', SHA2('password10', 256), 1);

SHOW TABLES;

SELECT * FROM productos;
SELECT * FROM categorias;
SELECT * FROM marcas;
SELECT * FROM empleados;
SELECT * FROM clientes;
SELECT * FROM pedidos;
SELECT * FROM comentarios; 

