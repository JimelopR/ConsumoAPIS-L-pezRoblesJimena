<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <title>Consumo de APIs</title>
    <style>
        /* Estilos básicos para la página */
        body { 
            font-family: 'Dancing Script', cursive;
            text-align: center; 
        }
        .container { 
            width: 50%; 
            margin: auto; 
            padding: 20px; 
        }
        /* Estilos para inputs y botones */
        input, button { 
            margin: 10px; 
            padding: 10px; 
            width: 80%; 
        }
        /* Botón en color rojo */
        button {
            background-color: #e63946; /* Rojo vibrante */
            color: white;
            border: none;
            font-size: 16px;
            font-family: 'Dancing Script', cursive; /* Fuente aplicada al botón también */
            cursor: pointer;
            border-radius: 5px; /* Bordes redondeados */
            transition: background-color 0.3s ease;
        }
        /* Efecto hover para el botón */
        button:hover {
            background-color: #d62839; /* Rojo más oscuro al pasar el mouse */
        }
        /* Estilos para los resultados */
        .result { 
            border: 1px solid #ddd; 
            padding: 10px; 
            margin: 10px; 
        }
        /* Estilos para la imagen */
        .image-container {
            margin-top: 20px;
        }
        img {
            width: 300px; /* Ajustar tamaño de imagen */
            height: auto;
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Consumo de APIs</h2>
        <h3>Para ver la respuesta de las tres API presiona el siguiente botón</h3>
        <!-- Botón que ejecuta la función connectAPIs() al hacer clic -->
        <button onclick="connectAPIs()">Enviar</button>
        
        <!-- Divs donde se mostrarán las respuestas de las APIs -->
        <div class="result" id="api1">Respuesta API 1...</div>
        <div class="result" id="api2">Respuesta API 2...</div>

        <!-- Contenedor de la imagen -->
        <div class="image-container">
            <img id="imageAPI" src="" alt="Imagen de la API 3">
        </div>
    </div>

    <script>
        // Función que realiza la conexión con el backend y obtiene datos de las APIs
        function connectAPIs() {
            // Mostrar mensajes de "Cargando..." mientras se obtienen los datos
            document.getElementById('api1').innerText = "Cargando...";
            document.getElementById('api2').innerText = "Cargando...";
            document.getElementById('imageAPI').src = "Cargando..."; // Limpiar imagen anterior

            // Hacer la petición al backend (backend.php)
            fetch('backend.php')
                .then(response => response.json()) // Convertir la respuesta a JSON
                .then(data => {
                    // Extraer los datos recibidos desde el backend
                    let addressData = data.address; // Datos de dirección
                    let personData = data.person;   // Datos de persona
                    let imageURL = data.imagen;     // URL de la imagen

                    // Mostrar los datos obtenidos en los elementos HTML correspondientes
                    document.getElementById('api1').innerText = 
                        `Dirección: ${addressData.street}, ${addressData.city}, ${addressData.country}`;

                    document.getElementById('api2').innerText = 
                        `Persona: ${personData.firstname} ${personData.lastname}, ${personData.email}`;

                    // Mostrar imagen si existe
                    if (imageURL) {
                        document.getElementById('imageAPI').src = imageURL;
                    } else {
                        document.getElementById('imageAPI').alt = "No se pudo cargar la imagen.";
                    }
                })
                .catch(error => {
                    // Manejo de errores si algo falla en la petición
                    console.error('Error:', error);
                    document.getElementById('api1').innerText = "Error al cargar datos.";
                    document.getElementById('api2').innerText = "Error al cargar datos.";
                    document.getElementById('imageAPI').alt = "No se pudo cargar la imagen.";
                });
        }
    </script>
</body>
</html>

