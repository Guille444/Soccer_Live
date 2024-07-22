<?php
// Se incluye la clase con las plantillas para generar reportes.
require('../../helpers/report.php');
// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se verifica si existe un valor para la categoría, de lo contrario se muestra un mensaje.
if (isset($_GET['idCategoria'])) {
    // Se incluyen las clases para la transferencia y acceso a datos.
    require_once('../../models/data/categorias_data.php');
    require_once('../../models/data/productos_data.php');
    // Se instancian las entidades correspondientes.
    $categoria = new CategoriaData;
    $producto = new ProductoData;
    // Se establece el valor de la categoría, de lo contrario se muestra un mensaje.
    if ($categoria->setId($_GET['idCategoria']) && $producto->setCategoria($_GET['idCategoria'])) {
        // Se verifica si la categoría existe, de lo contrario se muestra un mensaje.
        if ($rowCategoria = $categoria->readOne()) {
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Productos de la categoría: ' . $rowCategoria['nombre_categoria']);
            // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
            if ($dataProductos = $producto->productosCategoria()) {
                // Establecer color de fondo del encabezado a #081F49
                $pdf->setFillColor(8, 31, 73);
                // Establecer color de los bordes de la tabla a blanco
                $pdf->setDrawColor(255, 255, 255);
                // Establecer color del texto a blanco
                $pdf->SetTextColor(255, 255, 255);
                // Se establece la fuente para los encabezados.
                $pdf->setFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->cell(126, 10, 'Nombre', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'Precio (US$)', 1, 0, 'C', 1);
                $pdf->cell(30, 10, 'Estado', 1, 1, 'C', 1);
                // Restablecer el color del texto a negro para los datos
                $pdf->SetTextColor(0, 0, 0);
                // Se establece la fuente para los datos de los productos.
                $pdf->setFont('Arial', '', 11);
                // Establecer color de fondo gris claro para las filas de datos
                $pdf->setFillColor(224, 224, 224);
                // Se recorren los registros fila por fila.
                foreach ($dataProductos as $rowProducto) {
                    ($rowProducto['estado_producto']) ? $estado = 'Activo' : $estado = 'Inactivo';
                    // Se imprimen las celdas con los datos de los productos, centrando el contenido.
                    $pdf->cell(126, 10, $pdf->encodeString($rowProducto['nombre_producto']), 1, 0, 'C', 1);
                    $pdf->cell(30, 10, $rowProducto['precio_producto'], 1, 0, 'C', 1);
                    $pdf->cell(30, 10, $estado, 1, 1, 'C', 1);
                }
            } else {
                $pdf->cell(0, 10, $pdf->encodeString('No hay productos para la categoría'), 1, 1, 'C');
            }
            // Se llama implícitamente al método footer() y se envía el documento al navegador web.
            $pdf->output('I', 'categorias.pdf');
        } else {
            print('Categoría inexistente');
        }
    } else {
        print('Categoría incorrecta');
    }
} else {
    print('Debe seleccionar una categoría');
}
?>
