<?php
// Se incluye la clase con las plantillas para generar reportes.
require_once('../../helpers/report.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;

// Se incluyen las clases para la transferencia y acceso a datos.
require_once('../../models/data/clientes_data.php');

// Se instancia la entidad correspondiente.
$cliente = new ClienteData;

// Se obtienen los registros de los clientes.
if ($dataClientes = $cliente->readAll()) {
    // Se inicia el reporte con el encabezado del documento.
    $pdf->startReport('Listado de Clientes');
    // Establecer color de fondo del encabezado a #081F49
    $pdf->setFillColor(8, 31, 73);
    // Establecer color de los bordes de la tabla a blanco
    $pdf->setDrawColor(255, 255, 255);
    // Establecer color del texto a blanco
    $pdf->SetTextColor(255, 255, 255);
    // Se establece la fuente para los encabezados.
    $pdf->setFont('Arial', 'B', 11);
    // Se imprimen las celdas con los encabezados.
    $pdf->cell(40, 10, utf8_decode('Apellido'), 1, 0, 'C', 1);
    $pdf->cell(40, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
    $pdf->cell(30, 10, utf8_decode('Teléfono'), 1, 0, 'C', 1);
    $pdf->cell(60, 10, utf8_decode('Correo Electrónico'), 1, 0, 'C', 1);
    $pdf->cell(20, 10, utf8_decode('Estado'), 1, 1, 'C', 1);
    // Restablecer el color del texto a negro para los datos
    $pdf->SetTextColor(0, 0, 0);
    // Se establece la fuente para los datos de los clientes.
    $pdf->setFont('Arial', '', 11);
    // Establecer color de fondo gris claro para las filas de datos
    $pdf->setFillColor(224, 224, 224);

    // Se recorren los registros fila por fila.
    foreach ($dataClientes as $rowCliente) {
        $estado = $rowCliente['estado_cliente'] ? 'Activo' : 'Inactivo';
        // Se imprimen las celdas con los datos de los clientes, centrando el contenido.
        $pdf->cell(40, 10, utf8_decode($rowCliente['apellido_cliente']), 1, 0, 'C', 1);
        $pdf->cell(40, 10, utf8_decode($rowCliente['nombre_cliente']), 1, 0, 'C', 1);
        $pdf->cell(30, 10, $rowCliente['telefono_cliente'], 1, 0, 'C', 1);
        $pdf->cell(60, 10, utf8_decode($rowCliente['correo_cliente']), 1, 0, 'C', 1);
        $pdf->cell(20, 10, utf8_decode($estado), 1, 1, 'C', 1);
    }

    // Se llama implícitamente al método footer() y se envía el documento al navegador web.
    $pdf->output('I', 'clientes.pdf');
} else {
    print('No hay clientes registrados');
}
?>