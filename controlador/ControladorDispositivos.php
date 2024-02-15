<?php
    include_once "./modelo/ModeloDispositivos.php";
    class ControladorDispositivos{
        
        //Funcion para consultar el listado de productos en venta.
        static function consultaDispositivos(){
            $tabla = 'v_inv_dispositivos';
            $obj = ModeloDispositivos::selectDispositivos($tabla);
            $arregloDispositivos = $obj->fetch_all();
            return $arregloDispositivos;
        }
        
        //funcion para eliminar dispositivos
        static function borrarDispositivos(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "eliminarDispositivos"){
                $id = $_GET["id_dispositivo"];
                $tabla = 'dispositivos';                                                                                                                                                                    
                $delete = ModeloDispositivos::deleteDispositivos($tabla, $id);
                if($delete>0){
                    echo '
                        <script>
                            alert("Dispositivo eliminado correctamente");
                            window.location.href="index.php?seccion=dispositivos";
                        </script>
                    ';
                }
            }
        }
        

       
       
        //funcion para consultar los detalles de dispositivos de manera general sin especificar
        //que sea de algun tipo en especifico
        static function detalleDispositivo(){
            if(isset($_GET["id_dispositivo"])){
                $tabla = "v_inv_dispositivos";
                $id = $_GET["id_dispositivo"];

                $obj = ModeloDispositivos::selectDispositivosId($tabla, $id);
                $dispositivo = $obj->fetch_all();
                return $dispositivo;
            }
        }

        static function detalleDispositivoPLI(){
            if(isset($_GET["id_dispositivo"])){
                $id = $_GET["id_dispositivo"];
                
                $obj = ModeloDispositivos::selectDispositivosPLI($id);
                
                // Verificar si $obj es un objeto mysqli_result
                if ($obj instanceof mysqli_result) {
                    // Si es un objeto mysqli_result, aplicar fetch_all()
                    $dispositivo = $obj->fetch_all(MYSQLI_ASSOC);
                } else {
                    // Si no es un objeto mysqli_result, asumir que ya es un array
                    $dispositivo = $obj;
                }
                
                return $dispositivo;
                
            }
        }
        
        static function detalleDispositivoGen(){
            if(isset($_GET["id_dispositivo"])){
                $id = $_GET["id_dispositivo"];
                
                $obj = ModeloDispositivos::selectDispositivosGen($id);
                
                // Verificar si $obj es un objeto mysqli_result
                if ($obj instanceof mysqli_result) {
                    // Si es un objeto mysqli_result, aplicar fetch_all()
                    $dispositivo = $obj->fetch_all(MYSQLI_ASSOC);
                } else {
                    // Si no es un objeto mysqli_result, asumir que ya es un array
                    $dispositivo = $obj;
                }
                
                return $dispositivo;
                
            }
        }

        static function detalleDispositivoIMac(){
            if(isset($_GET["id_dispositivo"])){
                $id = $_GET["id_dispositivo"];
                
                $obj = ModeloDispositivos::selectDispositivoIMac($id);
                
                // Verificar si $obj es un objeto mysqli_result
                if ($obj instanceof mysqli_result) {
                    // Si es un objeto mysqli_result, aplicar fetch_all()
                    $dispositivo = $obj->fetch_all(MYSQLI_ASSOC);
                } else {
                    // Si no es un objeto mysqli_result, asumir que ya es un array
                    $dispositivo = $obj;
                }
                
                return $dispositivo;
                
            }
        }

        static function detalleLaptop(){
            if(isset($_GET["id_dispositivo"])){
                $tabla = "v_inv_laptops";
                $id = $_GET["id_dispositivo"];
                
                $obj = ModeloDispositivos::selectDispositivosId($tabla, $id);
                $dispositivoInfo = $obj->fetch_all();
                return $dispositivoInfo;
            }
        }

    static function editarLaptop()
    {
    if (isset($_POST["guardarLaptop"])) {
   

        // Almacenamos la información al modelo para que la guarde en la base de datos
      
            try {
                // Ajustar max_allowed_packet para esta conexión
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                // Validar el formato de la fecha
                $fechaCompra = $_POST["fecha_compra"];
                if (DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false) {
                    $fechaCompraFormateada = $fechaCompra;
                } else { 
                    // Manejar el caso en que la fecha no tiene el formato correcto
                    echo 'Error en el formato de la fecha';
                    exit;
                }
                
                // Obtén el valor directo del campo de precio 
                

                $datos = array(
                    "id_dispositivo" => (int)$_POST["id_dispositivo"],
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => (int)$_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,  // Se usa el precio procesado como double
                    "estado" => (int)$_POST["estado"],
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );
                
               
               
          

                $insert = ModeloDispositivos::updateLaptop($datos);

                
            } catch (mysqli_sql_exception $e) {
                // Manejar excepciones de MySQL
                echo 'Message: ' .$e->getMessage();
            }
        } else {
            echo 'Por favor, introduce una imagen';
        }

        echo "ARRAY EN EL CONTROLADOR (datos)...";
        var_dump ($datos); 
    
}

static function editarDispositivo()
{
if (isset($_POST["guardarDispositivo"])) {


    // Almacenamos la información al modelo para que la guarde en la base de datos
  
        try {
            // Ajustar max_allowed_packet para esta conexión
            $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
            Conexion::conectar()->query($sqlSetMaxAllowedPacket);

            // Validar el formato de la fecha
            $fechaCompra = $_POST["fecha_compra"];
            if (DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false) {
                $fechaCompraFormateada = $fechaCompra;
            } else { 
                // Manejar el caso en que la fecha no tiene el formato correcto
                echo 'Error en el formato de la fecha';
                exit;
            }
            
            // Obtén el valor directo del campo de precio 
            

            $datos = array(
                "id_dispositivo" => (int)$_POST["id_dispositivo"],
                "modelo" => $_POST["modelo"],
                "numero_serie" => $_POST["numero_serie"],
                "id_marca" => (int)$_POST["marca"],
                "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,  // Se usa el precio procesado como double
                "estado" => (int)$_POST["estado"],
                "fecha_compra" => $fechaCompraFormateada,
                "nota" => $_POST["nota"],
                "foto" => "foto",
            );
            
           
           
      

            $insert = ModeloDispositivos::updateDispositivo($datos);

            
        } catch (mysqli_sql_exception $e) {
            // Manejar excepciones de MySQL
            echo 'Message: ' .$e->getMessage();
        }
    } else {
        echo 'Por favor, introduce una imagen';
    }

    echo "ARRAY EN EL CONTROLADOR (datos)...";
    var_dump ($datos); 

}

static function editarIMac()
    {
    if (isset($_POST["guardarIMac"])) {
   

        // Almacenamos la información al modelo para que la guarde en la base de datos
      
            try {
                // Ajustar max_allowed_packet para esta conexión
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                // Validar el formato de la fecha
                $fechaCompra = $_POST["fecha_compra"];
                if (DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false) {
                    $fechaCompraFormateada = $fechaCompra;
                } else { 
                    // Manejar el caso en que la fecha no tiene el formato correcto
                    echo 'Error en el formato de la fecha';
                    exit;
                }
                
                // Obtén el valor directo del campo de precio 
                

                $datos = array(
                    "id_dispositivo" => (int)$_POST["id_dispositivo"],
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => (int)$_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,  // Se usa el precio procesado como double
                    "estado" => (int)$_POST["estado"],
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                    "Keyboard_model" => $_POST["Keyboard_model"],
                    "keyboard_ns" => $_POST["keyboard_ns"],
                    "mouse_model" => $_POST["mouse_model"],
                    "mouse_ns" => $_POST["mouse_ns"],
                );
                
               
               
          

                $insert = ModeloDispositivos::updateIMac($datos);

                
            } catch (mysqli_sql_exception $e) {
                // Manejar excepciones de MySQL
                echo 'Error en la conexión a la base de datos.';
            }
        } else {
            echo 'Message: ' .$e->getMessage();
        }

        echo "ARRAY EN EL CONTROLADOR (datos)...";
        var_dump ($datos); 
    
}

           //Funcion para consultar los tipos de dispositivos
           static function getTiposDispositivos(){
            $tabla = "tipos_dispositivos";
            $respuesta = ModeloDispositivos::selectTiposDispositivos($tabla);
            $arreglo = $respuesta->fetch_all();
            return $arreglo;
        }
        //Funcion para consultar la marca de los dispositivos
        static function getMarcas(){
            $tabla = "marcas";
            $respuesta = ModeloDispositivos::selectMarcas($tabla);
            $arreglo = $respuesta->fetch_all();
            return $arreglo;
        }
        //funcion para consultar los tipos de estados
        static function getEstados(){
            $tabla = "estados_dispositivos";
            $respuesta = ModeloDispositivos::selectEstados($tabla);
            $arreglo = $respuesta->fetch_all();
            return $arreglo;
    }
    // funcion para obtener el tipo de dispositivo actual
    public static function getTipoDispositivoActual($id_dispositivo) {
        $tabla = "v_inv_dispositivos";
        $obj = ModeloDispositivos::selectDispositivosId($tabla, $id_dispositivo);
        $dispositivo = $obj->fetch_all();

        return array($dispositivo[0][0], $dispositivo[0][1]); // Ajusta esto según la estructura de tu tabla.
    }

    static function registrarLaptop(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if (DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false) {
                    $fechaCompraFormateada = $fechaCompra;
                } else { 
                    echo 'Error en el formato de la fecha';
                    exit;
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => (int)$_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,  
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::createLaptop($datos);

            } catch(mysqli_sql_exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    static function registrarDesktop(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if (DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false) {
                    $fechaCompraFormateada = $fechaCompra;
                } else { 
                    echo 'Error en el formato de la fecha';
                    exit;
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => (int)$_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,  
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::createDesktop($datos);

            } catch(mysqli_sql_exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }
    static function registrarImac(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if (DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false) {
                    $fechaCompraFormateada = $fechaCompra;
                } else { 
                    echo 'Error en el formato de la fecha';
                    exit;
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "ram" => (int)$_POST["ram"],
                    "procesador" => $_POST["procesador"],
                    "sistema_operativo" => $_POST["sistema_operativo"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,  
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                    "Keyboard_model"=> $_POST["Keyboard_model"],
                    "keyboard_ns"=> $_POST["keyboard_ns"],
                    "mouse_model"=> $_POST["mouse_model"],
                    "mouse_ns"=>$_POST["mouse_ns"],
                );

                $insert = ModeloDispositivos::createImac($datos);

            } catch(mysqli_sql_exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    static function registrarTeclado(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",

                );

                $insert = ModeloDispositivos::createTeclado($datos);

            } catch(mysqli_sql_exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    static function registrarMouse(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",

                );

                $insert = ModeloDispositivos::createMouse($datos);

            } catch(mysqli_sql_exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    static function registrarMonitor(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "nota",
                );

                $insert = ModeloDispositivos::createMonitor($datos);

            } catch(mysqli_sql_exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

    }

    static function registrarHeadsets(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::createHeadset($datos);

            }catch (mysqli_sql_exception $e) {
                echo 'Message: ' .$e->getMessage();
            }

        } 
    }

    static function registrarCelular(){
        if(isset($_POST["Registrar"])){
            try{

                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !==false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::createCelular($datos);

            }catch (mysqli_sql_exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    static function registrarSwitch(){
        if(isset($_POST["Registrar"])){
            try{

                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !==false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::createSwitch($datos);

            }catch (mysqli_sql_exception $e){
                echo 'Message: ' .$e->getMessage();
            }
        }
    }

    static function registrarImpresora(){
        if(isset($_POST["Registrar"])){
            try{

                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !==false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::createImpresora($datos);

            } catch (mysqli_sql_exception $e){
                echo 'Message: '.$e->getMessage();
            }
        }
    }

    static function registrarOtro(){
        if(isset($_POST["Registrar"])){
            try{

                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !==false){
                    $fechaCompraFormateada = $fechaCompra;
                }else{
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                );

                $insert = ModeloDispositivos::createOtro($datos);

            } catch (mysqli_sql_exception $e){
                echo 'Message: '.$e->getMessage();
            }
        }
    }

    public static function consultaHerramientas(){
        $tabla = 'v_inv_herramientas';
        $obj = ModeloDispositivos::selectHerramientas($tabla);
        $arregloHerramientas = $obj->fetch_all();
        return $arregloHerramientas;

    }

    static function borrarHerramienta(){
        if(isset($_GET["accion"])&& $_GET["accion"]=="eliminarHerramienta"){
            $id = $_GET["id_herramienta"];

            $delete = ModeloDispositivos::deleteHerramienta($id);
            if($delete>0){
                echo '
                        <script>
                            alert("Herramienta eliminada correctamente");
                            window.location.href="index.php?seccion=herramientas";
                        </script>
                    ';
            }
        }
    }

    static function registrarHerramienta(){
        if(isset($_POST["Registrar"])){
            try{

                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !==false){
                    $fechaCompraFormateada = $fechaCompra;
                }else{
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "nombre_herramienta" => $_POST["nombre_herramienta"],
                    "numero_piezas" => (int)$_POST["numero_piezas"],
                    "ubicacion" => $_POST["ubicacion"],
                    "fecha_compra" => $fechaCompraFormateada,
                    "descripcion" => $_POST["descripcion"],
                );

                $insert = ModeloDispositivos::createHerramienta($datos);

            } catch (mysqli_sql_exception $e){
                echo 'Message: '.$e->getMessage();
            }
        }
    }

    static function detalleHerramienta(){
        if(isset($_GET["id_herramienta"])){
            $id = $_GET["id_herramienta"];

            $obj = ModeloDispositivos::selectHerramienta($id);

            if($obj instanceof mysqli_result){
                $colaborador = $obj->fetch_all(MYSQL_ASSOC);
            }else{
                $colaborador = $obj;
            }
            return $colaborador;

        }
    }

    static function editarHerramienta(){
        if(isset($_POST["guardarHerramienta"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar($sqlSetMaxAllowedPacket);

                $fechaCompra =$_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !==false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "id_herramienta" => (int)$_POST["id_herramienta"],
                    "nombre_herramienta" => $_POST["nombre_herramienta"],
                    "numero_piezas" => (int)$_POST["numero_piezas"],
                    "ubicacion" => $_POST["ubicacion"],
                    "fecha_compra" => $fechaCompraFormateada,
                    "descripcion" => $_POST["descripcion"],
                );

                $insert = ModeloDispositivos::updateHerramienta($datos);

            }catch (mysqli_sql_exception $e){
                echo 'Message: '.$e->getMessage();
            }
        }
    }

    static function consultaCctvs(){
        $tabla = 'v_inv_cctv';
        $obj = ModeloDispositivos::selectCctvs($tabla);
        $arregloDispositivos = $obj->fetch_all();
        return $arregloDispositivos;
    }

    static function registrarCctv(){
        if(isset($_POST["Registrar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaCompra = $_POST["fecha_compra"];
                if(DateTime::createFromFormat('Y-m-d', $fechaCompra) !== false){
                    $fechaCompraFormateada = $fechaCompra;
                } else {
                    echo 'Error en el formato de la fecha';
                }

                $datos = array(
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" =>(int)$_POST["marca"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra" => $fechaCompraFormateada,
                    "nota" => $_POST["nota"],
                    "foto" => "foto",
                    "producto" => $_POST["producto"],
                    "ubicacion" => $_POST["ubicacion"],
                );

                $insert = ModeloDispositivos::createCctv($datos);

            }catch(mysqli_sql_exception $e){
                echo 'Message: '.$e->getMessage();
            }
        }
    }

    static function borrarCctv(){
        if(isset($_GET["accion"])&& $_GET["accion"]=="eliminar"){
            $id = $_GET["id_dispositivo"];

            $delete = ModeloDispositivos::deleteCctv($id);
            if($delete>0){
                echo '
                    <script>
                        alert("CCTV eliminado correctamente");
                        window.location.href="index.php?seccion=cctvs";
                    </script>
                ';
            }
        }
    }

    static function editarCctv(){
        if(isset($_POST["guardar"])){
            try{
                $sqlSetMaxAllowedPacket = "SET GLOBAL max_allowed_packet=64*1024*1024";
                Conexion::conectar()->query($sqlSetMaxAllowedPacket);

                $fechaIngreso = $_POST["fecha_ingreso_colaborador"];
                if (DateTime::createFromFormat('Y-m-d',$fechaIngreso) !==false){
                    $fechaIngresoFormateada = $fechaIngreso;
                }else{
                    echo 'Error en el formato de la fecha';
                    exit;
                }

                $datos = array(
                    "id_dispositivo" => (int)$_POST["id_dispositivo"],
                    "modelo" => $_POST["modelo"],
                    "numero_serie" => $_POST["numero_serie"],
                    "id_marca" => (int)$_POST["id_marca"],
                    "estado" => (int)$_POST["estado"],
                    "precio" => isset($_POST['precio']) ? floatval(str_replace(',', '', $_POST['precio'])) : 0,
                    "fecha_compra"=> $fechaIngresoFormateada,
                    "nota" => $_POST("nota"),
                    "foto" => "foto.png",
                    "producto" => $_POST["producto"],
                    "ubicacion" => $_POST["ubicacion"]
                );

                $insert = ModeloDispositivos::updateCctv($datos);

            }catch (mysqli_sql_exception){
                echo 'Message: '.$e->getMessage();
            }
        }
    }

    static function detalleCctv(){
        if(isset($_GET["id_dispositivo"])){
            $id = $_GET["id_dispositivo"];

            $obj = ModeloDispositivos::selectCctv($id);

            if($obj instanceof mysqli_result){
                $dispositivo = $obj->fecht_all(MYSQL_ASSOC);
            }else{
                $dispositivo = $obj;
            }
            return $dispositivo;
        }
    }

    }

?>