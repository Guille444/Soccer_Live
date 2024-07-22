<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');
// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se incluyen las clases para la transferencia y acceso a datos.
require_once('../../models/data/productos_data.php');
// Se instancia la entidad correspondiente.
$producto = new ProductoData;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Listado de Productos');

// Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
if ($dataProductos = $producto->readAll2()) {
    // Establecer color de fondo del encabezado a #081F49
    $pdf->setFillColor(8, 31, 73);
    // Establecer color de los bordes de la tabla a blanco
    $pdf->setDrawColor(255, 255, 255);
    // Establecer color del texto a blanco
    $pdf->SetTextColor(255, 255, 255);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Arial', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(45, 10, 'Nombre', 1, 0, 'C', 1);
    $pdf->cell(65, 10, utf8_decode('Descripción'), 1, 0, 'C', 1);
    $pdf->cell(25, 10, 'Precio (US$)', 1, 0, 'C', 1);
    $pdf->cell(25, 10, 'Existencias', 1, 0, 'C', 1);
    $pdf->cell(30, 10, 'Estado', 1, 1, 'C', 1);
    // Restablecer el color del texto a negro para los datos
    $pdf->SetTextColor(0, 0, 0);
    // Se establece la fuente para los datos de los productos.
    $pdf->setFont('Arial', '', 11);

    // Establecer color de fondo gris claro para todas las filas de datos
    $pdf->setFillColor(224, 224, 224); // Gris claro

    // Se recorren los registros fila por fila.
    foreach ($dataProductos as $rowProducto) {
        ($rowProducto['estado_producto']) ? $estado = 'Activo' : $estado = 'Inactivo';
        // Se imprimen las celdas con los datos de los productos, centrando el contenido.
        $pdf->cell(45, 10, $pdf->encodeString($rowProducto['nombre_producto']), 1, 0, 'C', 1);
        $pdf->cell(65, 10, $pdf->encodeString($rowProducto['descripcion_producto']), 1, 0, 'C', 1);
        $pdf->cell(25, 10, $rowProducto['precio_producto'], 1, 0, 'C', 1);
        $pdf->cell(25, 10, $rowProducto['existencias_producto'], 1, 0, 'C', 1);
        $pdf->cell(30, 10, $estado, 1, 1, 'C', 1);
    }
} else {
    $pdf->cell(0, 10, $pdf->encodeString('No hay productos registrados'), 1, 1, 'C');
}

// Se llama implícitamente al método footer() y se envía el documento al navegador web.
$pdf->output('I', 'productos.pdf');
?>
