<?php

class Aux_DB
{
    /*
  Clase AuxDB para manejar la conexión a la base de datos y ejecutar consultas.
 
  Esta clase encapsula las operaciones comunes de la base de datos utilizando PDO.
  Establece una conexión con la base de datos en su construcción y proporciona
  métodos para ejecutar consultas y manejar los resultados.
 */
    private $host = 'localhost'; // <-- El host de la base de datos, en este caso, localhost.
    private $usuario_host = 'root'; // <-- El nombre de usuario para acceder a la base de datos, por defecto 'root'.
    private $pass = ''; // <-- La contraseña para el usuario de la base de datos, aquí está vacía.
    private $db_name = 'webblog'; // <-- El nombre de la base de datos a la que se conectará.
    private $conn; // <-- Propiedad que almacenará el objeto de conexión PDO.


    /*
      Constructor de la clase.
     
      Inicializa la conexión a la base de datos llamando al método conectar.
     */
    public function __construct()
    {
        $this->conectar(); // Llama al método conectar para establecer la conexión a la base de datos.
    }

    /*
      Establece la conexión a la base de datos utilizando PDO.
     
      Utiliza las credenciales de la base de datos para crear una nueva conexión PDO.
      Configura el modo de error de PDO para lanzar excepciones en caso de error.
     
      @throws Exception Si la conexión falla, se captura la excepción PDOException y se lanza una nueva excepción.
     */
    private function conectar()
    {
        // DSN (Data Source Name) que contiene la información necesaria para la conexión PDO
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

        try {
            // Intenta crear una nueva instancia de PDO con el DSN y las credenciales de usuario.
            $this->conn = new PDO($dsn, $this->usuario_host, $this->pass);

            // Configura el modo de error de PDO para lanzar excepciones en caso de error
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si hay un error al conectar, registra el mensaje de error y lanza una excepción.
            error_log("Conexion fallida: " . $e->getMessage());
            throw new Exception("Conexion fallida: " . $e->getMessage());
        }
    }


    /*
     Cierra la conexión a la base de datos.
     Asigna null al objeto PDO para cerrar la conexión.
     */
    public function desconectar()
    {
        $this->conn = null; // Asigna null al objeto PDO, cerrando la conexión.
    }

    /*
      Ejecuta una consulta SQL en la base de datos.
    
      @param string $cadenaConsulta La consulta SQL a ejecutar.
      @return mixed El resultado de la consulta.
      @throws Exception Si hay un error en la consulta SQL, se captura la excepción PDOException y se lanza una nueva excepción.
     */
    public function ejecutar_sql($cadena_consulta)
    {
        try {
            // Ejecuta la consulta SQL usando el método query de PDO y devuelve el resultado.
            $consulta = $this->conn->query($cadena_consulta);
            return $consulta;
        } catch (PDOException $e) {
            // Si hay un error en la consulta SQL, registra el mensaje de error y lanza una excepción.
            error_log("Error en la consulta SQL: " . $e->getMessage());
            throw new Exception("Error en la consulta SQL: " . $e->getMessage());
        }
    }

    /*
      Obtiene la siguiente fila de un conjunto de resultados de consulta como un array asociativo.
     
      @param PDOStatement $datos El conjunto de resultados de la consulta de donde se obtendrá la siguiente fila.
      @return array La siguiente fila del conjunto de resultados, o false si no hay más filas.
     */
    public function siguiente_fila($datos)
    {
        // Utiliza el método fetch de PDO con el parámetro PDO::FETCH_ASSOC para obtener la fila como un array asociativo.
        $fila_superior = $datos->fetch(PDO::FETCH_ASSOC); // <-- Similar a mysqli_fetch_assoc()
        return $fila_superior;
    }
}
