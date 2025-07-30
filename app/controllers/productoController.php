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
        $this->view->showListaProductos();
    }
}
