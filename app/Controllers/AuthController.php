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
        $this->validate([
            "email"=> [
                "rules" => "required|email|max_length[255]|valid_email",
                "errors" => [
                  "required" =>  "el campo codigo es obligatorio",
                    "email" => "el correo no puede ser mayor de 255 caracteres"
                ]
                ],
            "password" => [
                "rules" => "required|min_length[8]|max_length",
                "errors" => [
                    "required" => "el campo es obligatorio",
                    "min_length" => "el correo no puede ser menor a 8 caracteres",
                    "max_length" => "el correo no puede ser mayor de 30 caracteres"
                ]
            ]
            ]);
                if($validation == false){
                    return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
                }
                try{
                    $email = $this->request->getPost("email");
                    $password = $this->request->getPost("password");
                    $employee = new Employee();
                    $user = $employee->where("email", $email)->first();
                    if(empty($user)){
                        return redirect()->back()->with("error", ["El correo y/o contraseña no es correcto"])->withInput();
                    }
                    if($password != $user["password"]){
                        return  redirect()->back()->with("error", ["El correo y/o contraseña no es correcto"])->withInput();
                    }
                   
                    session()->set([
                        "user_id" => $user["id"],
                        "nombre" => $user["name"],
                        "address" => $user["address"],
                        // "email" => $user["email"],
                        'is_logged' => true
                    ]);
                    return redirect()->to(base_url("/tablero"));
                }catch(\Throwable $error){
                    return redirect()->back()->with("error", [$error->getMessage()]);
                }

        }       
       public function logout(){
        session();
        session_destroy(); //elimino las variables de session
        return redirect()->to(base_url("/")); //redirijo al login
       }
}