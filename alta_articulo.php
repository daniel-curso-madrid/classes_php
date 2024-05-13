<?php
include 'header.php';
if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $nuevo_articulo = new Articulo(null, $titulo, $texto, null);
    $nuevo_articulo->insertar_articulo_DB();
    echo "articulo grabado, <a href='index.php'>ver todos</a>";
} else {



?>
<form action="alta_articulo.php" method="post">
    <div>Titulo: <input type="text" name="titulo"></div>
    <div>Texto:<textarea name="texto" cols="40" rows="10"></textarea></div>
    <input type="submit" name="enviar">
</form>


<?php
}
?>