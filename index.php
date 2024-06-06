<?php


// Se incluye el controlador
require_once './controllers/ApiController.php';

// Se obtiene el metodo de la solicitud y la accion
$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Si la accion esta vacia redirecciona a el login
if(empty($action)) {
    header('Location: views/login.php');
    die;
}

// Se crea una instancia del controlador de usuarios
$apiController = new ApiController();

// Maneja las diferentes acciones según el método de solicitud
switch ($requestMethod) {
    case 'GET':

        if ($action == 'getToken') {
            $apiController->getToken();
        } else if ($action == 'lisData') {
            $session = isset($_GET['sessionName']) ? $_GET['sessionName'] : null;
            $apiController->listData($session);
        }

        break;

    case 'POST':
       
        if ($action == 'login') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $username = $data['username'];
            $password = $data['password'];
            $apiController->login($username, $password);
        } 

        break;
    
    default:
        // Envía un mensaje de error si se utiliza un método no permitido
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
    }

?>
