<?php

    /*
    El archivo más importante en un proyecto MVC es el index.php. Todas las peticiones URL que realice el usuario pasarán por este fichero. 
    Toda acción que se ejecute en nuestra aplicación tendrá que llamar al index y este tendrá que cargar el controlador asociado a dicha acción, 
    el modelo y la vista si procede.

    Responsabilidad principal: Es el punto de entrada de la aplicación.
    Detalles:
    - Se encarga de inicializar el entorno de la aplicación, como configurar constantes, cargar librerías e incluir el archivo de 
    autoloading si se utiliza (por ejemplo, con Composer).
    - Maneja la lógica de enrutar las solicitudes al controlador correspondiente.
    - Es minimalista y delega todas las responsabilidades importantes a las capas lógicas del patrón MVC.
    */
   
    // Cargamos los controladores que necesitamos.
    require_once "./controllers/CitaController.php";
    require_once "./controllers/TatuadorController.php";
    require_once "./controllers/UsuarioController.php";

    // QUIERO OBTENER LA URL DE LA PETICIÓN
    $requestUri = $_SERVER["REQUEST_URI"] ?? "";

    // QUEREMOS LLAMAR A UN CONTROLLER U OTRO DEPENDIENDO DE LA $REQUESTURI
    switch ($requestUri) {
        // 1er caso -> si llamamos a la uri de alta
        case "/tattooshop_php/index":
        case "/tattooshop_php/login":
        case"/tattooshop_php/":

            $usuarioController = new UsuarioController();
            session_start(); // Para poder usar $_SESSION

            // MOSTRAMOS LA PAGINA DE LOGIN
            $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST

            if ($requestMethod == "GET") {
                $usuarioController->showLogin();
            } elseif ($requestMethod == "POST") {
                $datos = $_POST ?? [];
                $usuarioController->doLogin($datos);
            }

            break;



        case "/tattooshop_php/citas/alta":


            session_start(); // Para poder usar $_SESSION
            if (!isset($_SESSION) || !isset($_SESSION["usuario"])) {
                $usuarioController = new UsuarioController();
                $usuarioController->showLogin();
            } else {


                $citaController = new CitaController();
                $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST
                
                if($requestMethod == "GET") {
                    $citaController->showAltaCita();
                } elseif($requestMethod == "POST") {
                    $datos = $_POST ?? [];
                    $citaController->insertCita($datos);
                }
            }

            break;

        case "/tattooshop_php/tatuadores/alta":

            session_start();
            if(!isset($_SESSION) || !isset($_SESSION["usuario"])) {
                $usuarioController = new UsuarioController();
                $usuarioController->doLogin();
            }else{



                $tatuadorControler = new TatuadorController();
                $requestMethod = $_SERVER["REQUEST_METHOD"]; 
    
                if($requestMethod == "GET") {
                    $tatuadorControler->showAltaTatuador();
                } elseif($requestMethod == "POST") {
                    $datos = $_POST ?? [];
                    $tatuadorControler->insertTatuador($datos);
                }
                
                
            }


            break;


            
        // caso por defecto -> llamamos a 404
        default:
            echo "<h1>PAGINA NO ENCONTRADA</h1>";
            break;
    }


?>