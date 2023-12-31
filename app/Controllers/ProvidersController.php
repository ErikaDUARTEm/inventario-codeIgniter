<?php

namespace App\Controllers;

use App\Models\Provider;

class ProvidersController extends BaseController
{
    public function index()
    {
        $providers = new Provider();
        $data = $providers->findAll();

        return view(
            "providers/index",
            [
                "title" => "Listado de Proveedores",
                "data" => $data,

            ]
        );
    }
    public function create()
    {
        return view("providers/new", ["title" => "Nuevo proveedor"]);
    }
    public function save()
    {
        $validation = $this->validate([
            "name" => [
                "rules" => "required|min_length[10]|max_length[30]",
                "errors" => [
                    "required" => "El campo nombre es obligatorio",
                    "min_length" => "El nombre debe tener minimo 10 caracteres",
                    "max_length" => "El nombre no puede ser mayor a 30 caracteres"
                ]
            ],
            "address" => [
                "rules" => "required|min_length[10]",
                "errors" => [
                    "required" => "El campo dirección es obligatorio",
                    "min_length" => "La dirección debe tener minimo 10 caracteres"
                ]
            ],
            "phone" => [
                "rules" => "required|min_length[10]",
                "errors" => [
                    "required" => "El teléfono es obligatorio",
                    "min_length" => "El teléfono debe tener minimo 10 caracteres",

                ]
            ]

        ]);
        if (!$validation) {
            return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
        }
        try {
            $data = [
                "name" => $this->request->getPost("name"),
                "address" => $this->request->getPost("address"),
                "phone" => $this->request->getPost("phone"),
                    ];
            $providers = new Provider();
            $providers->insert($data);
            return redirect()->to(base_url("/providers"))->with("success", "Guardado exitosamente");
        } catch (\Throwable $error) {
            return redirect()->back()->with("error", $error->getMessage())->withInput();
        }
    }
    public function edit($id =null){
           
        $providers= new Provider();
        $query = $providers->find($id);
        return view("providers/edit",
        [
            "title" => "Editando proveedores",
            "provider" => $query
        ]
        );
    }
    public function update(){
        $validation = $this->validate([
            "name" => [
                "rules" => "required|min_length[10]|max_length[30]",
                "errors" => [
                    "required" => "El campo nombre es obligatorio",
                    "min_length" => "El nombre debe tener minimo 10 caracteres",
                    "max_length" => "El nombre no puede ser mayor a 30 caracteres"
                ]
            ],
            "address" => [
                "rules" => "required|min_length[10]",
                "errors" => [
                    "required" => "El campo dirección es obligatorio",
                    "min_length" => "La dirección debe tener minimo 10 caracteres"
                ]
            ],
            "phone" => [
                "rules" => "required|min_length[10]",
                "errors" => [
                    "required" => "El teléfono es obligatorio",
                    "min_length" => "El teléfono debe tener minimo 10 caracteres",

                ]
            ]

        ]);
        if (!$validation) {
            return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
        }
        try {
            $id= $this->request->getPost("id");
            $data = [
                "name" => $this->request->getPost("name"),
                "address" => $this->request->getPost("address"),
                "phone" => $this->request->getPost("phone"),
                "created_at" => date("Y-m-d h:i:s")
                    ];
            $providers = new Provider();
            $providers->update($id, $data);
            return redirect()->to(base_url("/providers"))->with("success", "Editado exitosamente");
        } catch (\Throwable $error) {
            return redirect()->back()->with("error", $error->getMessage())->withInput();
        }
    }
    public function delete($id){
        try{
            $provider = new Provider();
            $provider->delete($id);
            return redirect()->to(base_url("/providers"))->with("success", "El proveedor fue eliminado exitosamente");
        }catch(\Throwable $error){
            return redirect()->back()->with("error", $error->getMessage());
        }
       
    }
}
