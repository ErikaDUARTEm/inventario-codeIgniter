<?php
    
    namespace App\Controllers;
    use App\Models\Product;
    class ProductsController extends BaseController
    {
        public function index(){
            $products = new Product();
            $data = $products->findAll();
        
            return view("products/index",
            [
                "title"=> "Listado de Productos",
                "products" => $data
                
            ]
        );
        }
        public function create(){
            return view("products/new", ['title'=> "Nuevo Producto"]);
        }
        public function save(){
    
             $validation = $this->validate([
                "code" => [
                    "rules"=>"required|min_length[10]|max_length[20]",
                    "errors" => [
                        "required" => "El campo código es obligatorio",
                        "min_length" => "El código debe tener minimo 10 caracteres",
                        "max_length" => "El código no puede ser mayor a 20 caracteres"
                        ]     
                    ],
                "title" => [
                        "rules"=>"required|min_length[8]|max_length[255]",
                        "errors" => [
                            "required" => "El campo titulo es obligatorio",
                            "min_length" => "El titulo debe tener minimo 8 caracteres",
                            "max_length" => "El titulo no puede ser mayor a 255 caracteres"
                            ]     
                        ],
                "description" => [
                        "rules"=>"required|min_length[20]",
                        "errors" => [
                             "required" => "La descripción es obligatoria",
                             "min_length" => "La descripción debe tener minimo 20 caracteres",
                            
                            ]     
                        ],
                "price" => [
                        "rules"=>"required|numeric",
                        "errors" => [
                                "required" => "El precio es obligatorio",
                                "numeric" => "El precio debe ser numeros",
                                
                                ]     
                            ],
                "quantity" => [
                        "rules"=>"required|numeric",
                        "errors" => [
                                    "required" => "La Existencia es obligatoria",
                                    "numeric" => "La existencia debe ser numeros",
                                        
                                    ]     
                                    ],
                
            ]);
            if(!$validation){
                return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
            }
            try{
                $data= [
                    "code" => $this->request->getPost("code"),
                    "title" => $this->request->getPost("title"),
                    "description" => $this->request->getPost("description"),
                    "price" => $this->request->getPost("price"),
                    "quantity" => $this->request->getPost("quantity")
                   
                   ];
                    $productos = new Product();
                    $productos->insert($data);
        
                    return redirect()->to(base_url("/products"))->with("success", "Guardado exitosamente");
            }catch(\Throwable $error){
                return redirect()->back()->with("error", $error->getMessage())->withInput();
            }
            // 
          
        }
        public function edit($id =null){
           
            $productos = new Product();
            $query = $productos->find($id);
            return view("products/edit",
            [
                "title" => "Editando productos",
                "producto" => $query
            ]
            );
        }
        public function update(){
            $validation = $this->validate([
                "code" => [
                    "rules"=>"required|min_length[10]|max_length[20]",
                    "errors" => [
                        "required" => "El campo código es obligatorio",
                        "min_length" => "El código debe tener minimo 10 caracteres",
                        "max_length" => "El código no puede ser mayor a 20 caracteres"
                        ]     
                    ],
                "title" => [
                        "rules"=>"required|min_length[8]|max_length[255]",
                        "errors" => [
                            "required" => "El campo titulo es obligatorio",
                            "min_length" => "El titulo debe tener minimo 8 caracteres",
                            "max_length" => "El titulo no puede ser mayor a 255 caracteres"
                            ]     
                        ],
                "description" => [
                        "rules"=>"required|min_length[20]",
                        "errors" => [
                             "required" => "La descripción es obligatoria",
                             "min_length" => "La descripción debe tener minimo 20 caracteres",
                            
                            ]     
                        ],
                "price" => [
                        "rules"=>"required|numeric",
                        "errors" => [
                                "required" => "El precio es obligatorio",
                                "numeric" => "El precio debe ser numeros",
                                
                                ]     
                            ],
                "quantity" => [
                        "rules"=>"required|numeric",
                        "errors" => [
                                    "required" => "La existencia es obligatoria",
                                    "numeric" => "La existencia debe ser numeros",
                                        
                                    ]     
                                    ],
                
            ]);
            if(!$validation){
                return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
            }
            try{
                $id= $this->request->getPost("id");
                $data= [
                    "code" => $this->request->getPost("code"),
                    "title" => $this->request->getPost("title"),
                    "description" => $this->request->getPost("description"),
                    "price" => $this->request->getPost("price"),
                    "quantity" => $this->request->getPost("quantity")
                   
                   ];
                    $productos = new Product();
                    $productos->update($id, $data);
        
                    return redirect()->to(base_url("/products"))->with("success", "Editado exitosamente");
            }catch(\Throwable $error){
                return redirect()->back()->with("error", $error->getMessage())->withInput();
            }
        }
        public function delete($id){
            try{
                $producto = new Product();
                $producto->delete($id);
                return redirect()->to(base_url("/products"))->with("success", "El producto fue eliminado exitosamente");
            }catch(\Throwable $error){
                return redirect()->back()->with("error", $error->getMessage())->withInput();
            }
           
        }
        public function search(){
            $search = $_GET["searchTerm"];
            $products = new Product();
            $products->select("code, title");
            $products->like("title", $search, "both");
            echo json_encode($products->findAll());
            return;
        }
    }