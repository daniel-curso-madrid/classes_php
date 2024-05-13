<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../classes-php/css/style.css">
    <title>Blog</title>
</head>

<body>
    <h1>Blog con OOP</h1>

    <?php

    include_once './autoloader.php';


    try {

        $autoloader = new Autoloader(__DIR__ . '/clases/');
        $autoloader->registrar();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }


    // define('BASE_DIR', __DIR__ . '/clases/'); // <-- Creamos una constante con la ruta del directorio, agregamos /clases/ que es donde tenemos las clases

    // spl_autoload_register(function ($class) {
    //     $file = BASE_DIR . str_replace('\\', '/', $class) . '.php'; // <-- Añadimos el punto antes de 'php'
    //     if (file_exists($file)) {
    //         require_once($file);
    //     } else {
    //         // Opcional: Registra el error en un archivo de logs
    //         error_log("No se encuentra la clase: " . $class);

    //         // Lanza una excepción en lugar de solo imprimir un mensaje
    //         throw new Exception("No se encuentra la clase: " . $class);
    //     }
    // });
