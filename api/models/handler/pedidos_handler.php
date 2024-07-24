<?php
// Se incluye la clase para trabajar con la base de datos.
require_once ('../../helpers/database.php');
/*
 *	Clase para manejar el comportamiento de los datos de las tablas PEDIDO y DETALLE_PEDIDO.
 */
class PedidoHandler
{
    /*
     *   Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $id_pedido = null;
    protected $id_detalle = null;
    protected $cliente = null;
    protected $producto = null;
    protected $cantidad = null;
    protected $estado = null;

    /*
     *   ESTADOS DEL PEDIDO
     *   Pendiente (valor por defecto en la base de datos). Pedido en proceso y se puede modificar el detalle.
     *   Finalizado. Pedido terminado por el cliente y ya no es posible modificar el detalle.
     *   Entregado. Pedido enviado al cliente.
     *   Anulado. Pedido cancelado por el cliente después de ser finalizado.
     */

    /*
     *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    // Método para verificar si existe un pedido en proceso con el fin de iniciar o continuar una compra.
    public function getOrder()
    {
        $this->estado = 'Pendiente';
        $sql = 'SELECT id_pedido
                    FROM pedidos
                    WHERE estado_pedido = ? AND id_cliente = ?';
        $params = array($this->estado, $_SESSION['idCliente']);
        if ($data = Database::getRow($sql, $params)) {
            $_SESSION['idPedido'] = $data['id_pedido'];
            return true;
        } else {
            return false;
        }
    }

    // Método para iniciar un pedido en proceso.
    public function startOrder()
    {
        if ($this->getOrder()) {
            return true;
        } else {
            $sql = 'INSERT INTO pedidos(direccion_pedido, id_cliente)
                        VALUES((SELECT direccion_cliente FROM clientes WHERE id_cliente = ?), ?)';
            $params = array($_SESSION['idCliente'], $_SESSION['idCliente']);
            // Se obtiene el ultimo valor insertado de la llave primaria en la tabla pedido.
            if ($_SESSION['idPedido'] = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Método para agregar un producto al carrito de compras.
    public function createDetail()
    {
        // Se realiza una subconsulta para obtener el precio del producto.
        $sql = 'INSERT INTO detalle_pedidos(id_producto, precio_producto, cantidad_producto, id_pedido)
                    VALUES(?, (SELECT precio_producto FROM productos WHERE id_producto = ?), ?, ?)';
        $params = array($this->producto, $this->producto, $this->cantidad, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    // Método para obtener los productos que se encuentran en el carrito de compras.
    public function readDetail()
    {
        $sql = 'SELECT id_detalle, nombre_producto, detalle_pedidos.precio_producto, detalle_pedidos.cantidad_producto
                    FROM detalle_pedidos
                    INNER JOIN pedidos USING(id_pedido)
                    INNER JOIN productos USING(id_producto)
                    WHERE id_pedido = ?';
        $params = array($_SESSION['idPedido']);
        return Database::getRows($sql, $params);
    }

    // Método para finalizar un pedido por parte del cliente.
    public function finishOrder()
    {
        $this->estado = 'Finalizado';
        $sql = 'UPDATE pedidos
                    SET estado_pedido = ?
                    WHERE id_pedido = ?';
        $params = array($this->estado, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    // Método para actualizar la cantidad de un producto agregado al carrito de compras.
    public function updateDetail()
    {
        $sql = 'UPDATE detalle_pedidos
                    SET cantidad_producto = ?
                    WHERE id_detalle = ? AND id_pedido = ?';
        $params = array($this->cantidad, $this->id_detalle, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    // Método para eliminar un producto que se encuentra en el carrito de compras.
    public function deleteDetail()
    {
        $sql = 'DELETE FROM detalle_pedidos
                    WHERE id_detalle = ? AND id_pedido = ?';
        $params = array($this->id_detalle, $_SESSION['idPedido']);
        return Database::executeRow($sql, $params);
    }

    /*
     *   Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%';
        $sql = 'SELECT p.id_pedido,CONCAT(c.nombre_cliente," ",c.apellido_cliente) as cliente,
                    DATE_FORMAT(p.fecha_registro, "%d-%m-%Y") AS fecha, p.estado_pedido, p.direccion_pedido
                    FROM pedidos p
                    INNER JOIN clientes c USING(id_cliente)
                    WHERE nombre_cliente LIKE ?
                    ORDER BY direccion_pedido';
        $params = array($value);
        return Database::getRows($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE pedidos 
                    SET estado_pedido = ?
                    WHERE id_pedido = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT p.id_pedido,CONCAT(c.nombre_cliente," ",c.apellido_cliente) as cliente,
            DATE_FORMAT(p.fecha_registro, "%d-%m-%Y") AS fecha, p.estado_pedido, p.direccion_pedido
            FROM pedidos p
            INNER JOIN clientes c USING(id_cliente)
            ORDER BY p.fecha_registro DESC, p.estado_pedido DESC';
        return Database::getRows($sql);
    }

    public function readOne()
    {
        $sql = 'SELECT p.id_pedido,CONCAT(c.nombre_cliente," ",c.apellido_cliente) as cliente, telefono_cliente,
            DATE_FORMAT(p.fecha_registro, "%d-%m-%Y") AS fecha,p.estado_pedido, p.direccion_pedido
            from pedidos p
            inner join clientes c USING(id_cliente)
            WHERE p.id_pedido = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        //$_SESSION['idmod'] = $data['id_modelo'];

        return $data;
    }

    public function getPopularBrands($limit = 5)
    {
        $sql = 'SELECT m.id, m.nombre_marca, COUNT(p.id_producto) AS cantidad_productos
                FROM marca m
    LEFT JOIN producto p ON m.id = p.id_marca
    GROUP BY m.id, m.nombre_marca
                ORDER BY cantidad_productos DESC
                LIMIT ?';
        $params = array($limit);
        return Database::getRows($sql, $params);
    }


    /*
     *   Métodos para generar gráficos.
     */

    // Método para obtener la cantidad de pedidos en diferentes estados.

    public function CantidadEstadoPedidos()
    {
        // Obtener la cantidad de pedidos en diferentes estados
        $sql = 'SELECT estado_pedido, COUNT(id_detalle) cantidad
                    FROM detalle_pedidos
                    INNER JOIN pedidos USING(id_pedido)
                    GROUP BY estado_pedido ORDER BY cantidad DESC LIMIT 5';
        return Database::getRows($sql);
    }

    // Método para calcular el porcentaje de pedidos en diferentes estados.

    public function PorcentajeEstadoPedidos()
    {
        $sql = 'SELECT estado_pedido, ROUND((COUNT(id_detalle) * 100.0 / (SELECT COUNT(id_detalle) FROM detalle_pedidos)), 2) porcentaje
            FROM detalle_pedidos
            INNER JOIN pedidos USING(id_pedido)
            GROUP BY estado_pedido ORDER BY porcentaje DESC';
        return Database::getRows($sql);
    }

    // Método para predecir las ganancias futuras basado en ventas mensuales.

    public function prediccionGanancia()
    {
        // Realizar una predicción de ganancias futuras basada en ventas mensuales
        $sql = "WITH ventas AS (
                SELECT 
                    DATE_FORMAT(p.fecha_registro, '%Y-%m') AS mes, 
                    ROUND(SUM(dp.cantidad_producto * dp.precio_producto), 2) AS ventas_mensuales,
                    CASE
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '01' THEN 'Enero'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '02' THEN 'Febrero'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '03' THEN 'Marzo'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '04' THEN 'Abril'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '05' THEN 'Mayo'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '06' THEN 'Junio'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '07' THEN 'Julio'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '08' THEN 'Agosto'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '09' THEN 'Septiembre'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '10' THEN 'Octubre'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '11' THEN 'Noviembre'
                        WHEN DATE_FORMAT(p.fecha_registro, '%m') = '12' THEN 'Diciembre'
                    END AS nombre_mes,
                    ROW_NUMBER() OVER (ORDER BY DATE_FORMAT(p.fecha_registro, '%Y-%m')) AS mes_indice
                FROM pedidos p
                JOIN detalle_pedidos dp ON p.id_pedido = dp.id_pedido
                WHERE p.estado_pedido = 'Finalizado'
                GROUP BY DATE_FORMAT(p.fecha_registro, '%Y-%m')
                ORDER BY DATE_FORMAT(p.fecha_registro, '%Y-%m') DESC
                LIMIT 6 -- Cambia este valor según la cantidad de meses que desees mostrar
            ),
            coeficientes AS (
                SELECT 
                    COUNT(*) AS n,
                    SUM(mes_indice) AS sum_x,
                    SUM(ventas_mensuales) AS sum_y,
                    SUM(mes_indice * ventas_mensuales) AS sum_xy,
                    SUM(mes_indice * mes_indice) AS sum_xx
                FROM ventas
            ),
            calculos AS (
                SELECT 
                    (n * sum_xy - sum_x * sum_y) / (n * sum_xx - sum_x * sum_x) AS slope,
                    (sum_y - ((n * sum_xy - sum_x * sum_y) / (n * sum_xx - sum_x * sum_x)) * sum_x) / n AS intercept
                FROM coeficientes
            ),
            prediccion AS (
                SELECT 
                    ROUND(c.slope * (MAX(v.mes_indice) + 1) + c.intercept, 2) AS prediccion_siguiente_mes,
                    CASE
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '01' THEN 'Enero'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '02' THEN 'Febrero'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '03' THEN 'Marzo'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '04' THEN 'Abril'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '05' THEN 'Mayo'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '06' THEN 'Junio'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '07' THEN 'Julio'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '08' THEN 'Agosto'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '09' THEN 'Septiembre'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '10' THEN 'Octubre'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '11' THEN 'Noviembre'
                        WHEN DATE_FORMAT(ADDDATE(MAX(p.fecha_registro), INTERVAL 1 MONTH), '%m') = '12' THEN 'Diciembre'
                    END AS nombre_siguiente_mes
                FROM ventas v
                JOIN pedidos p ON DATE_FORMAT(p.fecha_registro, '%Y-%m') = v.mes
                CROSS JOIN calculos c
            )
            SELECT 
                v.mes, 
                v.ventas_mensuales,
                v.nombre_mes,
                p.prediccion_siguiente_mes,
                p.nombre_siguiente_mes
            FROM ventas v
            CROSS JOIN prediccion p
            ORDER BY v.mes ASC;";

        $params = array();
        return Database::getRows($sql, $params);
    }


    // Método para obtener pedidos por cliente.
    public function pedidosPorCliente()
    {
        $sql = 'SELECT clientes.nombre_cliente, clientes.apellido_cliente, pedidos.direccion_pedido, 
                       pedidos.estado_pedido, pedidos.fecha_registro
                FROM pedidos
                INNER JOIN clientes ON pedidos.id_cliente = clientes.id_cliente
                ORDER BY clientes.apellido_cliente, clientes.nombre_cliente, pedidos.fecha_registro';
        return Database::getRows($sql);
    }

    // Método para obtener la información de un pedido específico por su ID
    public function obtenerPedidoPorId($id_pedido)
    {
        $sql = 'SELECT p.id_pedido, p.direccion_pedido, p.estado_pedido, p.fecha_registro,
                       c.nombre_cliente, c.apellido_cliente, c.correo_cliente, c.telefono_cliente
                FROM pedidos p
                INNER JOIN clientes c ON p.id_cliente = c.id_cliente
                WHERE p.id_pedido = ?';
        $params = array($id_pedido);
        return Database::getRow($sql, $params);
    }

    // Método para obtener el detalle de un pedido específico por su ID
    public function obtenerDetallePedido($id_pedido)
    {
        $sql = 'SELECT dp.id_detalle, pr.nombre_producto, dp.cantidad_producto, dp.precio_producto
                FROM detalle_pedidos dp
                INNER JOIN productos pr ON dp.id_producto = pr.id_producto
                WHERE dp.id_pedido = ?';
        $params = array($id_pedido);
        return Database::getRows($sql, $params);
    }

    // Método para obtener la factura de un pedido específico por su ID.

    public function readFactura()
    {
        // Obtener la factura detallada de un pedido específico por su ID
        $sql = 'SELECT dp.id_detalle,
                p.nombre_producto, m.nombre_marca, c.nombre_categoria,
                dp.cantidad_producto, DATE_FORMAT(pe.fecha_registro, "%h:%i %p - %e %b %Y") AS fecha,
                CONCAT(cl.nombre_cliente, " ", cl.apellido_cliente) AS nombre_completo,
                p.precio_producto
                FROM detalle_pedidos dp
                INNER JOIN productos p ON dp.id_producto = p.id_producto
                INNER JOIN pedidos pe ON dp.id_pedido = pe.id_pedido
                INNER JOIN marcas m ON p.id_marca = m.id_marca
                INNER JOIN categorias c ON p.id_categoria = c.id_categoria
                INNER JOIN clientes cl ON pe.id_cliente = cl.id_cliente
                WHERE dp.id_pedido = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }


    public function CantidadFechaPedidos()
    {
        $sql = 'SELECT fecha_registro, COUNT(id_detalle) cantidad
                    FROM detalle_pedidos
                    INNER JOIN pedidos USING(id_pedido)
                    GROUP BY fecha_registro ORDER BY cantidad DESC LIMIT 5';
        return Database::getRows($sql);
    }

    // Método para calcular el porcentaje de pedidos por fecha de registro.

    public function PorcentajeFechaPedidos()
    {
        $sql = 'SELECT fecha_registro, COUNT(id_pedido) porcentaje
            FROM detalle_pedidos
            INNER JOIN pedidos USING(id_pedido)
            GROUP BY fecha_registro ORDER BY porcentaje DESC LIMIT 5';
        return Database::getRows($sql);
    }
}
