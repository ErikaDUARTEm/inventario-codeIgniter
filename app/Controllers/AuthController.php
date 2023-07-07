<?php

namespace App\Controllers;

use App\Models\Employee;

class AuthController extends BaseController
{
    public function index()
    {
        return view('/auth/login');
    }
    public function auth()
    {
        $validation = $this->validate([
            "email"=> [
                "rules" => "required|max_length[30]|valid_email",
                "errors" => [
                    "required" => "El campo es obligatorio",
                    "email" => "El email no es correcto"
                ]
                ],
            "password" => [
                "rules" => "required|min_length[8]|max_length[30]",
                "errors" => [
                    "required" => "El campo es obligatorio",
                    "min_length" => "El correo no puede ser menor a 8 caracteres",
                    "max_length" => "El correo no puede ser mayor de 30 caracteres"
                ]
            ]
            ]);
                if($validation == false){
                    return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
                }
                //validar con la base de datos
                try{
                    $email = $this->request->getPost("email");
                    $password = $this->request->getPost("password");
                    $employee = new Employee();
                    $user = $employee->where("email", $email)->first();
                    if(empty($user)){
                        return redirect()->back()->with("error", ["El correo y/o contraseña no es correcto"]);
                    }
                    
                    if(password_verify("$password", $user['password'])){
                        return  redirect()->back()->with("error", ["El correo y/o contraseña no es correcto"]);
                    }
                    session()->set([
                        "user_id" => $user['id'],
                        "name" => $user['name'],
                        "email" => $user['email'],
                        "is_logged" => true
                    ]);
                return redirect()->to(base_url("/tablero"));
                }catch(\Throwable $error){
                    return redirect()->back()->with("errors", [$error->getMessage()]);
                }

        }       
       public function logout(){
        session();
        session_destroy(); //elimino las variables de session
        return redirect()->to(base_url("/")); //redirijo al login
       }
}