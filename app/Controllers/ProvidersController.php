<?php
    
    namespace App\Controllers;

    use App\Models\Provider;
    class ProvidersController extends BaseController
    {
        public function index(){
            $providers = new Provider();
            $data = $providers->findAll();
          
            return view("providers",
            [
                "title"=> "Listado de Proveedores",
                "data" => $data,
               
            ]
        );
        }
    }