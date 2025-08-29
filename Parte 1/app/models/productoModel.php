<?php

include_once 'config.php';

class ProductoModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . DB_HOST .
                ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
        $this->_deploy();
    }

    function _deploy()
    {
        $query = $this->db->query('SHOW TABLES LIKE "libros"');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = //cachito de archivo sql
                $this->db->query($sql);

            $this->addProducto();
            $this->addProducto();
        }
    }

    function getProductos()
    {
        $query = $this->db->prepare('SELECT * from libros');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    function getProducto($id)
    {
        $query = $this->db->prepare('SELECT * from libros WHERE id_libro = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);

        return $producto;
    }

    function addProducto() {}

    function editProducto($id) {}

    function deleteProducto($id) {}
}
