<?php

class col_articulos
{
    private $mi_aux_DB;
    private $array_articulos;
    public function __construct()
    {
        $this->mi_aux_DB = new Aux_DB();
        $consulta_sql = 'SELECT * FROM articulos';
        $consulta = $this->mi_aux_DB->ejecutar_sql($consulta_sql);
        $this->poblar_array_articulos($consulta);
        $this->mi_aux_DB->desconectar();
    }

    public function ver_todos()
    {
        foreach ($this->array_articulos as $articulo) {
            echo $articulo->visualizar_articulo();
        }
    }

    private function poblar_array_articulos($consulta)
    {
        $this->array_articulos = array();
        while ($fila = $this->mi_aux_DB->siguiente_fila($consulta)) {
            $articulo_actual = new articulo($fila['id'], $fila['titulo'], $fila['texto'], $fila['fecha']);
            array_push($this->array_articulos, $articulo_actual);
        }
    }
}
