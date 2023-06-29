<?php
    
    namespace App\Controllers;
    use App\Models\Product;
    class ProductsController extends BaseController
    {
        public function index(){
            $products = new Product();
            $data = $products->findAll();
        
            return view("products/index",
            [
                "title"=> "Listado de Productos",
                "products" => $data
                
            ]
        );
        }
        public function create(){
            return view("products/new", ['title'=> "Nuevo Producto"]);
        }
        public function save(){
           $data= [
            "code" => $this->request->getPost("code"),
            "title" => $this->request->getPost("title"),
            "description" => $this->request->getPost("description"),
            "price" => $this->request->getPost("price"),
            "quantity" => $this->request->getPost("quantity")
           
           ];
            $productos = new Product();
            $productos->Insert($data);
        }
    }