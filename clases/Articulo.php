<?php
class Articulo
{
    private $id;
    private $titulo;
    private $texto;
    private $fecha;
    private $mi_aux_DB;

    public function __construct($id, $titulo, $texto, $fecha)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha = $fecha;
        $this->mi_aux_DB = new Aux_DB();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    function visualizar_articulo()
    {
        $cadena_creciente = '';
        $cadena_creciente .= '<div>Titulo:' . $this->titulo . '</div>';
        $cadena_creciente .= '<div>Contenido' . $this->texto . '</div>';
        $cadena_creciente .= '<div>Fecha' . $this->fecha . '</div>';
        return $cadena_creciente;
    }

    public function recuperar_articulo_DB($id)
    {
        $consulta_sql = "SELECT * FROM articulos WHERE id='" . $id . "'";
        $consulta = $this->mi_aux_DB->ejecutar_sql($consulta_sql);
        $fila = $this->mi_aux_DB->siguiente_fila($consulta);
        $this->id = $fila['id'];
        $this->titulo = $fila['titulo'];
        $this->texto = $fila['texto'];
        $this->fecha = $fila['fecha'];
    }

    public function insertar_articulo_DB()
    {
        $consulta_sql = "INSERT INTO articulos(id,titulo,texto,fecha) VALUES (null, '" . $this->titulo . "','" . $this->texto . "',NOW())";
        $this->mi_aux_DB->ejecutar_sql($consulta_sql);
        $this->mi_aux_DB->desconectar();
    }
}
