<?php

include_once 'app/models/categoriaModel.php';
include_once 'app/views/categoriaView.php';

class CategoriaController
{

    private $model;
    private $view;

    function __construct()
    {
        $this->model = new CategoriaModel;
        $this->view = new CategoriaView;
    }

    function showCategorias()
    {
        $categorias = $this->model->getCategorias();
        $this->view->showListaCategorias($categorias);
    }

    function showCategoria($nombre)
    {
        $categoria = $this->model->getCategoria($nombre);
        $productos = $this->model->getProductosPorCategoria($nombre);
        $this->view->showCategoria($categoria, $productos);
    }

    function addCategoria()
    {
        SesionHelper::verify();
        $genero = $_POST['genero-nombre'];
        $descripcion = $_POST['genero-descripcion'];

        if (empty($genero) || empty($descripcion)) {
            $this->view->showError("Debes completar todos los datos");
            return;
        }

        $id = $this->model->addCategoria($genero, $descripcion);
        if ($id) {
            header("Location: " . BASE_URL);
        } else {
            $this->view->showError("Error al insertar genero");
        }
        header("Location: " . BASE_URL);
    }

    function editCategoria($nombre)
    {
        SesionHelper::verify();
        $genero = $_POST['genero-nombre'];
        $descripcion = $_POST['genero-descripcion'];

        if (empty($genero) || empty($descripcion)) {
            $this->view->showError("Debes completar todos los datos");
            return;
        }

        $id = $this->model->addCategoria($nombre, $genero, $descripcion);
        if ($id) {
            header("Location: " . BASE_URL);
        } else {
            $this->view->showError("Error al insertar genero");
        }
        header("Location: " . BASE_URL);
    }

    function deleteCategoria($nombre)
    {
        SesionHelper::verify();
        $this->model->removeCategoria($nombre);

        header("Location: " . BASE_URL);
    }
}
