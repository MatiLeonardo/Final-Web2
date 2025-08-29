<?php

class ProductoView
{

    function showListaProductos($productos) {}

    function showProducto($producto) {}

    function showError($error)
    {
        require './templates/error.phtml';
    }
}
