<?php
    
    namespace App\Controllers;

    use App\Models\Provider;
    class ProvidersController extends BaseController
    {
        public function index(){
            $providers = new Provider();
            $data = $providers->findAll();
          
            return view("providers/index",
            [
                "title"=> "Listado de Proveedores",
                "data" => $data,
               
            ]
        );
        }
        public function create(){
            return view("providers/new", ["title"=> "Nuevo proveedor"]);
        }

    }