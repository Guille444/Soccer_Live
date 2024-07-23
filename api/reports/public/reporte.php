<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;

// Se incluyen las clases para la transferencia y acceso a datos.
require_once('../../models/data/pedidos_data.php');

// Se instancia la entidad correspondiente.
$pedido = new PedidoData;

// Se establece el valor del ID del pedido, de lo contrario se muestra un mensaje.
if (isset($_GET['idPedido']) && $pedido->setId($_GET['idPedido'])) {
    // Se verifica si el pedido existe, de lo contrario se muestra un mensaje.
    if ($rowOne = $pedido->readOne()) {
        // Se inicia el reporte con el encabezado del documento.
        $pdf->startReport('Reporte de compra');

        // Encabezado del reporte con texto blanco y sin fondo
        $pdf->setFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->setFillColor(255, 255, 255); // Sin color de fondo para encabezados
        $pdf->cell(0, 10, 'A nombre de: ' . $pdf->encodeString($rowOne['cliente']), 0, 1, 'C', false);
        $pdf->cell(0, 10, 'Fecha en que se hizo: ' . $rowOne['fecha'], 0, 1, 'C', false);
        $pdf->ln(12);

        // Ajustar los márgenes a 1.5 cm
        $pdf->setMargins(15, 0, 15);

        // Se verifica si existen registros para mostrar, de lo contrario se imprime un mensaje.
        if ($dataP = $pedido->readFactura()) {
            // Encabezados del detalle del pedido
            $pdf->setFillColor(8, 31, 73); // Color de fondo de los encabezados
            $pdf->setDrawColor(255, 255, 255); // Color del borde
            $pdf->SetTextColor(255, 255, 255); // Color del texto
            $pdf->setFont('Arial', 'B', 11);
            $pdf->cell(78.24, 10, 'Producto', 1, 0, 'C', 1);
            $pdf->cell(39.12, 10, 'Marca', 1, 0, 'C', 1);
            $pdf->cell(29.34, 10, utf8_decode('Categoría'), 1, 0, 'C', 1);
            $pdf->cell(39.12, 10, 'Cantidad', 1, 1, 'C', 1);

            // Restablecer el color del texto a negro para los datos
            $pdf->SetTextColor(0, 0, 0);
            // Se establece la fuente para los datos de los productos.
            $pdf->setFont('Arial', '', 11);
            // Alternar el color de fondo entre gris claro y blanco para las filas de datos
            $fill = false;
            $total = 0;
            // Se recorren los registros fila por fila.
            foreach ($dataP as $rowP) {
                // Calcula el subtotal para cada producto
                $subtotal = $rowP['cantidad_producto'] * $rowP['precio_producto'];
                // Suma el subtotal al total
                $total += $subtotal;
                // Se alterna el color de fondo entre gris claro y blanco
                $pdf->setFillColor($fill ? 224 : 255, $fill ? 224 : 255, $fill ? 224 : 255); // Gris claro para fondo
                // Se imprimen las celdas con los datos de los productos.
                $pdf->cell(78.24, 10, $pdf->encodeString($rowP['nombre_producto']), 1, 0, 'C', $fill);
                $pdf->cell(39.12, 10, $pdf->encodeString($rowP['nombre_marca']), 1, 0, 'C', $fill);
                $pdf->cell(29.34, 10, $pdf->encodeString($rowP['nombre_categoria']), 1, 0, 'C', $fill);
                $pdf->cell(39.12, 10, $pdf->encodeString($rowP['cantidad_producto']), 1, 1, 'C', $fill);
                $fill = !$fill; // Alternar color para la siguiente fila
            }
            // Establecer color de fondo y texto para la fila del total
            $pdf->setFillColor(8, 31, 73); // Color de fondo para total
            $pdf->SetTextColor(255, 255, 255); // Color del texto para total
            // Establecer fuente en negrita para el total
            $pdf->setFont('Arial', 'B', 11);
            // Se imprime una línea separadora para el total
            $pdf->cell(146.7, 10, 'Total', 1, 0, 'R', 1);
            // Se imprime el total
            $pdf->cell(39.12, 10, number_format($total, 2), 1, 1, 'C', 1);
        } else {
            $pdf->cell(0, 10, 'No ha realizado pedidos', 1, 1);
        }
        // Se llama implícitamente al método footer() y se envía el documento al navegador web.
        $pdf->output('I', 'factura.pdf');
    } else {
        print('Pedido inexistente');
    }
} else {
    print('Pedido incorrecto');
}
?>