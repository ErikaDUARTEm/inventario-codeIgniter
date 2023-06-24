<?php
    
    namespace App\Controllers;

    class ProvidersController extends BaseController
    {
        public function index(){
            return view("providers",
            [
                "title"=> "Listado de Proveedores",
                "dato" => "Soy el dato",
                
            ]
        );
        }
    }