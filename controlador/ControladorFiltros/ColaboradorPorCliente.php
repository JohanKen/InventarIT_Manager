<?php
//Este metodo es para la vista "asignarPaso3.php"
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . '/../../modelo/ModeloColaboradores.php';

// Obtener el cliente seleccionado
$clienteSeleccionado = isset($_GET['cliente']) ? $_GET['cliente'] : '';

// Validar que el cliente seleccionado no esté vacío antes de realizar la consulta
if (!empty($clienteSeleccionado)) {
    // Obtener colaboradores según el cliente seleccionado
    $colaboradores = ModeloColaboradores::selectColaboradorPorCliente($clienteSeleccionado);

    // Construir las opciones del select
    $options = "";
    foreach ($colaboradores as $item) {
        $options .= '<option value="' . $item['id_colaborador'] . '">' .
            $item['nombre_colaborador'] . ' ' . $item['apellido_paterno_colaborador'] . '</option>';
    }

    // Enviar las opciones como respuesta a la solicitud AJAX
    echo $options;
} else {
    // Enviar un mensaje de error si el cliente seleccionado está vacío
    echo 'Error: Cliente no seleccionado.';
}
?>
