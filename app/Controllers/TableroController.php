<?php
    
    namespace App\Controllers;
    
    class TableroController extends BaseController
    {
        public function index(){
            return view("/tablero");
        }
        public function tablero(){
            return redirect()->to(base_url("/tablero"))->with("success", "Haz iniciado sesión");
        }
    }