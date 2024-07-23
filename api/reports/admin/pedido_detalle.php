<?php
// Se incluye la clase con las plantillas para generar reportes.
require('../../helpers/report.php');
// Se incluyen las clases para la transferencia y acceso a datos.
require('../../models/handler/pedidos_handler.php');

// Verificamos si se ha proporcionado el ID del pedido.
if (isset($_GET['id_pedido'])) {
    $id_pedido = $_GET['id_pedido'];
    // Creamos el objeto del reporte.
    $pdf = new Report;
    // Iniciamos el reporte con el encabezado.
    $pdf->startReport('Detalle de Pedido');
    // Creamos el objeto del modelo.
    $pedidos = new PedidoHandler;
    // Obtenemos la información del pedido.
    if ($dataPedido = $pedidos->obtenerPedidoPorId($id_pedido)) {
        // Establecer color de fondo del encabezado a #081F49
        $pdf->setFillColor(8, 31, 73);
        // Establecer color de los bordes de la tabla a blanco
        $pdf->setDrawColor(255, 255, 255);
        // Establecer color del texto a blanco
        $pdf->SetTextColor(255, 255, 255);
        // Establecemos las fuentes para los encabezados.
        $pdf->SetFont('Arial', 'B', 11);
        // Información del cliente
        $pdf->Cell(0, 10, utf8_decode('Información del Cliente'), 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 10);
        // Establecer color de fondo gris claro para las filas de datos
        $pdf->setFillColor(224, 224, 224);
        $pdf->Cell(40, 10, 'Nombre', 1, 0, 'C', 1);
        $pdf->Cell(0, 10, $pdf->encodeString($dataPedido['nombre_cliente'] . ' ' . $dataPedido['apellido_cliente']), 1, 1, 'C', 1);
        $pdf->Cell(40, 10, 'Correo', 1, 0, 'C', 1);
        $pdf->Cell(0, 10, $pdf->encodeString($dataPedido['correo_cliente']), 1, 1, 'C', 1);
        $pdf->Cell(40, 10, 'Telefono', 1, 0, 'C', 1);
        $pdf->Cell(0, 10, $pdf->encodeString($dataPedido['telefono_cliente']), 1, 1, 'C', 1);
        // Información del pedido
        $pdf->Ln(10); // Espacio entre secciones
        $pdf->setFillColor(8, 31, 73);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 10, utf8_decode('Información del Pedido'), 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->setFillColor(224, 224, 224);
        $pdf->Cell(40, 10, utf8_decode('Dirección'), 1, 0, 'C', 1);
        $pdf->Cell(0, 10, $pdf->encodeString($dataPedido['direccion_pedido']), 1, 1, 'C', 1);
        $pdf->Cell(40, 10, 'Estado', 1, 0, 'C', 1);
        $pdf->Cell(0, 10, $pdf->encodeString($dataPedido['estado_pedido']), 1, 1, 'C', 1);
        $pdf->Cell(40, 10, 'Fecha', 1, 0, 'C', 1);
        $pdf->Cell(0, 10, $dataPedido['fecha_registro'], 1, 1, 'C', 1);
        // Detalle del pedido
        if ($dataDetalle = $pedidos->obtenerDetallePedido($id_pedido)) {
            $pdf->Ln(10); // Espacio entre secciones
            $pdf->setFillColor(8, 31, 73);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(0, 10, 'Detalle del Pedido', 1, 1, 'C', 1);
            // Encabezados del detalle del pedido
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(255, 255, 255); // Fondo blanco para los encabezados
            $pdf->SetFont('Arial', 'B', 10); // Negrita para los encabezados
            $pdf->Cell(80, 10, 'Producto', 1, 0, 'C', 1);
            $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', 1);
            $pdf->Cell(30, 10, 'Precio', 1, 0, 'C', 1);
            $pdf->Cell(30, 10, 'Total', 1, 1, 'C', 1);
            // Variable para almacenar el total del pedido
            $totalPedido = 0;
            // Datos del detalle del pedido
            foreach ($dataDetalle as $rowDetalle) {
                $totalProducto = $rowDetalle['cantidad_producto'] * $rowDetalle['precio_producto'];
                $totalPedido += $totalProducto;
                $pdf->SetFillColor(224, 224, 224); // Fondo gris claro para las filas de datos
                $pdf->SetFont('Arial', '', 10); // Fuente regular para los datos
                $pdf->Cell(80, 10, $pdf->encodeString($rowDetalle['nombre_producto']), 1, 0, 'C', 1);
                $pdf->Cell(30, 10, $rowDetalle['cantidad_producto'], 1, 0, 'C', 1);
                $pdf->Cell(30, 10, number_format($rowDetalle['precio_producto'], 2), 1, 0, 'C', 1); // Formato de precio
                $pdf->Cell(30, 10, number_format($totalProducto, 2), 1, 1, 'C', 1); // Formato de total
            }
            // Mostrar el total del pedido
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetFillColor(224, 224, 224); // Fondo gris claro para el total
            $pdf->Cell(140, 10, 'Total del Pedido', 1, 0, 'R', 1);
            $pdf->SetFillColor(224, 224, 224); // Fondo gris claro para el total
            $pdf->Cell(30, 10, number_format($totalPedido, 2), 1, 1, 'C', 1);
        } else {
            $pdf->Cell(0, 10, 'No hay detalles disponibles', 1, 1);
        }
    } else {
        $pdf->Cell(0, 10, 'Pedido no encontrado', 1, 1);
    }
    // Salida del documento.
    $pdf->Output();
} else {
    echo 'Debe proporcionar un ID de pedido';
}
?>
