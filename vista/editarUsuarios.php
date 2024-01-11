
<?php
//obtenemos el id del usuario que vamos a editas para posteriorm3ente usarlo en el formulario con sus datos ya obtenidos

    $id = $_GET['id_usuario']
|   


    $datosUsuario = obtenerDatosUsuario($id);


    //metodo para irnos al controladora obtener la informacion del usuario a partir de su id
    function obtenerDatosUsuario($id){
        if (isset($_GET['id']) && $_GET['id'] !== null) {
            $UsuarioInfo = ControladorUsuarios::detalleUsuario($id);
        }else{
            $UsuarioInnfo = ControladorUsuarios::detalleUsuarios($id);
        }


    //debemos verificar si se obtuvieron los datoas de manera exitosa
    if(){

    }

?>