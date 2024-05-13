<?php

class Autoloader
{
    private $directorio_base;

    public function __construct($directorio_base)
    {
        $this->directorio_base = $directorio_base;
    }


    /*
    Carga automáticamente el archivo de una clase cuando se intenta utilizar 

    @param string $clase Nombre de la clase que se intenta utilizar.
    @throws Exception Si el arhcivo de la clase no se encuentra.
    */
    public function cargar_clase($clase)
    {
        // Construye la ruta completa al archivo de la clase.
        $ruta_archivo = $this->directorio_base . str_replace('\\', '/', $clase) . '.php';
        // Veritfica si existe el archivo
        if (file_exists($ruta_archivo)) {
            require_once($ruta_archivo);
        } else {
            error_log("No se pudo cargar la clase: " . $clase);
            throw new Exception("No se encuentra la clase: " . $clase);
        }
    }

    /* 
    Registra la función de autoloading() con php

    Utiliza spl_autoload_register para registrar la función 'cargar_clase' como la función de
    autoloading que PHP llamará automáticamente cuando se intenta utilizar una clase que aún no ha
    sido definida o incluida.

    Esto facilita la gestión de clases en la aplicación, ya que no es encesario incluir manualmente
    los archivos de clase con 'require' o 'include'.
    */
    public function registrar()
    {
        // Registra la función 'cargar_clase' como autoloader.
        spl_autoload_register(array($this, 'cargar_clase'));
    }
}


// Uso del Autoloader
// try {
//     $autoloader = new Autoloader(__DIR__ . '/clases/');
//     $autoloader->registrar();

//     // Resto del código, como la creación de objetos de clases.
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }