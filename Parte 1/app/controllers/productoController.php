<?php

include_once 'models/productoModel.php';
include_once 'views/productoView.php';

class ProductoController
{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new ProductoModel;
        $this->view = new ProductoView;
    }

    function showListaProductos()
    {
        $productos = $this->model->getProductos();
        $this->view->showListaProductos($productos);
    }

    function showProducto($id)
    {
        $producto = $this->model->getProducto($id);
        $this->view->showProducto($producto);
    }

    function addProducto()
    {
        SesionHelper::verify();
        $titulo = $_POST['producto-titulo'];
        $autor = $_POST['producto-autor'];
        $genero = $_POST['producto-genero'];
        $descripcion = $_POST['producto-desc'];

        if (empty($titulo) || empty($autor) || empty($genero) || empty($descripcion)) {
            $this->view->showError("Debes completar todos los datos");
            return;
        }

        $id = $this->model->addProducto($titulo, $autor, $genero, $descripcion);
        if ($id) {
            header("Location: " . BASE_URL);
        } else {
            $this->view->showError("Error al insertar producto");
        }

        header("Location: " . BASE_URL);
    }

    function editProducto($id)
    {
        SesionHelper::verify();
        $titulo = $_POST['producto-titulo'];
        $autor = $_POST['producto-autor'];
        $genero = $_POST['producto-genero'];
        $descripcion = $_POST['producto-desc'];

        if (empty($titulo) || empty($autor) || empty($genero) || empty($descripcion)) {
            $this->view->showError("Debes completar todos los datos");
            return;
        }

        $id = $this->model->addProducto($id, $titulo, $autor, $genero, $descripcion);
        if ($id) {
            header("Location: " . BASE_URL);
        } else {
            $this->view->showError("Error al editar producto");
        }

        header("Location: " . BASE_URL);
    }

    function deleteProducto($id)
    {
        SesionHelper::verify();
        $this->model->deleteProducto($id);

        header("Location: " . BASE_URL);
    }
}
