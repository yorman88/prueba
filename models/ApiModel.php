<?php

class ApiModel {

    // Metodo cURL para obtener el token de la api
    public static function getTokenApi() {
        $url = 'https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php?operation=getchallenge&username=prueba';

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            
            var_dump($error_msg);
        }

        curl_close($curl);

        return $response;
        
    }

    // Metodo cURL para hacer login en la api
    public static function login($username, $accesKey, $operation) {
        $url = 'https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php';

        $curl = curl_init();

        // Preparar los datos como una cadena URL-encoded
        $postData = http_build_query([
            'operation' => $operation,
            'username' => $username,
            'accessKey' => $accesKey
        ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
           
            var_dump($error_msg);
        }

        curl_close($curl);

        return $response;
    }

    // Metodo cURL para obtener los datos de la api
    public static function listData($sessionName, $operation) {

        $baseUrl = 'https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php';
        $params = '?operation=' . urlencode($operation) . '&sessionName=' . urlencode($sessionName) . '&query=select%20*%20from%20Contacts%3B';

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $baseUrl . $params,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
    
}
