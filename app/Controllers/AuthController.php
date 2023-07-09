<?php

namespace App\Controllers;

use App\Models\Employee;

class AuthController extends BaseController
{
    public function index()
    {
        $data = [];
        if(!empty($_COOKIE["email"])){
            $data = [
                "email"=> $_COOKIE["email"],
                "password" => $_COOKIE["password"]
            ];
        }
        return view('/auth/login', $data);
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
                    $password = $this->request->getVar("password");
                    $employee = new Employee();
                    $user = $employee->where("email", $email)->first();
                    if(empty($user)){
                        return redirect()->back()->with("error", ["El correo y/o contraseña no es correcto"]);
                    }
                    
                    if(!password_verify($password, $user['password'])){
                        return  redirect()->back()->with("error", ["El correo y/o contraseña no es correcto"]);
                    }
                     //remenber
                    $remenber = $this->request->getPost("remenber");
                    if($remenber == 1){
                        setcookie("email", $email, time()+3600);
                        setcookie("password", $password, time()+3600);
                    }else{
                        setcookie("email", $email, time()-3600);
                        setcookie("password", $password, time()-3600);
                    };
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