<?php
    
    namespace App\Controllers;

    class ProductsController extends BaseController
    {
        public function index(){
            return view("products",
            [
                "title"=> "Listado de Productos",
                "dato" => "Soy el dato",
                "componente" =>"soy desde products",
            ]
        );
        }
    }