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