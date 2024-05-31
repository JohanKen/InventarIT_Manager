<?php 
// Este método es para filtrar los dispositivos por tipo en la vista dispositivos.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once __DIR__ . '/../../modelo/ModeloDispositivos.php';

$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

function resaltarTexto($texto, $buscar) {
    if (!empty($buscar)) {
        return str_ireplace($buscar, '<span style="background-color: yellow;">' . htmlspecialchars($buscar) . '</span>', htmlspecialchars($texto));
    }
    return htmlspecialchars($texto);
}

if (!empty($buscar)) {
    $dispositivos = ModeloDispositivos::buscarDispositivo($buscar);

    if ($dispositivos) {
        echo '<tbody>';
        foreach ($dispositivos as $item) {
            echo '
                <tr>
                    <td>' . resaltarTexto($item['id_dispositivo'], $buscar) . '</td>
                    <td>' . resaltarTexto($item['tipo'], $buscar) . '</td>
                    <td>' . resaltarTexto($item['modelo'], $buscar) . '</td>
                    <td>' . resaltarTexto($item['numero_serie'], $buscar) . '</td>
                    <td>' . resaltarTexto($item['marca'], $buscar) . '</td>
                    <td>$' . number_format($item['precio'], 2, '.', ',') . '</td>
                    <td>' . resaltarTexto($item['estado'], $buscar) . '</td>
                    <td>' . resaltarTexto($item['fecha_compra'], $buscar) . '</td>
                    <td>' . resaltarTexto($item['nota'], $buscar) . '</td>
                    <td style="text-align:center; vertical-align:middle;">';
                    if (empty($item['imagen'])) {
                        switch ($item['tipo']) {
                            case "Laptop":
                                echo "<img src='images/dis/laptop.png' alt='IMGlaptop' height='50'>";
                                break;
                            case "Descktop":
                                echo "<img src='images/dis/desktop.png' alt='IMGdesktop' height='50'>";
                                break;
                            case "iMac":
                                echo "<img src='images/dis/imac.png' alt='IMGimac' height='50'>";
                                break;
                            case "Teclado":
                                echo "<img src='images/dis/teclado.png' alt='IMGteclado' height='50'>";
                                break;
                            case "Mouse":
                                echo "<img src='images/dis/logi.png' alt='IMGmouse' height='50'>";
                                break;
                            case "Monitor":
                                echo "<img src='images/dis/monitor.png' alt='IMGmonitor' height='50'>";
                                break;
                            case "Headset":
                                echo "<img src='images/dis/headset.png' alt='IMGheadset' height='50'>";
                                break;
                            case "Celular":
                                echo "<img src='images/dis/celular.png' alt='IMGcelular' height='50'>";
                                break;
                            case "Switches":
                                echo "<img src='images/dis/switch.png' alt='IMGswitch' height='50'>";
                                break;
                            case "Impresora":
                                echo "<img src='images/dis/hp.png' alt='IMGimpresora' height='50'>";
                                break;
                            case "otro":
                                echo "<img src='images/dis/otros.png' alt='IMGotro' height='50'>";
                                break;
                        }
                    } else {
                        echo "<img src='{$item['tipo']}' alt='' height='50'>";
                    }

                    echo '
                        </td>
                    <td>
                    <div class="acciones">
                    <img src="images/editar.png" alt="Editar" style="max-width:40px; cursor:pointer;" class="imagen-editar" data-id="' . htmlspecialchars($item['id_dispositivo']) . '">
                    <img src="images/basura.png" alt="Borrar" style="max-width:40px; cursor:pointer;" onclick="confirmarBorrar(' . htmlspecialchars($item['id_dispositivo']) . ');">
                </div>
                </td>
                </tr>
                
            ';
        }
        echo '</tbody>';
    } else {
        echo '<tbody><tr>
        <td colspan="11">No se encontraron dispositivos.</td></tr></tbody>';
    }
} else {
    echo '<tbody><tr><td colspan="11">Por favor ingrese un término de búsqueda.</td></tr></tbody>';
}
