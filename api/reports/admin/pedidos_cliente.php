<?php
// Se incluye la clase con las plantillas para generar reportes.
require('../../helpers/report.php');
// Se incluyen las clases para la transferencia y acceso a datos.
require('../../models/handler/pedidos_handler.php');

// Creamos el objeto del reporte.
$pdf = new Report;
// Iniciamos el reporte con el encabezado.
$pdf->startReport('Listado de Pedidos por Cliente');

// Creamos el objeto del modelo.
$pedidos = new PedidoHandler;

// Verificamos si existen registros para mostrar.
if ($dataPedidos = $pedidos->pedidosPorCliente()) {
    // Establecer color de fondo del encabezado a #081F49
    $pdf->setFillColor(8, 31, 73);
    // Establecer color de los bordes de la tabla a blanco
    $pdf->setDrawColor(255, 255, 255);
    // Establecer color del texto a blanco
    $pdf->SetTextColor(255, 255, 255);
    // Establecemos las fuentes para los encabezados.
    $pdf->SetFont('Arial', 'B', 11);
    // Definir la posición inicial X para centrar la tabla (ancho total de la tabla es 170)
    $pdf->SetX(20);
    // Imprimimos las celdas del encabezado.
    $pdf->Cell(50, 10, 'Cliente', 1, 0, 'C', 1);
    $pdf->Cell(60, 10, utf8_decode('Dirección Pedido'), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'Estado', 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'Fecha', 1, 1, 'C', 1);
    // Restablecer el color del texto a negro para los datos
    $pdf->SetTextColor(0, 0, 0);
    // Establecemos las fuentes para los datos.
    $pdf->SetFont('Arial', '', 10);
    // Recorremos los registros fila por fila.
    foreach ($dataPedidos as $rowPedido) {
        // Establecer color de fondo gris claro para las filas de datos
        $pdf->setFillColor(224, 224, 224);
        // Definir la posición inicial X para centrar la tabla
        $pdf->SetX(20);
        // Imprimimos las celdas con los datos.
        $pdf->Cell(50, 10, $pdf->encodeString($rowPedido['apellido_cliente'] . ', ' . $rowPedido['nombre_cliente']), 1, 0, 'C', 1);
        $pdf->Cell(60, 10, $pdf->encodeString($rowPedido['direccion_pedido']), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, $pdf->encodeString($rowPedido['estado_pedido']), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, $rowPedido['fecha_registro'], 1, 1, 'C', 1);
    }
} else {
    $pdf->Cell(0, 10, 'No hay pedidos disponibles', 1, 1);
}
// Salida del documento.
$pdf->Output();
?>
