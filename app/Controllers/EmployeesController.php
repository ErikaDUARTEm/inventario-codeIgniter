<?php
    
    namespace App\Controllers;
    use App\Models\Employee;
    class EmployeesController extends BaseController
    {
        public function index(){
            $employee = new Employee();
            $data = $employee->findAll();
        
            return view("employees/index",
            [
                "title"=> "Listado de empleados",
                "empleados" => $data
                
            ]
        );
        }
        public function create(){
            return view("employees/new", ['title'=> "Nuevo Empleado"]);
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
            "email" => [
                "rules" => "required|max_length[255]",
                "errors" => [
                    "required" => "El campo Email es obligatorio",
                    "max_length" => "La dirección debe tener máximo 255 caracteres"
                ]
            ],
            "password" => [
                "rules" => "required|max_length[30]",
                "errors" => [
                    "required" => "El campo es obligatorio",
                    "max_length" => "El password debe tener máximo 30 caracteres"
                ]
            ],

        ]);
        if (!$validation) {
            return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
        }
        try {
            $password = $this->request->getPost("password");
            $clave = password_hash($password , PASSWORD_DEFAULT);

            $data = [
                "name" => $this->request->getPost("name"),
                "email" => $this->request->getPost("email"),
                "password"=> $clave,
                "created_at" => date("Y-m-d h:i:s")
                    ];
            $employees = new Employee();
            
            $employees->insert($data);
            return redirect()->to(base_url("/employees"))->with("success", "Guardado exitosamente");
        } catch (\Throwable $error) {
            return redirect()->back()->with("error", $error->getMessage())->withInput();
        }
    }

    public function edit($id =null){
           
        $employees= new Employee();
        $query = $employees->find($id);
        return view("/employees/edit",
        [
            "title" => "Editando empleados",
            "employee" => $query
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
            "email" => [
                "rules" => "required|max_length[255]",
                "errors" => [
                    "required" => "El campo Email es obligatorio",
                    "max_length" => "La dirección debe tener máximo 255 caracteres"
                ]
            ],


        ]);
        if (!$validation) {
            return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
        }
        try {
            $id= $this->request->getPost("id");
            $data = [
                "name" => $this->request->getPost("name"),
                "email" => $this->request->getPost("email"),
                
                    ];
            $employees = new Employee();
            $employees->update($id, $data);
            return redirect()->to(base_url("/employees"))->with("success", "Editado exitosamente");
        } catch (\Throwable $error) {
            return redirect()->back()->with("error", $error->getMessage())->withInput();
        }

    }
    public function delete($id){
        try{
            $employees = new Employee();
            $employees->delete($id);
            return redirect()->to(base_url("/employees"))->with("success", "Los datos fueron eliminados exitosamente");
        }catch(\Throwable $error){
            return redirect()->back()->with("error", $error->getMessage());
        }
       
    }
    }