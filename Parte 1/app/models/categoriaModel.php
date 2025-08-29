<?php

include_once 'config.php';

class categoriaModel
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
        $query = $this->db->query('SHOW TABLES LIKE "generos"');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = //cachito de archivo sql
                $this->db->query($sql);

            $this->addCategoria();
            $this->addCategoria();
        }
    }

    function getCategorias()
    {
        $query = $this->db->prepare('SELECT * from generos');
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    function getCategoria($nombre)
    {
        $query = $this->db->prepare('SELECT * from generos WHERE genero = ?');
        $query->execute([$nombre]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);

        return $categoria;
    }

    function getProductosPorCategoria($nombre)
    {
        $query = $this->db->prepare('SELECT * FROM libros JOIN generos ON libros.genero = generos.genero WHERE genero.genero = ?');
        $query->execute([$nombre]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    function addCategoria($nombre, $descripcion)
    {
        $query = $this->db->prepare('INSERT INTO generos (nombre, descripcion) VALUES (?, ?)');
        $query->execute([$nombre, $descripcion]);

        return $this->db->lastInsertId();
    }

    function removeCategoria($nombre)
    {
        $query = $this->db->prepare('DELETE FROM generos WHERE nombre = ?');
        $query->execute([$nombre]);
    }

    function editCategoria($genero, $nombre, $descripcion) //preguntar
    {
        $query = $this->db->prepare('UPDATE generos SET nombre = ?, descripcion = ? WHERE genero = ?');
        $realizado = $query->execute([$nombre, $descripcion, $genero]);

        return $realizado;
    }
}
