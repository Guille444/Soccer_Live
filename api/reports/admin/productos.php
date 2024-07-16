<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');
// Se incluyen las clases para la transferencia y acceso a datos.
require_once('../../models/data/productos_data.php');
require_once('../../models/data/categorias_data.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Productos por categoría');
// Se instancia el módelo Categoría para obtener los datos.
$categoria = new CategoriaData;

// Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
if ($dataCategorias = $categoria->readAll()) {
    // Establecer color de fondo del encabezado a #081F49
    $pdf->setFillColor(8, 31, 73);
    // Establecer color de los bordes de la tabla a blanco
    $pdf->setDrawColor(255, 255, 255);
    // Establecer color del texto del encabezado a blanco
    $pdf->setTextColor(255, 255, 255);
    // Establecer la fuente para los encabezados
    $pdf->setFont('Arial', 'B', 11);
    // Imprimir las celdas con los encabezados
    $pdf->cell(126, 10, 'Nombre', 1, 0, 'C', 1);
    $pdf->cell(30, 10, 'Precio (US$)', 1, 0, 'C', 1);
    $pdf->cell(30, 10, 'Estado', 1, 1, 'C', 1);

    // Recorrer los registros fila por fila
    foreach ($dataCategorias as $rowCategoria) {
        // Establecer color de fondo para el nombre de la categoría a blanco
        $pdf->setFillColor(255);
        // Restablecer el color del texto a negro para el nombre de la categoría
        $pdf->setTextColor(0, 0, 0);
        // Imprimir una celda con el nombre de la categoría
        $pdf->cell(0, 10, $pdf->encodeString('Categoría: ' . $rowCategoria['nombre_categoria']), 1, 1, 'C', 1);
        
        // Instanciar el módelo Producto para procesar los datos
        $producto = new ProductoData;
        // Establecer la categoría para obtener sus productos, de lo contrario imprimir un mensaje de error
        if ($producto->setCategoria($rowCategoria['id_categoria'])) {
            // Verificar si existen registros para mostrar, de lo contrario imprimir un mensaje
            if ($dataProductos = $producto->productosCategoria()) {
                // Establecer color de fondo para las filas de productos a gris claro
                $pdf->setFillColor(224, 224, 224);
                // Recorrer los registros fila por fila
                foreach ($dataProductos as $rowProducto) {
                    ($rowProducto['estado_producto']) ? $estado = 'Activo' : $estado = 'Inactivo';
                    // Imprimir las celdas con los datos de los productos
                    $pdf->cell(126, 10, $pdf->encodeString($rowProducto['nombre_producto']), 1, 0, 'C', 1);
                    $pdf->cell(30, 10, $rowProducto['precio_producto'], 1, 0, 'C', 1);
                    $pdf->cell(30, 10, $estado, 1, 1, 'C', 1);
                }
            } else {
                $pdf->cell(0, 10, $pdf->encodeString('No hay productos para la categoría'), 1, 1);
            }
        } else {
            $pdf->cell(0, 10, $pdf->encodeString('Categoría incorrecta o inexistente'), 1, 1);
        }
    }
} else {
    $pdf->cell(0, 10, $pdf->encodeString('No hay categorías para mostrar'), 1, 1);
}
// Se llama implícitamente al método footer() y se envía el documento al navegador web.
$pdf->output('I', 'productos.pdf');