<?php
// Se incluye la clase con las plantillas para generar reportes.
require('../../helpers/report.php');
// Se incluyen las clases para la transferencia y acceso a datos.
require('../../models/handler/comentarios_handler.php');

// Creamos el objeto del reporte.
$pdf = new Report;
// Iniciamos el reporte con el encabezado.
$pdf->startReport('Listado de Comentarios por Producto');

// Creamos el objeto del modelo.
$comentarios = new ComentarioHandler;

// Verificamos si existen registros para mostrar.
if ($dataComentarios = $comentarios->comentariosProducto()) {
    // Establecer color de fondo del encabezado a #081F49
    $pdf->setFillColor(8, 31, 73);
    // Establecer color de los bordes de la tabla a blanco
    $pdf->setDrawColor(255, 255, 255);
    // Establecer color del texto a blanco
    $pdf->SetTextColor(255, 255, 255);
    // Establecemos las fuentes para los encabezados.
    $pdf->SetFont('Arial', 'B', 11);
    // Definir la posición inicial X
    $pdf->SetX(10);
    // Imprimimos las celdas del encabezado.
    $pdf->Cell(40, 10, 'Producto', 1, 0, 'C', 1);
    $pdf->Cell(70, 10, 'Comentario', 1, 0, 'C', 1); // Ajuste de tamaño
    $pdf->Cell(30, 10, utf8_decode('Puntuación'), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'Fecha', 1, 0, 'C', 1);
    $pdf->Cell(20, 10, 'Estado', 1, 1, 'C', 1);
    // Restablecer el color del texto a negro para los datos
    $pdf->SetTextColor(0, 0, 0);
    // Establecemos las fuentes para los datos.
    $pdf->SetFont('Arial', '', 10);
    // Recorremos los registros fila por fila.
    foreach ($dataComentarios as $rowComentario) {
        // Establecer color de fondo gris claro para las filas de datos
        $pdf->setFillColor(224, 224, 224);
        // Imprimimos las celdas con los datos.
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $pdf->encodeString($rowComentario['nombre_producto']), 1, 0, 'C', 1);
        $pdf->Cell(70, 10, $pdf->encodeString($rowComentario['contenido_comentario']), 1, 0, 'C', 1);
        $pdf->Cell(30, 10, $rowComentario['puntuacion_comentario'], 1, 0, 'C', 1);
        $pdf->Cell(30, 10, $rowComentario['fecha_comentario'], 1, 0, 'C', 1);
        $pdf->Cell(20, 10, $rowComentario['estado_comentario'], 1, 1, 'C', 1);
    }
} else {
    $pdf->Cell(0, 10, 'No hay comentarios disponibles', 1, 1);
}
// Salida del documento.
$pdf->Output();
?>
