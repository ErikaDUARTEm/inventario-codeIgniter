<?php
    
    namespace App\Controllers;
    use App\Models\Product;
    class ProductsController extends BaseController
    {
        public function index(){
            $products = new Product();
            $data = $products->findAll();
        
            return view("products",
            [
                "title"=> "Listado de Productos",
                "products" => $data
                
            ]
        );
        }

    }