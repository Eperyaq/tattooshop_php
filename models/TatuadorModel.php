<?php 

    require_once "./database/DBHAndler.php";

    class TatuadorModel {
        private $nombreTabla = "tatuadores"; // NOMBRE DE LA TABLA DE LA BASE DE DATOS
        private $conexion;              // ATRIBUTO QUE ALMACENARÁ LA CONEXIÓN A LA BASE DE DATOS
        private $dbHandler;             // ATRIBUTO QUE ALMACENA LA INSTANCIA DE DBHAndler


        public function __construct() {
            $this->dbHandler = new DBHandler("localhost","root","","tattoos_bd","3307");
        }

        public function insertTatuador($nombre, $email, $pass, $foto){

            $this->conexion = $this->dbHandler->conectar();

            $sql = "INSERT INTO $this->nombreTabla (nombre, email, password, foto) VALUES (?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);

            $stmt-> bind_param("ssss", $nombre, $email, $pass, $foto);


            try {
                return $stmt->execute(); // EXECUTE DEVUELVE UN TRUE O FALSE -> SI HA SIDO EXITOSA LA OPERACION O NO
            } catch(Exception $e) {
                return false;
            } finally {
                $this->dbHandler->desconectar(); // USAMOS FINALLY PARA ASEGURARNOS QUE HEMOS CERRADO LA CONEXIÓN A LA BASE DE DATOS
            }

        }

        public function comprobarEmail($email){

            $this->conexion = $this->dbHandler->conectar();
            $sql = "SELECT EMAIL FROM $this->nombreTabla WHERE EMAIL = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt-> bind_param("s", $email);

            try {
                $stmt->execute();

                $result = $stmt->get_result();
                // Si hay al menos una fila, el email existe
                return $result->num_rows > 0;
            } catch(Exception $e) {
                return false;
            } finally {
                $this->dbHandler->desconectar();
            }

        }

        public function getAllTatuadores() {
            $this->conexion = $this->dbHandler->conectar();
            $sql = "SELECT id, nombre, email FROM $this->nombreTabla"; // Especifica las columnas para evitar problemas
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $stmt->store_result(); 

            $tatuadores = [];
            $stmt->bind_result($id, $nombre, $email);

            while ($stmt->fetch()) {
                $tatuadores[] = [
                    "id" => $id,
                    "nombre" => $nombre,
                    "email" => $email
                ];
            }

            $stmt->close();
            $this->dbHandler->desconectar();

            return $tatuadores;
        }

        public function getTatuador($id) {
            $this->conexion = $this->dbHandler->conectar();
            $sql = "SELECT nombre, email, foto FROM $this->nombreTabla WHERE ID = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();

            // Obtener los resultados
            $resultado = $stmt->get_result();
            $tatuador = $resultado->fetch_assoc(); // Devuelve un array asociativo

            $stmt->close();
            $this->dbHandler->desconectar();

            return $tatuador; // Devuelve un array con los datos o null si no existe
        }
        
    }

?>