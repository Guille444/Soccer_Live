<?php
// Se incluye la clase para trabajar con la base de datos.
require_once('../../helpers/database.php');
/*
 *  Clase para manejar el comportamiento de los datos de la tabla CATEGORIA.
 */
class CategoriaHandler
{
    /*
     *  Declaración de atributos para el manejo de datos.
     */
    protected $id = null;
    protected $nombre = null;
    protected $descripcion = null;
    protected $imagen = null;

    // Constante para establecer la ruta de las imágenes.
    const RUTA_IMAGEN = '../../images/categorias/';

    /*
     *  Métodos para realizar las operaciones SCRUD (search, create, read, update, and delete).
     */

    // Método para buscar categorías por nombre.
    public function searchRows()
    {
        $value = '%' . Validator::getSearchValue() . '%'; // Obtiene el valor de búsqueda del validador.
        $sql = 'SELECT id_categoria, nombre_categoria, descripcion_categoria, imagen_categoria
                FROM categorias
                WHERE nombre_categoria LIKE ?
                ORDER BY nombre_categoria';
        $params = array($value);
        return Database::getRows($sql, $params);
    }

    // Método para crear una nueva categoría.
    public function createRow()
    {
        $sql = 'INSERT INTO categorias(nombre_categoria, descripcion_categoria, imagen_categoria)
                VALUES(?, ?, ?)';
        $params = array($this->nombre, $this->descripcion, $this->imagen); // Obtiene los valores de la instancia actual.
        return Database::executeRow($sql, $params);
    }

    // Método para leer todas las categorías.
    public function readAll()
    {
        $sql = 'SELECT id_categoria, nombre_categoria, descripcion_categoria, imagen_categoria
                FROM categorias
                ORDER BY nombre_categoria';
        return Database::getRows($sql); // Retorna todas las filas de categorías ordenadas por nombre.
    }

    // Método para leer una categoría específica por su ID.
    public function readOne()
    {
        $sql = 'SELECT id_categoria, nombre_categoria, descripcion_categoria, imagen_categoria
                FROM categorias
                WHERE id_categoria = ?';
        $params = array($this->id); // Obtiene el ID de la instancia actual.
        return Database::getRow($sql, $params);
    }

    // Método para actualizar una categoría existente.
    public function readFilename()
    {
        $sql = 'SELECT imagen_categoria
                FROM categorias
                WHERE id_categoria = ?';
        $params = array($this->id); // Obtiene los valores actualizados.
        return Database::getRow($sql, $params);
    }

    // Método para actualizar una categoría existente.
    public function updateRow()
    {
        $sql = 'UPDATE categorias
                SET imagen_categoria = ?, nombre_categoria = ?, descripcion_categoria = ?
                WHERE id_categoria = ?';
        $params = array($this->imagen, $this->nombre, $this->descripcion, $this->id); // Obtiene los valores actualizados.
        return Database::executeRow($sql, $params);
    }

    // Método para eliminar una categoría por su ID.
    public function deleteRow()
    {
        $sql = 'DELETE FROM categorias
                WHERE id_categoria = ?';
        $params = array($this->id); // Obtiene el ID de la instancia actual.
        return Database::executeRow($sql, $params);
    }

    // Método para verificar si ya existe una categoría con el mismo nombre.
    public function checkDuplicate($value)
    {
        $sql = 'SELECT id_categoria
                FROM categorias
                WHERE nombre_categoria = ?';
        $params = array($value);
        return Database::getRow($sql, $params);
    }

    // Método para gráficar el top 5 de productos más vendidos de una categoría.
    public function readTopProductos()
    {
        $sql = 'SELECT nombre_producto, SUM(cantidad_producto) total
                FROM detalle_pedidos
                INNER JOIN productos USING(id_producto)
                WHERE id_categoria = ?
                GROUP BY nombre_producto
                ORDER BY total DESC
                LIMIT 5';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}
