<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function index()
    {
        return view('/auth/login');
    }
    public function auth()
    {
        //validar credenciales
        //si no son correctas regresar a login
        //si si son correctas mandar al tablero
        return view('/tablero');
    }
}
