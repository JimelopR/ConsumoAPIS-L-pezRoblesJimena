<?php

header('Content-Type: application/json');
// para especificar que el contenido de la respuesta es en formato JSON

// URLs de las 3 APIs
$api_urls = [
    "address" => "https://fakerapi.it/api/v2/addresses?_quantity=1",
    "person"  => "https://fakerapi.it/api/v2/persons?_quantity=1",
    "imagen"  => "https://fakerapi.it/api/v2/images?_type=any&_width=500&_height=230"
    /*_quantity=1 indica que se solicita una única dirección.
    Los parámetros _type=any permiten cualquier tipo de imagen 
    y los parámetros _width=500 y _height=230 definen las dimensiones 
    de la imagen (500px de ancho y 230px de alto).*/ 
];

// Función para hacer solicitudes a la API
function fetchAPI($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Deshabilitar verificación SSL (usar con precaución en producción)
    $response = curl_exec($ch);
    curl_close($ch);
    return $response ? json_decode($response, true) : null;
}

// Hacer solicitudes a las 3 APIs
$results = [];
foreach ($api_urls as $key => $url) {
    $data = fetchAPI($url);

    if ($key === "imagen") {
        // Para la imagen, obtener directamente la URL
        $results[$key] = $data["data"][0]["url"] ?? "";
    } else {
        // Para dirección y persona, obtener los datos completos
        $results[$key] = $data["data"][0] ?? [];
    }
}

// Enviar los datos en formato JSON
echo json_encode($results);
?>


