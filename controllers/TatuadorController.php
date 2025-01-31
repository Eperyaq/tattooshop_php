<?php 

require_once "./models/TatuadorModel.php";

    class TatuadorController{

        private $tatuadorModel;

        public function __construct(){
            $this->tatuadorModel = new TatuadorModel();
        }

        public function showAltaTatuador($errores = []){
            require_once "./views/TatuadorAltaView.php";
        }

        public function insertTatuador($datos = []){
            $nombre = $datos["nombre"] ?? "";
            $email = $datos["email"] ?? "";
            $pass = $datos["password"] ?? "";
            $foto = $datos["foto"] ?? "";

            $errores = [];
            if($nombre == "" || $email == "" || $pass == "" || $foto == "" ) {

                // COMPROBAMOS QUÉ CAMPO ESTÁ VACÍO Y LO AÑADÁIS A UN ARRAY DE ERRORES
                if($nombre == "") {
                    $errores["error_nombre"] = "El campo nombre es obligatorio";
                }

                if($email == "") {
                    $errores["error_email"] = "El campo email es obligatorio";
                }

                if($pass == "") {
                    $errores["error_password"] = "La contraseña es obligatoria";
                }
                
                if($foto == "") {
                    $errores["error_foto"] = "El campo foto es obligatorio";
                }

            }

            $emailCorrecto = $this->tatuadorModel->comprobarEmail($email);

            if($emailCorrecto){
                $errores["error_email2"] = "El email ya está usado";
            }


            if(!empty($errores)) {
                $this->showAltaTatuador($errores);
            } else {

               
                $operacionExitosa = $this->tatuadorModel->insertTatuador($nombre, $email, $pass, $foto);


                if($operacionExitosa) { 
                    require_once "./views/AltaTatuadorCorrectaView.php";
                } else {
                    
                    $errores["error_db"] = "Error al insertar al tatuador, intentelo de nuevo más tarde";
                    $this->showAltaTatuador($errores);
                }

            }

        }

        


    }

?>