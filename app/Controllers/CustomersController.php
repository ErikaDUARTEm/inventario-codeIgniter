<?php
    
    namespace App\Controllers;
    use App\Models\Customer;
    class CustomersController extends BaseController
    {
        public function index(){
            $customers = new Customer();
            $data = $customers->findAll();
        
            return view("customers/index",
            [
                "title"=> "Listado de clientes",
                "clientes" => $data
                
            ]
        );
        }
        public function create(){
            return view("customers/new", ['title'=> "Nuevo Cliente"]);
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
            $customers = new Customer();
            $customers->insert($data);
            return redirect()->to(base_url("/customers"))->with("success", "Guardado exitosamente");
        } catch (\Throwable $error) {
            return redirect()->back()->with("error", $error->getMessage())->withInput();
        }
    }
    public function edit($id =null){
           
        $customers= new Customer();
        $query = $customers->find($id);
        return view("/customers/edit",
        [
            "title" => "Editando clientes",
            "customer" => $query
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
            $customers = new Customer();
            $customers->update($id, $data);
            return redirect()->to(base_url("/customers"))->with("success", "Editado
             exitosamente");
        } catch (\Throwable $error) {
            return redirect()->back()->with("error", $error->getMessage())->withInput();
        }
    }
    public function delete($id){
        try{
            $customers = new Customer();
            $customers->delete($id);
            return redirect()->to(base_url("/customers"))->with("success", "Los datos fueron eliminados exitosamente");
        }catch(\Throwable $error){
            return redirect()->back()->with("error", $error->getMessage());
        }
       
    }
    public function search(){
        $buscador = $_GET["searchTerm"];
        $customer = new Customer();
        $customer->select("id, name");
        $customer->like("name", $buscador, "both");
        echo json_encode($customer->findAll());
        return;
    }
    }