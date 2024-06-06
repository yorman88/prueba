<?php

// Se incluye el archivo del modelo
require_once './models/ApiModel.php';

class ApiController {

    //propiedad para crear accesskey
    private $key = 'IwIHRvYcgN3SRC2B';

    // Este metodo renderiza la vista
    public function listView() {
        include 'views/api.php';
    }
    
    // Metodo para obtener el token
    public function getToken() {
        // Se llama a la funcion del modelo
        $token = ApiModel::getTokenApi();

        // Si retorna informacion decodificamos y respondemos al cliente
        if ($token) {
            $response = json_decode($token);
            $token_api = $response->result->token;
            echo json_encode(['status' => 'success', 'token' => $token_api]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al obtener el token']);
        }
    }

    // Metodo para hacer login
    public function login($username, $password){
        
        $accesKey = md5($password.$this->key);
        $operation = 'login';
        
        $sessionName = ApiModel::login($username, $accesKey, $operation);
        if ($sessionName) {
            $response = json_decode($sessionName);
            $sessionName = $response->result->sessionName;
            echo json_encode(['status' => 'success', 'sessionName' => $sessionName]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al obtener la session']);
        }
    }

    // Metodo para consultar los datos de la api
    public function listData($sessionName){
        $operation = 'query';
        $data = ApiModel::listData($sessionName, $operation);
        if ($data) {
            $response = json_decode($data);
            $data = $response->result;
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al obtener los datos']);
        }
    }
   
}
